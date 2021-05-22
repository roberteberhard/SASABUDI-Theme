<?php
/**
 * The template for displaying the 'community' pages.
 *
 * Template name: Page-Community
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

// Arguments
$action   = isset($_GET['action']);
$section  = $_GET['action'];

if($action) {

  // Show content when query string are matching!
  if($section == 'subscribed' OR $section == 'unsubscribed') {

    get_header();

      echo '<main class="main" role="main">';

        if( $section == 'subscribed' ) {
          get_template_part( 'templates/community-subscribed', 'single' );
          ?>
          <script>
            dataLayer.push({
              'lead' : 'Newsletter'
            });
          </script>
          <?php
        } 
        
        if( $section == 'unsubscribed' ) {
          get_template_part( 'templates/community-unsubscribed', 'single' );
        }

        /** 
         * @hooked :: sasabudi_home_products_statement - 10
         */
        do_action( 'sasabudi_render_policy_page' );

      echo '</main>'; 

    get_footer();

  } else {
    
    // Go back to home!
    wp_redirect(esc_url(home_url()));
    exit;   
  }
 
} else {

  // Go back to home!
  wp_redirect(esc_url(home_url()));
  exit;
}
