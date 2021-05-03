<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
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

echo '<div class="woocommerce-shipping-fields">';
	if ( true === WC()->cart->needs_shipping_address() ) :

		echo '<p class="form-row form-row-wide" id="ship-to-different-address">';
			// Label for Checkboxes
			echo '<label class="label-for-checkbox checkbox">';
				?>
				<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php esc_html_e( 'Ship to a different address?', 'woocommerce' ); ?></span>
				<?php
			echo '</label>';
		echo '</p>';

		echo '<div class="shipping_address">';

			/**
			* Hook :: Before Checkout Shipping Form
			*/
			do_action( 'woocommerce_before_checkout_shipping_form', $checkout );

			echo '<h3>' . esc_html__( 'Shipping details', 'sasabudi' ) . '</h3>';

			echo '<div class="woocommerce-shipping-fields__field-wrapper">';
				$fields = $checkout->get_checkout_fields( 'shipping' );
				foreach ( $fields as $key => $field ) {
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				}
			echo '</div>';

			/**
	   	 * Hook :: After Checkout Shipping Form
	   	 */
			do_action( 'woocommerce_after_checkout_shipping_form', $checkout );

		echo '</div>';

	endif;
echo '</div>';

echo '<div class="woocommerce-additional-fields">';

	/**
	 * Hook :: Before Order Notes
	 */
	do_action( 'woocommerce_before_order_notes', $checkout );

	if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) :
		if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) :
			echo '<h3>' . esc_html__( 'Additional information', 'woocommerce' ) . '</h3>';
		endif;
		echo '<div class="woocommerce-additional-fields__field-wrapper">';
			foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) :
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			endforeach;
		echo '</div>';
	endif;

	/**
	 * Hook :: After Order Notes
	 */	
	do_action( 'woocommerce_after_order_notes', $checkout );

echo '</div>';
