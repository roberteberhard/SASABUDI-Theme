<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo esc_html__( 'Order Receipt', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper">';
  wc_print_notices();
echo '</div>';

echo '<div class="account-order">';

  echo '<h2 class="orders-title">';
    printf( esc_html__( 'Receipt for your order %1$s', 'sasabudi' ),'#' . $order->get_order_number() );
  echo '</h2>';

  echo '<p class="orders-heading heading--details">';
    /* translators: 1: order number 2: order date 3: order status */
    $status_state = wc_get_order_status_name( $order->get_status() );
    printf(
      esc_html__( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'sasabudi' ),
      '<mark class="order-number">' . $order->get_order_number() . '</mark>',
      '<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
      '<mark class="order-status ' . strtolower($status_state) . '">' . $status_state . '</mark>'
    );
  echo '</p>';

  /**
   * Order Zone
   */
  $order_id = $order->get_order_number();
  $order    = wc_get_order($order_id);
  foreach( $order->get_items( 'shipping' ) as $item_id => $item ){
    // $order_item_name             = $item->get_name();
    // $order_item_type             = $item->get_type();
    $shipping_method_title = $item->get_method_title();
    // $shipping_method_id          = $item->get_method_id(); // The method ID
    // $shipping_method_instance_id = $item->get_instance_id(); // The instance ID
    // $shipping_method_total       = $item->get_total();
    // $shipping_method_total_tax   = $item->get_total_tax();
    // $shipping_method_taxes       = $item->get_taxes();
  }

  /**
   * Order States
   */
  if ($status_state == 'Cancelled') {
    echo '<p class="order-states cancelled">';
      echo esc_html__( 'Cancelled by an admin or by you, the customer – no further action required.', 'sasabudi' );
    echo '</p>';
  }
    else if ($status_state == 'Completed') {
      echo '<p class="order-states completed">';
      if( $shipping_method_title == 'U.S. Shipping' OR $shipping_method_title == 'U.S. Free shipping') {
        echo esc_html__( 'Good news! Your order is on its way. US orders may take 3-4 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
      else if ( $shipping_method_title == 'Canadian Shipping' OR $shipping_method_title == 'Canadian Free Shipping') {
        echo esc_html__( 'Good news! Your order is on its way. Orders from Canada may take 3-7 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
      else if ( $shipping_method_title == 'EU Shipping' OR $shipping_method_title == 'EU Free Shipping') {
        echo esc_html__( 'Good news! Your order is on its way. European orders may take 6-8 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
      else if ( $shipping_method_title == 'UK Shipping' OR $shipping_method_title == 'UK Free shipping') {
        echo esc_html__( 'Good news! Your order is on its way. Orders from the UK may take 6-10 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
      else if ( $shipping_method_title == 'EFTA Shipping' OR $shipping_method_title == 'EFTA Free shipping') {       
        echo esc_html__( 'Good news! Your order is on its way. Orders from EFTA countries may take 6-10 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
      else if ( $shipping_method_title == 'Japan Shipping' OR $shipping_method_title == 'Japan Free Shipping') {   
        echo esc_html__( 'Good news! Your order is on its way. Japanese orders may take 4-8 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
      else if ( $shipping_method_title == 'Australian Shipping' OR $shipping_method_title == 'Australian Free Shipping') { 
        echo esc_html__( 'Good news! Your order is on its way. Orders from Australia/New Zealand may take 2-14 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
      else {
        echo esc_html__( 'Good news! Your order is on its way. International orders may take 10-20 business days to arrive. Please let us know if there are any delays in receiving your order.', 'sasabudi' );
      }
    echo '</p>';
  }
  else if ($status_state == 'Failed') {
    echo '<p class="order-states failed">';
      echo esc_html__( 'The payment failed or was rejected. Note that this status may not be displayed immediately, and instead will be displayed as "Pending" until it is verified (e.g. by PayPal).', 'sasabudi' );
    echo '</p>';
  }
  else if ($status_state == 'On hold') {
    echo '<p class="order-states onhold">';
      echo esc_html__( 'Awaiting payment - ready to print and process, but you still need to confirm payment.', 'sasabudi' );
    echo '</p class="order-states">';
  }
  else if ($status_state == 'Pending payment') {
    echo '<p class="order-states pendingpayment">';
      echo esc_html__( 'Order received - payment pending. After payment is received, the printing and fulfillment process will be started.', 'sasabudi' );
    echo '</p>';
  }
  else if ($status_state == 'Processing') {
    echo '<p class="order-states processing">';
      echo esc_html__( 'Payment received - order awaiting fulfillment. All product orders must be processed except those that are digital and downloadable.', 'sasabudi' );
    echo '</p>';
  }
  else if ($status_state == 'Refunded') {
    echo '<p class="order-states refunded">';
      echo esc_html__( 'Refunded by an administrator – no further action required.', 'sasabudi' );
    echo '</p>';
  }

  /**
   * Oder Updates (messages)
   */
  if ( $notes = $order->get_customer_order_notes() ) :
    echo '<section class="woocommerce-order-updates">';
      echo '<h2>' . esc_html__( 'Order updates', 'sasabudi' ) . '</h2>';
      echo '<ol class="woocommerce-OrderUpdates commentlist notes">';
        foreach ( $notes as $note ) :
          echo '<li class="woocommerce-OrderUpdate comment note">';
            echo '<div class="woocommerce-OrderUpdate-inner comment_container">';
              echo '<div class="woocommerce-OrderUpdate-text comment-text">';
                echo '<p class="woocommerce-OrderUpdate-meta meta">' . date_i18n( esc_html__( 'l jS \o\f F Y, h:ia', 'sasabudi' ), strtotime( $note->comment_date ) ) . '</p>';
                echo '<div class="woocommerce-OrderUpdate-description description">';
                  echo wpautop( wptexturize( $note->comment_content ) );
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</li>';
        endforeach;
      echo '</ol>';
    echo '</section>';
  endif;
   
  /**
   * Hook: woocommerce_view_order
   */
  do_action( 'woocommerce_view_order', $order_id );

echo '</div>';
