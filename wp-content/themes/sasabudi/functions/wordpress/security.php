<?php
/**
 * WP Security
 *
 * REMOVE JUNK FROM HEAD
 * Remove/Disable/DeQueue XML-RPC
 * Remove/Disable/DeQueue WordPress Version
 * Remove/Disable/DeQueue jQuery Migrate in WordPress
 * Remove/Disable/DeQueue Emojis in WordPress
 * Remove/Disable/DeQueue Disable Embeds in WordPress 
 *
 * @package sasabudi
 */
 
// =========================================================================
// REMOVE JUNK FROM HEAD
// =========================================================================
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

// -----------------------------------------------------------------------------
// Remove/Disable/DeQueue XML-RPC
// -----------------------------------------------------------------------------
add_filter( 'xmlrpc_enabled', '__return_false' );

// -----------------------------------------------------------------------------
// Remove/Disable/DeQueue WordPress Version
// -----------------------------------------------------------------------------
function sasabudi_remove_version() {
  return '';
}
add_filter('the_generator', 'sasabudi_remove_version');

// -----------------------------------------------------------------------------
// Remove/Disable/DeQueue jQuery Migrate in WordPress
// -----------------------------------------------------------------------------
function sasabudi_dequeue_jquery_migrate( $scripts ) {
  if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
    $scripts->registered['jquery']->deps = array_diff(
        $scripts->registered['jquery']->deps,
        [ 'jquery-migrate' ]
    );
  }
}
add_action( 'wp_default_scripts', 'sasabudi_dequeue_jquery_migrate' );

// -----------------------------------------------------------------------------
// Remove/Disable/DeQueue Emojis in WordPress
// -----------------------------------------------------------------------------
function sasabudi_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  // Remove from TinyMCE
  add_filter( 'tiny_mce_plugins', 'sasabudi_disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'sasabudi_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'sasabudi_disable_emojis' );

function sasabudi_disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
function sasabudi_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
     $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }
  return $urls;
}

// -----------------------------------------------------------------------------
// Remove/Disable/DeQueue Disable Embeds in WordPress
// -----------------------------------------------------------------------------
function sasabudi_deregister_scripts(){
  wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'sasabudi_deregister_scripts' );
