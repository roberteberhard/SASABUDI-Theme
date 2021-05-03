<?php
/**
 * Theme styles
 *
 * @package sasabudi
 */

/**
 * Theme styles
 */
function sasabudi_theme_styles() {
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    wp_enqueue_style( 'sasabudi-styles',          get_template_directory_uri() . '/css/styles'.$suffix.'.css', NULL, sasabudi_theme_version(), 'all' );
    wp_enqueue_style( 'sasabudi-default-style',   get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'sasabudi_theme_styles', 99 );
