<?php
/**
 * Downloads
 *
 * Shows downloads on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

$downloads     	= WC()->customer->get_downloadable_products();
$has_downloads 	= (bool) $downloads;
$shop_url 		  = esc_url( get_permalink( wc_get_page_id( 'shop' ) ) );
$current_user 	= wp_get_current_user();
$display_name 	= esc_attr( $current_user->display_name );

/**
 * Hook :: Before account downloads
 */
do_action( 'woocommerce_before_account_downloads', $has_downloads );

/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo esc_html__( 'Downloads History', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper">';
  wc_print_notices();
echo '</div>';


if ( $has_downloads ) :

  echo '<p>';
    printf ( __('%1$s track status of the order you have placed or consult the details of any order.', 'sasabudi'), '<strong>' . $display_name . '</strong>,' );
  echo '</p>';

  do_action( 'woocommerce_before_available_downloads' );

  do_action( 'woocommerce_available_downloads', $downloads );

  do_action( 'woocommerce_after_available_downloads' );

else :

  echo '<div class="account-downloads">';

    echo '<p>';
      printf( __( '%1$s, no downloads has been made yet. Please, have a look at our %2$s and get inspired.', 'sasabudi' ), '<strong>' . $display_name . '</strong>', '<a class="primary-link" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . __( 'products', 'sasabudi' ) . '</a>' );							
    echo '</p>';

    echo '<a class="button btn-auto" href="' . $shop_url . '">' . esc_html__( 'Choose a product', 'sasabudi' ) . '</a>';
  
  echo '</div>';

endif;

/**
 * Hook :: After account downloads
 */
do_action( 'woocommerce_after_account_downloads', $has_downloads );
