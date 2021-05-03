<?php
/**
 * Theme scripts
 *
 * @package sasabudi
 */

/**
 * Theme Scripts
 */
function sasabudi_theme_scripts() {

  // Settings
  $suffix          = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
  $dependencies   = array('jquery');
  $locale         = get_locale();
  $ajax_url       = admin_url('admin-ajax.php', 'relative');

  // Enque Scripts
  wp_enqueue_script( 'sasabudi-scripts-dist', get_template_directory_uri() . '/js/scripts'.$suffix.'.js', $dependencies, sasabudi_theme_version(), TRUE );
  wp_script_add_data( 'sasabudi-js', 'async', true );

  $sasabudi_scripts_vars_array = array(
      'root_url'                  => esc_url(get_home_url()),
      'root_lang'                 => esc_url($locale),
      'ajax_load_more_locale' 	  => esc_html__( 'Load More Items', 'sasabudi' ),
      'ajax_loading_locale' 		  => esc_html__( 'Loading', 'sasabudi' ),
      'ajax_no_more_items_locale' => esc_html__( 'No more items available.', 'sasabudi' ),
      'ajax_url'					        => esc_url($ajax_url),
      'ajax_nonce'                => wp_create_nonce('wp_rest')
  );
  wp_localize_script( 'sasabudi-scripts-dist', 'sasabudi_scripts_vars', $sasabudi_scripts_vars_array );

}
add_action( 'wp_enqueue_scripts', 'sasabudi_theme_scripts', 99 );

/**
 * Ajax Actions
 */

// newsletter subscription
add_action('wp_ajax_sasabudi_newsletter_subscribe', 'sasabudi_footer_newsletter_subscribe');
add_action('wp_ajax_nopriv_sasabudi_newsletter_subscribe', 'sasabudi_footer_newsletter_subscribe');
// contact form ajax
add_action('wp_ajax_sasabudi_contact_form_message', 'sasabudi_execute_contact_form_message');
add_action('wp_ajax_nopriv_sasabudi_contact_form_message', 'sasabudi_execute_contact_form_message');
// archive collection ajax
add_action('wp_ajax_sasabudi_load_archive_collections', 'sasabudi_page_collections_archive_ajax');
add_action('wp_ajax_nopriv_sasabudi_load_archive_collections', 'sasabudi_page_collections_archive_ajax');
// single collection ajax
add_action('wp_ajax_sasabudi_load_single_collections', 'sasabudi_page_collection_single_ajax');
add_action('wp_ajax_nopriv_sasabudi_load_single_collections', 'sasabudi_page_collection_single_ajax');
// archive instagram ajax
add_action('wp_ajax_sasabudi_load_archive_instagrams', 'sasabudi_page_instagram_archive_ajax');
add_action('wp_ajax_nopriv_sasabudi_load_archive_instagrams', 'sasabudi_page_instagram_archive_ajax');
// archive bestseller ajax
add_action('wp_ajax_sasabudi_load_catalog_best_sellers', 'sasabudi_products_catalog_best_sellers_ajax');
add_action('wp_ajax_nopriv_sasabudi_load_catalog_best_sellers', 'sasabudi_products_catalog_best_sellers_ajax');
// archive featuring ajax
add_action('wp_ajax_sasabudi_load_catalog_featuring', 'sasabudi_products_catalog_featuring_ajax');
add_action('wp_ajax_nopriv_sasabudi_load_catalog_featuring', 'sasabudi_products_catalog_featuring_ajax');