<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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

echo '<table class="shop_table woocommerce-checkout-review-order-table">';

	echo '<thead>';
		echo '<tr class="cart-summary">';
			echo '<th class="left--space"></th>';
			echo '<th class="product-name"><h2>' . esc_html__( 'Summary', 'sasabudi' ) . '</h2></th>';
			echo '<td class="product-total">' . sprintf ( _n( '%d Item in your cart', '%d Items in your cart', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ) . '</td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';

		// Cart Indicator
		echo '<tr class="cart-indicator">';
			echo '<th class="left--space"></th>';
			echo '<td colspan="2" class="customized">';
				echo '<div class="cart-shipping">';

					// Settings
					$packages   = WC()->cart->get_shipping_packages();
					$package    = reset( $packages );
					$zone       = wc_get_shipping_zone( $package );
					$subtotal 	= WC()->cart->get_displayed_subtotal();

					if ( WC()->cart->display_prices_including_tax() ) {
						$carttotal = round( $subtotal - ( WC()->cart->get_discount_total() + WC()->cart->get_discount_tax() ), wc_get_price_decimals() );
					} else {
						$carttotal = round( $subtotal - WC()->cart->get_discount_total(), wc_get_price_decimals() );
					}

					foreach ( $zone->get_shipping_methods( true ) as $k => $method ) {
						$shipping_amount = $method->get_option( 'min_amount' );
						$shipping_method = $method->get_option( 'title' );
						if ( $method->id == 'free_shipping' && ! empty( $shipping_amount ) && $carttotal < $shipping_amount ) {
							$remaining = $shipping_amount - $carttotal;
							echo '<div class="cart-shipping__prompt">' . sprintf(esc_html__('Almost there! Add %s to unlock %1s', 'sasabudi'), wc_price( $remaining ), $shipping_method) . '</div>';
						}
						if ( $method->id == 'free_shipping' && ! empty( $shipping_amount ) && $carttotal >= $shipping_amount ) {
							echo '<div class="cart-shipping__prompt">' . sprintf(esc_html__('%s  You have unlocked %1s!', 'sasabudi'), '<strong>Congrats!</strong>', $shipping_method ) . '</div>';
						}
					}
					
				echo '</div>';
			echo '</td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';
	echo '</thead>';

	echo '<tbody>';

		/**
		 * Hook :: Review order before cart contents
		 */
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

			$_product 	= apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id	= apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				
				// custom thumbnail
				$product_thumb = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key );
				
				// order review
				echo '<tr class="' . esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart-item', $cart_item, $cart_item_key ) ) . '">';
					echo '<th class="left--space"></td>';
					echo '<th class="product-item">';
						echo '<div class="details">';
							echo '<div class="details-image">' . $product_thumb . '</div>';
							echo '<div class="details-name">';
								echo '<div class="details-name__extended">';
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
									echo wc_get_formatted_cart_item_data( $cart_item );
								echo '</div>';
							echo '</div>';
							echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <span class="details-quantity">' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key );
						echo'</div>';
					echo '</th>';
					echo '<td class="product-total">';
						echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
					echo '</td>';
					echo '<td class="right--space"></td>';
				echo '</tr>';
			}
		}

		/**
		 * Hook :: Review order after cart contents
		 */
		do_action( 'woocommerce_review_order_after_cart_contents' );

	echo '</tbody>';

	echo '<tfoot>';

		echo '<tr class="cart-subtotal">';
			echo '<th class="left--space"></th>';
			echo '<th class="product-name">' . esc_html__( 'Subtotal', 'sasabudi' ) . '</th>';
			echo '<td class="product-name">';
				wc_cart_totals_subtotal_html();
			echo '</td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';

		foreach ( WC()->cart->get_coupons() as $code => $coupon ) :
			echo '<tr class="cart-discount coupon-' . esc_attr( sanitize_title( $code ) ) . '">';
				echo '<th class="left--space"></th>';
				echo '<th class="product-discount">';
					wc_cart_totals_coupon_label( $coupon );
				echo '</th>';
				echo '<td class="product-discount">';
					echo wc_cart_totals_coupon_html( $coupon );
				echo '</td>';
				echo '<td class="right--space"></td>';
			echo '</tr>';
		endforeach;

		if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) :

			/**
			 * Hook :: Review order before shipping
			 */
			do_action( 'woocommerce_review_order_before_shipping' );

			wc_cart_totals_shipping_html();

			/**
			 * Hook :: Review order after shipping
			 */
			do_action( 'woocommerce_review_order_after_shipping' );

		endif;

		foreach ( WC()->cart->get_fees() as $fee ) :
			echo '<tr class="fee">';
				echo '<th class="left--space"></th>';
				echo '<th>' . esc_html( $fee->name ) . '</th>';
				echo '<td>';
					wc_cart_totals_fee_html( $fee );
				echo '</td>';
				echo '<td class="right--space"></td>';
			echo '</tr>';
		endforeach;

		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) :
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) :
					echo '<tr class="tax-rate tax-rate-' . sanitize_title( $code ) . '">';
						echo '<th class="left--space"></th>';
						echo '<th>' . esc_html( $tax->label ) . '</th>';
						echo '<td>' . wp_kses_post( $tax->formatted_amount ) . '</td>';
						echo '<td class="right--space"></td>';
					echo '</tr>';
				endforeach;
			else :
				echo '<tr class="tax-total">';
					echo '<th class="left--space"></th>';
					echo '<th>' . esc_html( WC()->countries->tax_or_vat() ) . '</th>';
					echo '<td>';
						wc_cart_totals_taxes_total_html();
					echo '</td>';
					echo '<td class="right--space"></td>';
				echo '</tr>';
			endif;
		endif;

		/**
		 * Hook :: Review order before order total
		 */
		do_action( 'woocommerce_review_order_before_order_total' );

		echo '<tr class="order-spacer">';
			echo '<th class="left--space"></th>';
			echo '<th></th>';
			echo '<td></td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';

		echo '<tr class="order-total">';
			echo '<th class="left--space"></th>';
			echo '<th>' . esc_html__( 'Grand Total', 'sasabudi' ) . '</th>';
			echo '<td>';
				wc_cart_totals_order_total_html();
			echo '</td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';

		/**
		 * Hook :: Review order after order total
		 */
		do_action( 'woocommerce_review_order_after_order_total' );

	echo '</tfoot>';

echo '</table>';
