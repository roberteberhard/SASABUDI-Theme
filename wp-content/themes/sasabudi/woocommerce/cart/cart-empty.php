<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/* Print notice here */
echo '<div id="shop_notice" class="woocommerce-notices-wrapper">';
  wc_print_notices();
echo '</div>';

echo '<div class="cart-empty">';

	echo '<p>' . wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty. Have a cup of coffee or ', 'sasabudi' ) ) ) . '</p>';

	if ( wc_get_page_id( 'shop' ) > 0 ) :	
		echo '<div class="return-to-shop">';
			echo '<a class="button btn-short" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">';
				echo esc_html__( 'Continue Shopping', 'sasabudi' );
			echo '</a>';
		echo '</div>';
	endif;

echo '</div>';
