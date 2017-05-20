(function ($) {
  var AxAccordion = {
    init: function($context){
      $context.find('.ax-accordion__toggle').click(this.onClickToggle.bind(this));
      return this;
    },

    onClickToggle: function(event) {
      event.preventDefault();

      var $target = $(event.currentTarget);
      var contentId = $target.attr('aria-controls');
      var nextStateExpanded = !JSON.parse($target.attr('aria-expanded'));

      $('#' + contentId).slideToggle(function onSlideToggleComplete() {
        var $toggleLinks = $('[aria-controls=' + contentId + ']');
        var $content = $('#' + contentId);

        // update the links that control content to match the nextState
        $toggleLinks.attr('aria-expanded', nextStateExpanded);
        
        // update aria-hidden state of the content
        $content.attr('aria-hidden', !nextStateExpanded);

        if (nextStateExpanded) {
          // Put focus on the content once its exapnded
          $content.attr('tabIndex', -1);
          $content[0].focus();
        } else {
          // Put focus back at title link
          $toggleLinks.eq(0)[0].focus();
        }
      });
    }
  };

  function initAxAccordions() {
    Object.create(AxAccordion).init($(this));
  };

  $(document).ready(function () {
    $(".ax-accordion").each(initAxAccordions);
  });
})(jQuery);
