<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}

echo '<div id="payment" class="woocommerce-checkout-payment">';

	if ( WC()->cart->needs_payment() ) :
		
		echo '<ul class="wc_payment_methods payment_methods methods">';
			
			// Payment Method
			echo '<li class="payment__method">';
				echo '<h3>' . esc_html__( 'Payment Method', 'sasabudi' ) . '</h3>';
			echo '</li>';

			// Payment Method & Info
			if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ) {
					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
				}
			} else {
				echo '<li class="payment__info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'sasabudi' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'sasabudi' ) ) . '</li>'; // @codingStandardsIgnoreLine
			}

		echo '</ul>';

	endif;

	/**
	 * Hook: woocommerce_checkout_coupon_form
	 */
	do_action( 'woocommerce_after_checkout_payment', 'woocommerce_checkout_coupon_form', 10 );
	
	/**
	 * Place Order
	 */
	echo '<div class="form-row place-order">';

		echo '<noscript>';
			esc_html_e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'sasabudi' );
			echo '<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="' . esc_attr_e( 'Update totals', 'sasabudi' ) . '">' . esc_html_e( 'Update totals', 'sasabudi' ) . '</button>';
		echo '</noscript>';

		wc_get_template( 'checkout/terms.php' );

		/**
	 	 * Hook :: Review order before submit
	 	 */
		do_action( 'woocommerce_review_order_before_submit' );

		// Button Order
		echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button btn-place-order" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine

		/**
	 	 * Hook :: Review order after submit
	 	 */
		do_action( 'woocommerce_review_order_after_submit' );

		wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' );

	echo '</div>';
	
echo '</div>';

if ( ! is_ajax() ) {
	/**
	 * Hook :: Review order after payment
	 */
	do_action( 'woocommerce_review_order_after_payment' );
}
