<?php
/*
Plugin Name: WP AX Accordion Shortcode
Plugin URI: https://github.com/ericmasiello/wp-ax-accordion-shortcode
Description: A Wordpress shortcode for generating accessible accordions
Version: 1.0.0
Author: Eric Masiello
Author URI: http://www.synbydesign.com
License: GPL
Copyright: Eric Masiello
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

wp_enqueue_style( 'ax-accordion-css', plugins_url( '/ax-accordion.css', __FILE__ ) );
wp_enqueue_script( 'ax-accordion-js', plugins_url( '/ax-accordion.js', __FILE__ ), array('jquery'), NULL, true );

function accordion($atts, $content = NULL) {
  extract(shortcode_atts( array( 'title' => ''), $atts ));

  $uniqueId = uniqid("ax-accordion-");

  $output = "<div class=\"ax-accordion\">";
  $output .= "<h3 class=\"ax-accordion__title\">";
  $output .= "<a tabIndex=\"0\" class=\"ax-accordion__toggle\" role=\"button\" aria-expanded=\"false\" aria-controls=\"$uniqueId\">$title</a>";
  $output .= "</h3>";
  $output .= "<div id=\"$uniqueId\" aria-hidden=\"true\" class=\"ax-accordion__body\">";
  $output .= do_shortcode( $content );
  $output .= "<a tabIndex=\"0\" class=\"ax-accordion__toggle\" role=\"button\" aria-expanded=\"false\" aria-controls=\"$uniqueId\">Read Less</a>";
  $output .= "</div>";
  $output .= "</div>";
	return $output;
}
add_shortcode("ax_accordion", "accordion");


/*
 * Should remove any empty <p></p> tags from content
 */
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop', 99 );
add_filter( 'the_content', 'shortcode_unautop', 100 );
?>
