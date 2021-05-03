<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

echo '<form class="checkout_coupon woocommerce-form-coupon" method="post">';
	
	/** Coupon Text **/
	echo '<p class="form-coupon-label">' . esc_html__( 'If you have a coupon code, please apply it below', 'sasabudi' ) . '</p>';
	echo '<p class="form-row form-row-first">';
		echo '<input type="text" name="coupon_code" class="input-text" placeholder="' . esc_attr__( 'Coupon code', 'sasabudi' ) . '" id="coupon_code" value="" />';
	echo '</p>';

	/** Coupon Class Btn & Text**/
	echo '<p class="form-row form-row-last">';
		echo '<button type="submit" class="button btn" name="apply_coupon" value="' . esc_attr__( 'Apply coupon', 'sasabudi' ) . '">' . esc_html__( 'Apply', 'sasabudi' ) . '</button>';
	echo '</p>';

echo '</form>';
