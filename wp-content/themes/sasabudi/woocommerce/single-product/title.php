<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product;
		
// Settings
$product_sales 	= '0';
$product_sales 	= get_field('shop_product_sales', 'option');
$product_sales 	= ($product_sales == '1') ? true : false;
$product_terms 	= wp_get_post_terms($post->ID, 'product_cat');
$category_terms = array_slice($product_terms, 1, 1);

if ( $product->is_on_sale() && $product_sales ) {
	
	// Show the product title with the sale expression
	// if($category_terms && !is_wp_error($category_terms)) {
	// $attribute_type = get_the_terms($post->ID, 'pa_model', array('hide_empty'=>true));
	// $attribute_name = substr($attribute_type[0]->name, 0, -1); // remove last character
	// $attribute_name = $attribute_type[0]->name;
	// echo '<h4 class="term-title">' . $attribute_name . '</h4>';
	// }
	echo '<h1 itemprop="name" class="product-title">' . esc_html( get_the_title() ) . '<span> - </span><span class="item-sale">' . __( 'Sale', 'sasabudi' ) . '</span></h1>';

} else {

	// Show the product title with the sale expression
	// if($category_terms && !is_wp_error($category_terms)) {
	// $attribute_type = get_the_terms($post->ID, 'pa_model', array('hide_empty'=>true));
	// if( isset($attribute_type[0]) ) {
	// $attribute_name = substr($attribute_type[0]->name, 0, -1); // remove last character
	// $attribute_name = $attribute_type[0]->name;
	// echo '<h4 class="term-title">' . $attribute_name . '</h4>';
	// }
	// }
	echo '<h1 itemprop="name" class="product-title">' . esc_html( get_the_title() ) . '</h1>';			
}