<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
  $get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
    'billing' => __( 'Billing address', 'sasabudi' ),
    'shipping' => __( 'Shipping address', 'sasabudi' ),
  ), $customer_id );
} else {
  $get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
    'billing' => __( 'Billing address', 'sasabudi' ),
  ), $customer_id );
}

$oldcol = 1;
$col    = 1;

echo '<div class="account-address">';

  echo '<p>' . apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default:', 'sasabudi' ) ) . '</p>';
  
  /* Start 2 Address columns */
  if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) :
    echo '<div class="addresses">';
  endif;

  foreach ( $get_addresses as $name => $title ) :

    echo '<div class="address-column' . ( ( ( $col = $col * -1 ) < 0 ) ? 1 : 2 ) . ' col-' . ( ( ( $oldcol = $oldcol * -1 ) < 0 ) ? 1 : 2 ) . ' woocommerce-Address">';

      echo '<header>';
        echo '<h3>' . $title . '</h3>';
        echo '<span class="spacer">/</span>';
        echo '<a href="' . esc_url( wc_get_endpoint_url( 'edit-address', $name ) ) . '" class="edit">' . esc_html__( 'Edit', 'sasabudi' ) . '</a>';
      echo '</header>';

      echo '<address>';
        $address = wc_get_account_formatted_address( $name );
        echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'sasabudi' );
      echo '</address>';
      
    echo '</div>';

  endforeach;

  /* End 2 Address columns */
  if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) :
    echo '</div>';
  endif;

echo '</div>';
