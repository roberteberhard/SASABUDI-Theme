<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hook :: Before Checkout Form
 */
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo '<div class="login-required">';
		echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'sasabudi' ) );
	echo '</div>';
	return;
}

echo '<form name="checkout" method="post" class="checkout woocommerce-checkout" action="' . esc_url( wc_get_checkout_url() ) .'" enctype="multipart/form-data">';

	echo '<section class="checkout-listing">';
		if ( $checkout->get_checkout_fields() ) :

			/**
			 * Hook :: Checkout Before Customer Details
			 */
			do_action( 'woocommerce_checkout_before_customer_details' );

			echo '<div class="col2-set" id="customer_details">';

				echo '<div class="col-1">';

					/**
					 * Hook :: Checkout Billing
						*/
					do_action( 'woocommerce_checkout_billing' );

				echo '</div>';

				echo '<div class="col-2">';

					/**
					 * Hook :: Checkout Shipping
					 */
					do_action( 'woocommerce_checkout_shipping' );

				echo '</div>';

			echo '</div>';

			/**
			 * Hook :: Checkout After Customer Details
			 */
			do_action( 'woocommerce_checkout_after_customer_details' );

		endif;
	echo '</section>';	
	

	echo '<section class="checkout-collateral">';

		/**
		 * Hook :: Checkout Before Order Review
		 */
		do_action( 'woocommerce_checkout_before_order_review' );

		echo '<div id="order_review" class="woocommerce-checkout-review-order">';

			/**
			 * Hook :: Checkout Order Review
			 */
			do_action( 'woocommerce_checkout_order_review' );

		echo '</div>';

		/**
		 * Hook :: Checkout After Order Review
		 */
		do_action( 'woocommerce_checkout_after_order_review' );

	echo '</section>';

echo '</form>';

/**
 * Hook :: After Checkout Form
 */
echo do_action( 'woocommerce_after_checkout_form', $checkout );


/**
 * Tag type: FB Event / initiateCheckout
 */
?>

<script>
dataLayer.push({
  'event': 'initiateCheckout',
  'contents': [ // Used for Facebook!
    { 
      'id': 'a',
      'product': 'b',
      'quantity': 'c'
    }
  ]
});
</script>
