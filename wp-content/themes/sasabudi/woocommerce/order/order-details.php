<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

/**
 * Overview Customer Details
 */
if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}

/**
 * Overview Order Downloads
 */
if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}

echo '<section class="woocommerce-order-details">';
	/**
	 * Hook: order_details_before_order_table
	 */
	do_action( 'woocommerce_order_details_before_order_table', $order );

	echo '<h2 class="woocommerce-order-details__title">' . esc_html__( 'Order details', 'sasabudi' ) . '</h2>';

	echo '<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">';

		echo '<thead>';
			echo '<tr>';
				echo '<th class="woocommerce-table__product-name product-name">' . esc_html__( 'Product', 'sasabudi' ) . '</th>';
				echo '<th class="woocommerce-table__product-table product-total">' . esc_html__( 'Total', 'sasabudi' ) . '</th>';
			echo '</tr>';
		echo '</thead>';

		echo '<tbody>';

			/**
			 * Hook: order_details_before_order_table_items
			 */	
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			}

			/**
			 * Hook: order_details_after_order_table_items
			 */	
			do_action( 'woocommerce_order_details_after_order_table_items', $order );
		
		echo '</tbody>';
		echo '<tfoot>';

			foreach ( $order->get_order_item_totals() as $key => $total ) {
				/**
				 * Update product classes
				 */
				$total_label = esc_html( $total['label'] );
				$total_value = ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] );
 
				echo '<tr>';
					echo '<th class="product-name ' . $total_label . '" scope="row">' . esc_html( $total['label'] ) . '</th>';
					echo '<td class="product-total ' . $total_label . '">' . $total_value . '</td>';
				echo '</tr>';
			}			
			
		echo '</tfoot>';
	echo '</table>';

	if ( $order->get_customer_note() ) :
		/**
		 * Update note class
		 */
		echo '<div class="order-details-note">';
			echo '<ul>';
				echo '<li class="note--name">' . esc_html__( 'Note:', 'sasabudi' ) . '</li>';
				echo '<li class="note--desc">' . wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ) . '</li>';
			echo '</ul>';
		echo '</div>';
	endif;
			
	/**
	 * Hook: order_details_after_order_table
	 */
	do_action( 'woocommerce_order_details_after_order_table', $order );

echo '</section>';

/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

