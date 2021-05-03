<?php
/**
 * Add payment method form form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-add-payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

$available_gateways = WC()->payment_gateways->get_available_payment_gateways();


/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo esc_html__( 'Add Payment Methods', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper">';
  wc_print_notices();
echo '</div>';

echo '<div class="account-payment">';

	if ( $available_gateways ) :

		// Explanation
		echo '<p class="account-payment__desc">' . esc_html__('Add your credit card information that will be used on the checkout page:', 'sasabudi') . '</p>';

		echo '<form id="add_payment_method" method="post">';
			echo '<div id="payment" class="woocommerce-Payment">';
				echo '<ul class="woocommerce-PaymentMethods payment_methods methods">';

					// Chosen Method.
					if ( count( $available_gateways ) ) {
						current( $available_gateways )->set_current();
					}

					foreach ( $available_gateways as $gateway ) {
						?>
						<li class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr( $gateway->id ); ?> payment_method_<?php echo esc_attr( $gateway->id ); ?>">
							<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
							<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>"><?php echo wp_kses_post( $gateway->get_title() ); ?> <?php echo wp_kses_post( $gateway->get_icon() ); ?></label>
							<?php
							if ( $gateway->has_fields() || $gateway->get_description() ) {
								echo '<div class="woocommerce-PaymentBox woocommerce-PaymentBox--' . esc_attr( $gateway->id ) . ' payment_box payment_method_' . esc_attr( $gateway->id ) . '" style="display: none;">';
								$gateway->payment_fields();
								echo '</div>';
							}
						echo '</li>';
					}
				echo '</ul>';

				/**
				 * Hook :: add_payment_method_form_bottom
				 */
				do_action( 'woocommerce_add_payment_method_form_bottom' );

				echo '<div class="form-row">';
					wp_nonce_field( 'woocommerce-add-payment-method', 'woocommerce-add-payment-method-nonce' );
					echo '<button type="submit" class="woocommerce-Button woocommerce-Button--alt button alt" id="place_order" value="' . esc_attr__( 'Add payment method', 'woocommerce' ) . '">' . esc_html__( 'Add payment method', 'woocommerce' ) . '</button>';
					echo '<input type="hidden" name="woocommerce_add_payment_method" id="woocommerce_add_payment_method" value="1" />';
				echo '</div>';

			echo '</div>';
		echo '</form>';

	else :
		echo '<p class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . esc_html__( 'New payment methods can only be added during checkout. Please contact us if you require assistance.', 'woocommerce' ) . '</p>';
	endif;

echo '</div>';
