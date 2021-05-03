<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

echo '<div class="product-meta">';

	/**
	 * Hook :: woocommerce_product_meta_start
	 */
	do_action( 'woocommerce_product_meta_start' );

	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :
		
		/* ACF options fields */
		$show_finale_sale = get_field('shop_product_sales', 'option');
		$finale_sales_message = get_field('shop_product_sales_final_message', 'option');
		$show_finale_sale = ($show_finale_sale == '1') ? 'active' : 'inactive';

		/**
		 * If is on 'sale mode' than show final sale message
		 */
		if( $product->is_on_sale() && $show_finale_sale == 'active' ) :
			echo "<span class='meta-final-sale'>";
				echo $finale_sales_message;
			echo "</span>";
		endif;

	endif;

	/*
	 * Hook :: woocommerce_product_meta_end
	 */
	do_action( 'woocommerce_product_meta_end' );

echo '</div>';
