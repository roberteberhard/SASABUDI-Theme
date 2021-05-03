<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Arguments
$calcultate_class = ( WC()->customer->has_calculated_shipping() ) ? ' calculated_shipping' : '';

echo '<div class="cart_totals' . $calcultate_class . '">';

	/**
	 * Hook :: Before Cart Totals
	 */
	do_action( 'woocommerce_before_cart_totals' );

	echo '<table cellspacing="0" class="shop_table shop_table_responsive">';

		// Cart Summary
		echo '<tr class="cart-summary">';
			echo '<th class="left--space"></th>';
			echo '<th class="product-name"><h2>' . esc_html__( 'Summary', 'sasabudi' ) . '</h2></th>';
			echo '<th class="product-total">' . sprintf ( _n( '%d Item in your cart', '%d Items in your cart', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ) . '</th>';
			echo '<th class="right--space"></th>';
		echo '</tr>';

		// Cart Indicator
		echo '<tr class="cart-indicator">';
			echo '<th class="left--space"></th>';
			echo '<td colspan="2" class="customized">';
				echo '<div class="cart-shipping">';
					echo '<div class="cart-shipping__message">• • •</div>';
				echo '</div>';
			echo '</td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';

		// Cart Subtotal
		echo '<tr class="cart-subtotal">';
			echo '<th class="left--space"></th>';
			echo '<th>' . esc_html__( 'Subtotal', 'sasabudi' ) . '</th>';
			echo '<td data-title="' . esc_attr__( 'Subtotal', 'sasabudi' ) .'">';
				wc_cart_totals_subtotal_html();
			echo '</td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';

		// Cart Coupon
		foreach ( WC()->cart->get_coupons() as $code => $coupon ) :
			echo '<tr class="cart-discount coupon-' . esc_attr( sanitize_title( $code ) ) . '">';
				echo '<th class="left--space"></th>';
				echo '<th>';
					wc_cart_totals_coupon_label( $coupon );
				echo '</th>';
				echo '<td data-title="' . esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ) . '">';
					wc_cart_totals_coupon_html( $coupon );
				echo '</td>';
				echo '<td class="right--space"></td>';
			echo '</tr>';
		endforeach;

		// Cart Shipping
		if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) :

			/**
			 * Hook :: Cart Totals Before Shipping
			 */
			do_action( 'woocommerce_cart_totals_before_shipping' );

			wc_cart_totals_shipping_html();

			/**
			 * Hook :: Cart Totals BefAfterore Shipping
			 */
			do_action( 'woocommerce_cart_totals_after_shipping' );

		elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) :
			echo '<tr class="shipping">';
				echo '<th class="left--space"></th>';
				echo '<th>' . esc_html__( 'Shipping', 'sasabudi' ) . '</th>';
				echo '<td data-title="' . esc_attr_e( 'Shipping', 'sasabudi' ) . '">';
					woocommerce_shipping_calculator();
				echo '</td>';
				echo '<td class="right--space"></td>';
			echo '</tr>';
		endif;

		// Fees
		foreach ( WC()->cart->get_fees() as $fee ) :
			echo '<tr class="fee">';
				echo '<th class="left--space"></th>';
				echo '<th>' . esc_html( $fee->name ) . '</th>';
				echo '<td data-title="' . esc_attr( $fee->name ) . '">';
					wc_cart_totals_fee_html( $fee );
				echo '</td>';
				echo '<td class="right--space"></td>';
			echo '</tr>';
		endforeach;

		// Taxes
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
			
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ? sprintf( ' <small>' . __( '(estimated for %s)', 'sasabudi' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] ) : '';

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) :
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) :
					echo '<tr class="tax-rate tax-rate-' . esc_attr( sanitize_title( $code ) ) . '">';
						echo '<th class="left--space"></th>';
						echo '<th>' . esc_html( $tax->label ) . $estimated_text . '</th>';
						echo '<td data-title="' . esc_attr( $tax->label ) . '">';
							echo wp_kses_post( $tax->formatted_amount );
						echo '</td>';
						echo '<td class="right--space"></td>';
					echo '</tr>';
				endforeach;
			else :
				echo '<tr class="tax-total">';
					echo '<th class="left--space"></th>';
					echo '<th>' . esc_html( WC()->countries->tax_or_vat() ) . $estimated_text . '</th>';
					echo '<td data-title="' . esc_attr( WC()->countries->tax_or_vat() ) . '">';
						wc_cart_totals_taxes_total_html();
					echo '</td>';
					echo '<td class="right--space"></td>';
				echo '</tr>';
			endif;
		endif;
		
		/**
		 * Hook :: Cart Totals Before Order Total
		 */
		do_action( 'woocommerce_cart_totals_before_order_total' );

		// Order Spacer
		echo '<tr class="order-spacer">';
			echo '<th class="left--space">';
			echo '<th></th>';
			echo '<td></td>';
			echo '<td class="right--space">';
		echo '</tr>';

		// Order Total
		echo '<tr class="order-total">';
			echo '<th class="left--space"></th>';
			echo '<th>' . esc_html__( 'Total', 'sasabudi' ) . '</th>';
			echo '<td data-title="' . esc_attr__( 'Total', 'sasabudi' ) . '">';
				wc_cart_totals_order_total_html();
			echo '</td>';
			echo '<td class="right--space"></td>';
		echo '</tr>';

		/**
		 * Hook :: Cart Totals After Order Total
		 */
		do_action( 'woocommerce_cart_totals_after_order_total' );

	echo '</table>';

 	/**
	 * Hook :: Proceed To Checkout
	 */
	echo '<div class="wc-proceed-to-checkout">';
		do_action( 'woocommerce_proceed_to_checkout' );
	echo '</div>';

	/**
	 * @hooked sasabudi_cart_continue_shopping - 10
	 */
	do_action( 'sasabudi_render_continue_shopping' );

	/**
	 * Hook :: After Cart Totals
	 */
	do_action( 'woocommerce_after_cart_totals' );

echo '</div>';
