<?php
/**
 * The template for displaying the 'help' pages.
 *
 * Template name: Page-Help
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  $locale = get_locale();
  $is_page_help = '';
  $is_page_contact = '';
  $is_page_ordering = '';
  $is_page_shipping = '';
  $is_page_returns = '';
  $is_page_payment = '';
  $is_page_promotions = '';
  $is_page_sizeguide = '';
  $is_page_account = '';
  $is_page_hashtag = '';

  switch ($locale) {
    default:
      // -> English
      $is_page_help = is_page( array('help', 'faqs'));
      $is_page_contact = is_page( 'contact' );
      $is_page_ordering = is_page( 'ordering' );
      $is_page_shipping = is_page( 'shipping' );
      $is_page_returns = is_page( 'returns' );
      $is_page_payment = is_page( 'payment' );
      $is_page_promotions = is_page( 'promotions' );
      $is_page_sizeguide = is_page( 'size-guide' );
      $is_page_account = is_page( 'account' );
      $is_page_hashtag = is_page( 'hashtag' );
  }

  // Active page states
  $help_active = ($is_page_help == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $contact_active = ($is_page_contact == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $ordering_active = ($is_page_ordering == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $shipping_active = ($is_page_shipping == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $returns_active = ($is_page_returns == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $payment_active = ($is_page_payment == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $promotions_active = ($is_page_promotions == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $sizeguide_active = ($is_page_sizeguide == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $account_active = ($is_page_account == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
  $hashtag_active = ($is_page_hashtag == 1) ? ' class="support-menu__link is-active"' : ' class="support-menu__link"';
 
  echo '<main class="main is-support">';
    echo '<div class="support">';

      /* Support Menu */
      echo '<div class="support-menu">';

        echo '<nav class="support-menu__navigation">';
          echo '<h3>' . esc_html__('Help & Contact', 'sasabudi') . '</h3>';
          echo '<ul>';
            switch ($locale) {
              default:
                // -> English
                echo '<li' . $help_active . '><a href="' . esc_url(home_url('/help/faqs/')) . '">' . esc_html__( "FAQs", 'sasabudi' ) . '</a></li>';
                echo '<li' . $contact_active . '><a href="' . esc_url(home_url('/help/contact/')) . '">' . esc_html__( 'Contact', 'sasabudi' ) . '</a></li>';	
                echo '<li' . $ordering_active . '><a href="' . esc_url(home_url('/help/ordering/')) . '">' . esc_html__( 'Ordering', 'sasabudi' ) . '</a></li>'; 
                echo '<li' . $shipping_active . '><a href="' . esc_url(home_url('/help/shipping/')) . '">' . esc_html__( 'Shipping', 'sasabudi' ) . '</a></li>';
                echo '<li' . $returns_active . '><a href="' . esc_url(home_url('/help/returns/')) . '">' . esc_html__( 'Returns', 'sasabudi' ) . '</a></li>';
                echo '<li' . $payment_active . '><a href="' . esc_url(home_url('/help/payment/')) . '">' . esc_html__( 'Payment', 'sasabudi' ) . '</a></li>';
                echo '<li' . $promotions_active . '><a href="' . esc_url(home_url('/help/promotions/')) . '">' . esc_html__( 'Promotions', 'sasabudi' ) . '</a></li>';
                echo '<li' . $sizeguide_active . '><a href="' . esc_url(home_url('/help/size-guide/')) . '">' . esc_html__( 'Size Guide', 'sasabudi' ) . '</a></li>';
                echo '<li' . $account_active . '><a href="' . esc_url(home_url('/help/account/')) . '">' . esc_html__( 'Account', 'sasabudi' ) . '</a></li>';
                echo '<li' . $hashtag_active . '><a href="' . esc_url(home_url('/help/hashtag/')) . '">' . esc_html__( '#SASABUDI', 'sasabudi' ) . '</a></li>';
            }
          echo '</ul>';
        echo '</nav>';

        echo '<nav class="support-menu__assistance">';
          echo '<h3>' . esc_html__('Need Assistance?', 'sasabudi') . '</h3>';
          echo '<ul>';
            echo '<li>';
              printf( esc_html__( 'Be sure to check out our %1$s before writing an %2$s.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/policies/terms-of-service/')) . '">policies</a>', '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">email</a>' );
            echo '</li>';
            echo '<li>' . esc_html__( 'We usually answer within 24 hours on weekdays.', 'sasabudi' ) . '</li>';
          echo '</ul>';
        echo '</nav>';

      echo '</div>';

      /**
       * Support Content
       */
      echo '<div class="support-content">';

        while ( have_posts() ) : the_post();
          the_content();
        endwhile;

        if($is_page_help) {
          // help
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'help' );		
          }
        } else if($is_page_contact) {
          // Contact us
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'contact' );	
          }
        } else if($is_page_ordering) {
          // Ordering
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'ordering' );
          }
        } else if($is_page_shipping) {
          // Shipping
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'shipping' );	
          }
        } else if($is_page_returns) {    
          // Return
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'returns' );
          }
        } else if($is_page_payment) {
          // Payment
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'payment' );
          }
        } else if($is_page_promotions) {
          // Payment
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'promotions' );
          }
        } else if($is_page_sizeguide) {
          // Size Guide
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'sizeguide' );
          }
        } else if($is_page_account) {
          // Size Guide
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'account' );
          }
        } else if($is_page_hashtag) {
          // Size Guide
          switch ($locale) {
            default:
              // -> English
              get_template_part( 'templates/article-support', 'hashtag' );
          }
        }
      echo '</div>';

    echo '</div>';

    /** 
     * @hooked :: sasabudi_product_single_recently_viewed - 10
     * @hooked :: sasabudi_home_products_statement - 20
     */
    do_action( 'sasabudi_render_help_page' );
  
  echo '</main>';

get_footer();