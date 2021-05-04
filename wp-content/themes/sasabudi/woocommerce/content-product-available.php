<?php
defined( 'ABSPATH' ) || exit;

global $post, $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

if ( $product->is_in_stock() ) {
	
	global $post, $product;
	
	// Settings
	$product_id         = $post->ID;
	$show_two_images    = null;
	$post_thumbnail_id	= null;
	$first_image				 = null;
	$first_image_alt     = null;
	$attachment_ids     = null;
	$second_image       = null;
	$second_image_alt   = null;

	// Check for 'Second Image' settings
	$show_two_images = get_field('shop_product_second_image', 'option');
	$show_two_images = ($show_two_images == '1') ? true : false;

	echo '<li class="product" data-id="' . $product_id . '">';
		echo '<article class="available-article">';

			/**
			 * Hook: woocommerce_before_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );

			echo '<figure class="product-image">';
				if (has_post_thumbnail( $product_id )) {

					// Medium size gallery thumbnail (on top of the product image).
					$attachment_ids = $product->get_gallery_image_ids();
					if ($attachment_ids) $second_image_alt = get_post_meta($attachment_ids[0], '_wp_attachment_image_alt', true);
					if ($attachment_ids) $second_image = wp_get_attachment_image_src($attachment_ids[0], 'medium')[0];
					if ( isset($second_image) && $show_two_images ) {
						echo ent2ncr('<img id="s-' . $product_id . '" class="product-image__secondary lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" alt="' . $second_image_alt . '" data-src="' . $second_image . '">');
					}	

					// Medium size thumbnail as default image.
					$post_thumbnail_id = get_post_thumbnail_id( $product_id );
					$first_image = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );
					$first_image_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
					if ( isset( $first_image )) {
						echo ent2ncr('<img class="product-image__primary lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" alt="' . $first_image_alt . '" data-src="' . $first_image[0] . '">');
					}

				} else {  
					// Image is missing, so show placeholde image
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" width="100%" height="100%" />', wc_placeholder_img_src() ), $product_id );
				}
				
				// Product parent type
				$product_type = $product->get_attribute('pa_model');
				if ($product_type) {
					echo '<div class="product-model">' . $product_type . '</div>';
				}
				// Product price
				$product_price = $product->get_price_html();
				if ($product_price) {
					echo '<div class="product-price">' . $product_price . '</div>';
				}
					 
			echo '</figure>';

			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10 [hint :: removed]
			 * @hooked sasabudi_template_loop_product_edit - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );

		echo '</article>';
	echo '</li>';
}
