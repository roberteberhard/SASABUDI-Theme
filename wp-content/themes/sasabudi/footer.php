<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

      if( ! defined( 'ABSPATH' ) ) exit;

      // Color attributes for footer background
      $page_color = is_front_page() || is_singular('post') || is_404();
      $mode_color = ($page_color == 1) ? ' is-darker' : ' ';

      echo '<footer class="footer' . $mode_color . '" role="contentinfo">';
        
        echo '<div class="footer-top">';
          echo '<div class="is-wrapper">';
          
            /**
             * @hooked :: sasabudi_footer_section_scrolltop - 10
             * @hooked :: sasabudi_footer_section_widgets - 20
             * @hooked :: sasabudi_footer_section_newsletter - 30
             */
            do_action( 'sasabudi_footer_section_content' );

          echo '</div>';
        echo '</div>';

        echo '<div class="footer-middle">';
          echo '<div class="is-wrapper">';

            /**
             * @hooked :: sasabudi_footer_section_social - 10
             * @hooked :: sasabudi_footer_section_middle - 20
             */
            do_action( 'sasabudi_footer_section_middle' );

          echo '</div>';
        echo '</div>';

        echo '<div class="footer-bottom">';
          echo '<div class="is-wrapper">';

            /**
             * @hooked :: sasabudi_footer_section_disclaimer - 10
             */
            do_action( 'sasabudi_footer_section_bottom' ); 

          echo '</div>';
        echo '</div>';

      echo '</footer>';

      /**
       * @hooked :: sasabudi_footer_app_search - 10
       * @hooked :: sasabudi_footer_app_notice - 20
       * @hooked :: sasabudi_footer_app_wishlist - 30
       * @hooked :: sasabudi_footer_app_storeselection - 40
       * @hooked :: sasabudi_footer_app_subscription - 50
       */
      do_action( 'sasabudi_footer_section_modules' );

      /** Offset Left */
      echo '<div class="offset-left">';
        echo '<aside class="offset-left__wrapper">';

          /**
           * @hooked :: sasabudi_offset_menu - 10
           * @hooked :: sasabudi_offset_filters - 20
           */
          do_action( 'sasabudi_offset_left' );

        echo '</aside">';
      echo '</div>';

      /** Offset Right */
      echo '<div class="offset-right">';
      
        /**
         * @hooked :: sasabudi_offset_cart - 10
         */
        do_action( 'sasabudi_offset_right' );

      echo '</div>';

    echo '</div>';
  
    wp_footer();

  echo '</body>';
echo '</html>';
