<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;

echo '<div class="woocommerce-billing-fields">';

	if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) :
		echo '<h3>' . esc_html__( 'Billing &amp; Shipping', 'sasabudi' ) . '</h3>';
	else :
		echo '<h3>' . esc_html__( 'Billing details', 'sasabudi' ) . '</h3>';
  endif;
  
  /**
	 * Hook :: Before Checkout Billing Form
	 */
	do_action( 'woocommerce_before_checkout_billing_form', $checkout );

	$signed = is_user_logged_in() ? ' signed' : '';
	echo '<div class="woocommerce-billing-fields__field-wrapper' . $signed . '">';
		$fields = $checkout->get_checkout_fields( 'billing' );
		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
  echo '</div>';

  /**
	 * Hook :: After Checkout Billing Form
	 */
	do_action( 'woocommerce_after_checkout_billing_form', $checkout );

echo '</div>';


// Registration
if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) :
	echo '<div class="woocommerce-account-fields">';
		
		if ( ! $checkout->is_registration_required() ) :
			echo '<p class="form-row form-row-wide create-account">';
				// Label for Checkbox
				echo '<label class="woocommerce-form__label woocommerce-form__label-for-checkbox label-for-checkbox checkbox">';
					echo '<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount"' . checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) . ' type="checkbox" name="createaccount" value="1" /> <span>' . __( 'Create an account?', 'sasabudi' ) . '</span>';
				echo '</label>';
			echo '</p>';
		endif;

		/**
		 * Hook :: Before Checkout Registration Form
		 */
		do_action( 'woocommerce_before_checkout_registration_form', $checkout );

		if ( $checkout->get_checkout_fields( 'account' ) ) :
			echo '<div class="create-account">';				
				foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) :
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				endforeach;
			echo '</div>';
		endif;

		/**
		 * Hook :: After Checkout Registration Form
		 */
		do_action( 'woocommerce_after_checkout_registration_form', $checkout );

	echo '</div>';	
endif;
