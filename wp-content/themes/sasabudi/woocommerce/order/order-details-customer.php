<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;


$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();

echo '<section class="woocommerce-customer-details">';

	// Customer details
	echo '<section class="woocommerce-columns">';
		
		echo '<h2 class="woocommerce-column__title">' . esc_html__( 'Customer Details', 'sasabudi' ) . '</h3>';
		
		echo '<div class="customer-details">';
			// Email
			if ( $order->get_billing_email() ) :
				echo '<div class="customer-details__name">' . esc_html__( 'Email:', 'sasabudi' ) . '</div>';
				echo '<div class="customer-details__email">' . esc_html__( $order->get_billing_email() ) . '</div>';
			endif;
			// Phone
			if ( $order->get_billing_phone() ) :
				echo '<div class="customer-details__name">' . esc_html__( 'Phone:', 'sasabudi' ) . '</div>';
				echo '<div class="customer-details__phone">' . esc_html__( $order->get_billing_phone() ) . '</div>';
			endif;
		echo '</div>';

	echo '</section>';

	if ( $show_shipping ) :

		echo '<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">';
			echo '<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">';

	endif;

	// h3
	echo '<h3 class="woocommerce-column__title">' . esc_html__( 'Billing address', 'sasabudi' ) . '</h3>';

	echo '<address>';
		echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'sasabudi' ) ) );
	echo '</address>';

	if ( $show_shipping ) :

		echo '</div>';

		echo '<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">';
			echo '<h3 class="woocommerce-column__title">' . esc_html__( 'Shipping address', 'sasabudi' ) . '</h3>';
			echo '<address>';
				echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'sasabudi' ) ) );
			echo '</address>';
		echo '</div>';

	echo '</section>';

	endif;

	/**
	 * Hook :: Order Details After Customer Details
	 */
	do_action( 'woocommerce_order_details_after_customer_details', $order );

echo '</section>';
