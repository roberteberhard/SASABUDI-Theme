<?php
/**
 * The template for displaying the 'policy' pages.
 *
 * Template name: Page-Policy
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  // $locale = get_locale() ? get_locale() : 'en_US';
  $is_page_terms = '';
  $is_page_privacy = '';
  $is_page_cookies = '';
  $is_page_imprint = '';
  $is_page_disclaimer = '';

  // Select pages
  $is_page_terms = is_page( array('policies', 'terms-of-service'));
  $is_page_privacy = is_page( 'privacy-policy' );
  $is_page_cookies = is_page( 'cookie-policy' );
  $is_page_imprint = is_page( 'legal-notice' );
  $is_page_disclaimer = is_page( 'disclaimer' );

  // Active page states
  $terms_active = ($is_page_terms == 1) ? ' class="policy-menu__link is-active"' : ' class="policy-menu__link"';
  $privacy_active = ($is_page_privacy == 1) ? ' class="policy-menu__link is-active"' : ' class="policy-menu__link"';
  
  $cookies_active = ($is_page_cookies == 1) ? ' class="policy-menu__link is-active"' : ' class="policy-menu__link"';
  $imprint_active = ($is_page_imprint == 1) ? ' class="policy-menu__link is-active"' : ' class="policy-menu__link"';
  $disclaimer_active = ($is_page_disclaimer == 1) ? ' class="policy-menu__link is-active"' : ' class="policy-menu__link"';

  echo '<main class="main is-policy" role="main">';
    echo '<div class="policy">';

      /**
       * Policy Menu
       */ 
      echo '<div class="policy-menu">';

        echo '<nav class="policy-menu__navigation">';
          echo '<h3>' . esc_html__('Terms & Policies', 'sasabudi') . '</h3>';
          echo '<ul>';
            echo '<li' . $terms_active . '><a href="' . esc_url(home_url('/policies/terms-of-service')) . '">' . esc_html__( 'Terms of Service', 'sasabudi' ) . '</a></li>';
            echo '<li' . $privacy_active . '><a href="' . esc_url(home_url('/policies/privacy-policy')) . '">' . esc_html__( 'Privacy Policy', 'sasabudi' ) . '</a></li>';
            echo '<li' . $cookies_active . '><a href="' . esc_url(home_url('/policies/cookie-policy')) . '">' . esc_html__( 'Cookie Policy', 'sasabudi' ) . '</a></li>';
            echo '<li' . $imprint_active . '><a href="' . esc_url(home_url('/policies/legal-notice')) . '">' . esc_html__( 'Legal Notice', 'sasabudi' ) . '</a></li>';
            echo '<li' . $disclaimer_active . '><a href="' . esc_url(home_url('/policies/disclaimer')) . '">' . esc_html__( 'Disclaimer', 'sasabudi' ) . '</a></li>';	
          echo '</ul>';
        echo '</nav>';

        echo '<nav class="policy-menu__assistance">';
          echo '<h3>' . esc_html__('Need Assistance?', 'sasabudi') . '</h3>';
          echo '<ul>';
              echo '<li>';
                printf( esc_html__( 'Be sure to check out our %1$s before writing an %2$s.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/faqs/')) . '">help</a>', '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">email</a>' );
              echo '</li>';
              echo '<li>' . esc_html__( 'We usually answer within 24 hours on weekdays.', 'sasabudi' ) . '</li>';
          echo '</ul>';
        echo '</nav>';

      echo '</div>';



      echo '<div class="policy-content">';

        while ( have_posts() ) : the_post();
          the_content();  
        endwhile;

        /**
         * Policy Temlates filtered by cookie value!
         */
        $cookie_name  = 'wp_store_selector_UgNz4K';
        $cookie_value = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';
     
        if($is_page_terms) {
          get_template_part( 'templates/article-policy', 'terms' );	
        }
        else if($is_page_privacy) {
          switch ($cookie_value) {
            case 'ejuksw': // United States
              get_template_part( 'templates/article-policy', 'privacy-gdpr-us-en' );
              break;
            case 'gewokx': // Canada
              get_template_part( 'templates/article-policy', 'privacy-gdpr-ca-en' );
              break;
            case 'jeuzew': // Europe
              get_template_part( 'templates/article-policy', 'privacy-gdpr-eu-en' );
              break;
            case 'awqoir': // United Kingdom
              get_template_part( 'templates/article-policy', 'privacy-gdpr-uk-en' );
              break;
            default: // Europe for worldwide
              get_template_part( 'templates/article-policy', 'privacy-gdpr-eu-en' );	
          }
        }
        else if($is_page_cookies) {
          switch ($cookie_value) {
            case 'ejuksw': // United States
              get_template_part( 'templates/article-policy', 'cookie-gdpr-us-en' );
              break;
            case 'gewokx': // Canada
              get_template_part( 'templates/article-policy', 'cookie-gdpr-ca-en' );
              break;
            case 'jeuzew': // Europe
              get_template_part( 'templates/article-policy', 'cookie-gdpr-eu-en' );
              break;
            case 'awqoir': // United Kingdom
              get_template_part( 'templates/article-policy', 'cookie-gdpr-uk-en' );
              break;
            default: // Europe for worldwide
              get_template_part( 'templates/article-policy', 'cookie-gdpr-eu-en' );	
          }  
        }
        else if($is_page_imprint) {
          get_template_part( 'templates/article-policy', 'imprint' );	
        }
        else if($is_page_disclaimer) {
          get_template_part( 'templates/article-policy', 'disclaimer' );	
        }
      echo '</div>';

    echo '</div>';

    /** 
      * @hooked :: sasabudi_home_products_statement - 10
      */
    do_action( 'sasabudi_render_policy_page' );

  echo '</main>'; 

get_footer();
