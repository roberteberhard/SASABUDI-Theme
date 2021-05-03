<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}

echo '<tr class="' . esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ) . '">';
	
	echo '<td class="woocommerce-table__product-name product-name">';

		$is_visible        	= $product && $product->is_visible();
		$product_permalink 	= apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
		$qty          			= $item->get_quantity();
		$refunded_qty 			= $order->get_qty_refunded_for_item( $item_id );
		$product_id 				= $product->get_id();

		if ( $refunded_qty ) {
			$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
		} else {
			$qty_display = esc_html( $qty );
		}

		// Custom thumbnail
		$image_id 			= get_post_thumbnail_id($product_id);
		$image_alt 			= get_post_meta($image_id, '_wp_attachment_image_alt', true);
		$image_url			= esc_url((wp_get_attachment_image_src($image_id, 'thumbnail')[0]));
		$product_thumb	= '<img src="' . $image_url . '" alt="' . $image_alt . '" />';

		// Product thumbnail & name
		echo '<div class="details">';
			echo '<div class="details-image">' . $product_thumb . '</div>';
			echo '<div class="details-name">';
				echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible );
			echo '</div>';
			echo '<span class="details-quantity">' . $qty_display . '</span>';
		echo'</div>';

		// deactivate!
		// apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $qty_display ) . '</strong>', $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

		wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );

	echo '</td>';

	echo '<td class="woocommerce-table__product-total product-total">';
		echo $order->get_formatted_line_subtotal( $item );
	echo '</td>';

echo '</tr>';

if ( $show_purchase_note && $purchase_note ) :

	echo '<tr class="woocommerce-table__product-purchase-note product-purchase-note">';
		echo '<td colspan="2">' . wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ) . '</td>';
	echo '</tr>';

endif;
