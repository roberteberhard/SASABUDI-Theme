<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

echo '<div class="woocommerce-variation-add-to-cart variations_button">';
	
	/** 
	 * Hook :: woocommerce_before_add_to_cart_quantity
	 */
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	/** 
	 * Hook :: woocommerce_after_add_to_cart_quantity
	 */
	do_action( 'woocommerce_after_add_to_cart_quantity' );

	/* Complete out of stock button toggle text */
	$add_to_card_text =  $product->is_in_stock() ? esc_html( $product->single_add_to_cart_text() ) : esc_html__( 'Out of stock', 'sasabudi' );
	echo '<button type="submit" class="button single_add_to_cart_button"><span class="cart-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><circle cx="8" cy="20" r="2"></circle><circle cx="18" cy="20" r="2"></circle><path d="M19,17H7a1,1,0,0,1-1-.78L3.2,4H2A1,1,0,0,1,2,2H4a1,1,0,0,1,1,.78L7.8,15H18.2L20,6.78a1,1,0,0,1,2,.44l-2,9A1,1,0,0,1,19,17Z"></path><path d="M16,6H14V4a1,1,0,0,0-2,0V6H10a1,1,0,0,0,0,2h2v2a1,1,0,0,0,2,0V8h2a1,1,0,0,0,0-2Z"></path></svg></span>' . $add_to_card_text . '</button>';
	
	/** 
	 * Hook :: woocommerce_after_add_to_cart_button
	 */
	do_action( 'woocommerce_after_add_to_cart_button' );

	echo '<input type="hidden" name="add-to-cart" value="' . absint( $product->get_id() ) . '" />';
	echo '<input type="hidden" name="product_id" value="' . absint( $product->get_id() ) . '" />';
	echo '<input type="hidden" name="variation_id" class="variation_id" value="0" />';

echo '</div>';
