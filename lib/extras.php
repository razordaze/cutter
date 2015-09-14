<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip;</p><p style="text-align:right"><a href="' . get_permalink() . '">' . __('More...', 'sage') . '</a></p>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Prevent Page Scroll When Clicking the More Link
 */
function remove_more_link_scroll( $link ) {
  $link = preg_replace( '|#more-[0-9]+|', '', $link );
  return $link;
}
add_filter( 'the_content_more_link', __NAMESPACE__ . '\\remove_more_link_scroll' );

/**
 * Convert items in the social menu to icons in the Fontello icon font
 */
function fontello_conversion( $title, $id = null ) {
    if (has_nav_menu('social_links')) :
      if ( in_array( $id, get_objects_in_term( wp_get_nav_menu_object( get_nav_menu_locations()[ 'social_links' ] )->term_id, 'nav_menu' ) ) ) :
        switch (strtolower($title)){
          case "facebook":
          case "fb":
            return "f";
            break;
          case "flickr":
          case "flicker":
            return "F";
            break;
          case "google+":
          case "g":
          case "g+":
          case "googleplus":
          case "google plus":
            return "G";
            break;
          case "instagram":
            return "i";
            break;
          case "linked in":
          case "linkedin":
          case "li":
            return "L";
            break;
          case "twitter":
            return "T";
            break;
          case "vimeo":
            return "v";
            break;
          case "vine":
            return "V";
            break;
          case "yelp":
            return "Y";
            break;
          case "youtube":
            return "y";
            break;
          default:
            return strtolower($title[0]);
        }
      endif;
    endif;
    return $title;
}
add_filter( 'the_title', __NAMESPACE__ . '\\fontello_conversion', 10, 2 );
