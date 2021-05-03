<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

/**
 * Hook: woocommerce_before_add_to_cart_form
 */
do_action( 'woocommerce_before_add_to_cart_form' );

echo '<form class="variations_form cart" action="' . esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ) .'" method="post" enctype="multipart/form-data" data-product_id="' . absint( $product->get_id() ) . '" data-product_variations="' . $variations_attr . '">';

	/**
	 * Hook: woocommerce_before_variations_form
	 */
	do_action( 'woocommerce_before_variations_form' );

	if ( empty( $available_variations ) && false !== $available_variations ) :

		echo '<p class="stock out-of-stock">' . esc_html__( 'This product is currently out of stock and unavailable.', 'sasabudi' ) .'</p>';

	else :

		/** Customs by Robert  **/

		echo '<div class="variations">';

			foreach ( $attributes as $attribute_name => $options ) :
				echo '<h4 class="options-' . sanitize_title( $attribute_name ) . '">Select ' . wc_attribute_label( $attribute_name ) . '</h4>';
				echo '<div class="options-content">';
					wc_dropdown_variation_attribute_options( array(
						'options'   => $options,
						'attribute' => $attribute_name,
						'product'   => $product,
					) );
				echo '</div>';
			endforeach;

			/**
			 * Wishlist setup
			 */
			 if ( !is_user_logged_in()) {
				echo '<div class="options-wishlist">';
					echo '<span class="options-wishlist__save" data-exists="signin" aria-hidden="true">Heart</span>';
				echo '</div>';
      }
      else {
				// Arguments
        $product_id = $product->get_id();
        $existingItem = new WP_Query(array(
          'author' => get_current_user_id(),
          'post_type' => 'wishlist',
          'meta_query' => array(
            array(      
              'key' => 'wp_saved_product_id',
              'compare' => '=',
              'value' => $product_id
            )
          )
        ));
        $product_exists = $existingItem->found_posts > 0 ? 'yes' : 'no';
        $product_wait = 'no';
        $wishlist_id = isset($existingItem->posts[0]->ID) ? $existingItem->posts[0]->ID : 0;

				echo '<div class="options-wishlist">';
					echo '<span class="options-wishlist__save" id="pw'. $product_id .'" data-exists="' . $product_exists . '" data-wait="' . $product_wait . '" data-saved="' . $wishlist_id  . '" data-item="'. $product_id .'" aria-hidden="true">Heart</span>';
				echo '</div>';
      }

		echo '</div>';

		echo '<div class="single_variation_wrap">';

				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );



		echo '</div>';

	endif;

	/**
	 * Hook: woocommerce_after_variations_form
	 */
	do_action( 'woocommerce_after_variations_form' );

echo '</form>';

/**
 * Hook: woocommerce_after_add_to_cart_form
 */
do_action( 'woocommerce_after_add_to_cart_form' );
