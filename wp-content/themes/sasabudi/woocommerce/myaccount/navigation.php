<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Hook :: Before Account Navigation
 */
do_action( 'woocommerce_before_account_navigation' );


echo '<div class="account-menu">';

  /* Account navigation */
  echo '<nav class="account-menu__navigation">';
    echo '<h3>' . esc_html__('My Account', 'sasabudi') . '</h3>';
    echo '<ul>';
      foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
        echo '<li class="' . wc_get_account_menu_item_classes( $endpoint ) .'">';
          echo '<a href="' . esc_url( wc_get_account_endpoint_url( $endpoint ) ) .'">' . esc_html( $label ) . '</a>';
        echo '</li>';
      endforeach;
    echo '</ul>';
  echo '</nav>';

  /* Account assistance */
  echo '<nav class="account-menu__assistance">';
    echo '<h3>' . esc_html__('Need Assistance?', 'sasabudi') . '</h3>';
    echo '<ul>';
      echo '<li>';
        printf( __( 'Be sure to check out our %1$s before writing an %2$s.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/faqs/')) . '">help</a>', '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">email</a>' );
      echo '</li>';
      echo '<li>' . esc_html__( 'We usually answer within 24 hours on weekdays.', 'sasabudi' ) . '</li>';
    echo '</ul>';
  echo '</nav>';
      
echo '</div>';

/**
 * Hook :: After Account Navigation
 */
do_action( 'woocommerce_after_account_navigation' );
