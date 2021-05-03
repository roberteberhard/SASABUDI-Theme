<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
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

defined( 'ABSPATH' ) || exit;

$totals 	= $order->get_order_item_totals();
$items 		= WC()->cart->get_cart_contents_count();

/**
 * Checkout Order Summary
 */
echo '<section class="checkout-order-summary">';

	echo '<table class="woocommerce-pay-order">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="product-name">' . __( 'Order Summary', 'sasabudi' ) . '</th>';
				if($items > 0) {
					echo '<th class="product-total">' . sprintf ( _n( '%d Item', '%d Items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ) . '</th>';
				} else {
					echo '<th class="product-total"></th>';
				}
			echo '</tr>';
		echo '</thead>';

		echo '<tbody>';

			if ( count( $order->get_items() ) > 0 ) :
				foreach ( $order->get_items() as $item_id => $item ) :

					if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
						continue;
					}
					
					// Custom thumbnail
					$image_id 			= get_post_thumbnail_id($item->get_product_id());
					$image_alt 			= get_post_meta($image_id, '_wp_attachment_image_alt', true);
					$image_url			= esc_url((wp_get_attachment_image_src($image_id, 'thumbnail')[0]));
					$product_thumb	= '<img src="' . $image_url . '" alt="' . $image_alt . '" />';

					echo '<tr class="' . esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ) . '">';
						echo '<td class="product-name">';

							// Product thumbnail & name
							echo '<div class="details">';
								echo '<div class="details-image">' . $product_thumb . '</div>';
								echo '<div class="details-name">';
									echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', esc_html( $item->get_name() ), $item, false ) );
								echo '</div>';
								echo '<span class="details-quantity">' . $item->get_quantity() . '</span>';
							echo'</div>';

							/**
							 * Hook: Order Item Meta Start
							 */
							do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

								wc_display_item_meta( $item );

							/**
							 * Hook: Order Item Meta End
							 */
							do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );

						echo '</td>';
						echo '<td class="product-subtotal">' . $order->get_formatted_line_subtotal( $item ) . '</td>';
					echo '</tr>';
				endforeach;
			endif;
		echo '</tbody>';

		echo '<tfoot>';
			if ( $totals ) :
				foreach ( $totals as $total ) :
					/**
					 * Update product classes
					 */
					$total_label = substr_replace(strtolower($total['label']), "", -1);
					echo '<tr>';
						echo '<th class="product-name ' . $total_label . '">' . $total['label'] . '</th>';
						echo '<td class="product-total ' . $total_label . '">' . $total['value'] . '</td>';
					echo '</tr>';
				endforeach;
			endif;
		echo '</tfoot>';

	echo '</table>';

echo '</section>';


/**
 * Checkout Order Payment
 */
echo '<section class="checkout-order-payment">';
	echo '<form id="order_review" class="pay-order" method="post">';

		echo '<div id="payment" class="woocommerce-review-payment">';

			if ( $order->needs_payment() ) :
				echo '<ul class="wc_payment_methods payment_methods methods">';
					/* Payment Title */
					echo '<li class="payment--method">';
						echo '<h3>' . esc_html__('Payment Method' , 'sasabudi') . '</h3>';
					echo '</li>';
					if ( ! empty( $available_gateways ) ) {
						foreach ( $available_gateways as $gateway ) {
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						}
					} else {
						echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'sasabudi' ) ) . '</li>'; // @codingStandardsIgnoreLine
					}
				echo '</ul>';
			endif;

			echo '<div class="form-row pay-order">';
				echo '<input type="hidden" name="woocommerce_pay" value="1" />';
				wc_get_template( 'checkout/terms.php' );

				/**
				 * Hook: Pay order before submit
				 */
				do_action( 'woocommerce_pay_order_before_submit' );

					// btn-pay-it
					echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class="button btn-pay-it" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine

				/**
				 * Hook: Pay order after submit
				 */
				do_action( 'woocommerce_pay_order_after_submit' );

				wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' );

			echo '</div>';
		echo '</div>';

	echo '</form>';
echo '</section>';
