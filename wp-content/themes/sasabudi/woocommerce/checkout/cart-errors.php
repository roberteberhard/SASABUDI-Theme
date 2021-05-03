<?php
/**
 * Cart errors page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/cart-errors.php.
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

defined( 'ABSPATH' ) || exit;

echo '<div class="checkout-issues">';

    echo '<p>' . __( 'There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', 'sasabudi' ) . '</p>';

    /**
     * Hook : woocommerce_cart_has_errors
     */
    do_action( 'woocommerce_cart_has_errors' );

    // btn
    echo '<p><a class="button wc-backward" href="' . esc_url( wc_get_page_permalink( 'cart' ) ) . '">' . __( 'Return to cart', 'sasabudi' ) . '</a></p>';

echo '</div>';