<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

echo '<div class="checkout_login">';
	echo '<div class="login-details">';

		echo '<div class="login-head">';
			echo apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'woocommerce' ) ) . ' <a href="#" class="primary-link showlogin">' . esc_html__( 'Sign in to your account', 'sasabudi' ) . '</a>';
		echo '</div>';

		echo '<div class="login-detail">';
				woocommerce_login_form(
					array(
						'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'sasabudi' ),
						'redirect' => wc_get_checkout_url(),
						'hidden'   => true,
					)
				);
		echo '</div>';

	echo '</div>';
echo '</div>';