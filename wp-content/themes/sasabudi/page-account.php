<?php
/**
 * The template for displaying the 'account' pages.
 *
 * Template name: Page-Account
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main">';
    echo '<div class="account">';  

      while ( have_posts() ) : the_post();
        the_content();
      endwhile;

      // Insert statements when logged in
      if ( is_account_page() ) {
        if ( is_user_logged_in() ) {
          /** 
           * @hooked :: sasabudi_home_products_statement - 10
           */
          do_action( 'sasabudi_render_account_page' );
        } 
      }

    echo '</div>';
  echo '</main>'; 

get_footer();