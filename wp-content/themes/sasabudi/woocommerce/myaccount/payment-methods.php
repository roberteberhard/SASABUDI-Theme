<?php
/**
 * Payment methods
 *
 * Shows customer payment methods on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/payment-methods.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$saved_methods  = wc_get_customer_saved_methods_list( get_current_user_id() );
$has_methods    = (bool) $saved_methods;
$types          = wc_get_account_payment_methods_types();
$current_user   = wp_get_current_user();
$display_name   = esc_attr( $current_user->display_name );

/**
 * Hook :: Before account payment methods
 */
do_action( 'woocommerce_before_account_payment_methods', $has_methods );

/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo esc_html__( 'Payment Methods', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper">';
  wc_print_notices();
echo '</div>';

echo '<div class="account-payment">';

  if ( $has_methods ) :

    echo '<table class="woocommerce-MyAccount-paymentMethods shop_table shop_table_responsive account-payment-methods-table">';
      echo '<thead>';
        echo '<tr>';
          foreach ( wc_get_account_payment_methods_columns() as $column_id => $column_name ) :
            echo '<th class="woocommerce-PaymentMethod woocommerce-PaymentMethod--' .  esc_attr( $column_id ) . ' payment-method-' . esc_attr( $column_id ) . '"><span class="nobr">' . esc_html( $column_name ) . '</span></th>';
          endforeach;
        echo '</tr>';
      echo '</thead>';
      foreach ( $saved_methods as $type => $methods ) :
        foreach ( $methods as $method ) :
          
          $default_class = ! empty( $method['is_default'] ) ? ' default-payment-method' : '';

          echo '<tr class="payment-method' . $default_class . '">';
            foreach ( wc_get_account_payment_methods_columns() as $column_id => $column_name ) :
              echo '<td class="woocommerce-PaymentMethod woocommerce-PaymentMethod--' . esc_attr( $column_id ) . ' payment-method-' . esc_attr( $column_id ) . '" data-title="' . esc_attr( $column_name ) . '">';
                if ( has_action( 'woocommerce_account_payment_methods_column_' . $column_id ) ) {
                  do_action( 'woocommerce_account_payment_methods_column_' . $column_id, $method );
                } elseif ( 'method' === $column_id ) {
                  if ( ! empty( $method['method']['last4'] ) ) {
                    /* translators: 1: credit card type 2: last 4 digits */
                    echo sprintf( esc_html__( '%1$s ending in %2$s', 'woocommerce' ), esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) ), esc_html( $method['method']['last4'] ) );
                  } else {
                    echo esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) );
                  }
                } elseif ( 'expires' === $column_id ) {
                  echo esc_html( $method['expires'] );
                } elseif ( 'actions' === $column_id ) {
                  foreach ( $method['actions'] as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                    echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>&nbsp;';
                  }
                }
              echo '</td>';          
            endforeach;
          echo '</tr>';
        endforeach;
      endforeach;
    echo '</table>';

  else :
    echo '<div class="account-payment__empty">';
      echo '<p>';
        printf( __( '%1$s, no saved methods found.', 'sasabudi' ), '<strong>' . $display_name . '</strong>', '<a class="primary-link" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . __( 'products', 'sasabudi' ) . '</a>' );       
      echo '</p>';
    echo '</div>';
  endif;
  
  /**
    * Hook :: After account payment methods
    */
  do_action( 'woocommerce_after_account_payment_methods', $has_methods );
  
  if ( WC()->payment_gateways->get_available_payment_gateways() ) :
    echo '<a class="button btn-auto" href="' . esc_url( wc_get_endpoint_url( 'add-payment-method' ) ) . '">' . esc_html__( 'Add payment method', 'woocommerce' ) . '</a>';
  endif;

echo '</div>';
