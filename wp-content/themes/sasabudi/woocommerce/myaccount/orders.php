<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$shop_url 		  = esc_url( get_permalink( wc_get_page_id( 'shop' ) ) );
$current_user 	= wp_get_current_user();
$display_name 	= esc_attr( $current_user->display_name );

/**
 * Hook :: Before account orders
 */
do_action( 'woocommerce_before_account_orders', $has_orders );

/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo esc_html__( 'Orders History', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper">';
  wc_print_notices();
echo '</div>';

if ( $has_orders ) :

  echo '<div class="account-orders">';

    echo '<table class="account-orders-table">';

      echo '<thead>';
        echo '<tr>';
          foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) :
            echo '<th class="woocommerce-orders-table__header woocommerce-orders-table__header-' . esc_attr( $column_id ) . '"><span class="nobr">' . esc_html( $column_name ) . '</span></th>';
          endforeach;
        echo '</tr>';
      echo '</thead>';

      echo '<tbody>';

        foreach ( $customer_orders->orders as $customer_order ) :
          $order      = wc_get_order( $customer_order );
          $item_count = $order->get_item_count() - $order->get_item_count_refunded();

          echo '<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-' . esc_attr( $order->get_status() ) .' order">';

            foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) :

              echo '<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-' . esc_attr( $column_id ) . '" data-title="' . esc_attr( $column_name ) . '">';

                if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) :

                  do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order );

                elseif ( 'order-number' === $column_id ) :

                  // order number
                  echo '<a href="' . esc_url( $order->get_view_order_url() ) . '">';
                    echo _x( '#', 'hash before order number', 'sasabudi' ) . $order->get_order_number();
                  echo '</a>';

                elseif ( 'order-date' === $column_id ) :

                  // order date
                  echo '<time datetime="' . esc_attr( $order->get_date_created()->date( 'c' ) ) . '">' . esc_html( wc_format_datetime( $order->get_date_created() ) ) . '</time>';

                elseif ( 'order-status' === $column_id ) :

                  // evaluate state
                  $color_state = 'pendingpayment';
                  $status_state = esc_html( wc_get_order_status_name( $order->get_status() ) );

                  if($status_state == 'Cancelled') {
                    $color_state = 'cancelled';
                  }
                  if($status_state == 'Completed') {
                    $color_state = 'completed';
                  }
                  if($status_state == 'Failed') {
                    $color_state = 'failed';
                  }
                  if($status_state == 'On hold') {
                    $color_state = 'onhold';
                  }
                  if($status_state == 'Pending payment') {
                    $color_state = 'pendingpayment';
                  }
                  if($status_state == 'Processing') {
                    $color_state = 'processing';
                  }
                  if($status_state == 'Refunded') {
                    $color_state = 'refunded';
                  }

                  // order status & background color
                  echo '<span class="' . $color_state . '">' . $status_state . '</span>';

                elseif ( 'order-total' === $column_id ) :

                  /* translators: 1: formatted order total 2: total order items */
                  printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'sasabudi' ), $order->get_formatted_order_total(), $item_count );

                elseif ( 'order-actions' === $column_id ) :

                  $actions = wc_get_account_orders_actions( $order );

                  // order actions
                  if ( ! empty( $actions ) ) {
                    foreach ( $actions as $key => $action ) {
                      echo '<a href="' . esc_url( $action['url'] ) . '" class="' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
                    }
                  }

                endif;

              echo '</td>';

            endforeach;

          echo '</tr>';

        endforeach;

      echo '</tbody>';

    echo '</table>';

    /**
    * Hook :: Before account orders pagination
    */
    do_action( 'woocommerce_before_account_orders_pagination' );

    if ( 1 < $customer_orders->max_num_pages ) :

      echo '<div class="woocommerce-orders-pagination">';

        if ( 1 !== $current_page ) :
          echo '<a class="orders-previous" href="' . esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ) . '">' . __( 'Prev', 'sasabudi' ) . '</a>';
        endif;

        if ( intval( $customer_orders->max_num_pages ) !== $current_page ) :
          echo '<a class="orders-next" href="' . esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ) . '">' . __( 'Next', 'sasabudi' ) . '</a>';
        endif;

      echo '</div>';

    endif;

  echo '</div>';

else :

  echo '<div class="account-orders">';

    echo '<p>';
      printf( __( '%1$s, no orders has been made yet. Please, have a look at our %2$s and get inspired.', 'sasabudi' ), '<strong>' . $display_name . '</strong>', '<a class="primary-link" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . __( 'products', 'sasabudi' ) . '</a>' );       
    echo '</p>';

    echo '<a class="button btn-auto" href="' . $shop_url. '">' . esc_html__( 'Choose a product', 'sasabudi' ) . '</a>';
  
  echo '</div>';

endif;

/**
 * Hook :: After account orders
 */
do_action( 'woocommerce_after_account_orders', $has_orders );
