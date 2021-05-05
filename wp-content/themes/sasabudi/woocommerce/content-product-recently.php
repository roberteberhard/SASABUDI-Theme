<?php
defined( 'ABSPATH' ) || exit;

global $post, $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

if ( $product->is_in_stock() ) {

	// Settings
	$attachment_ids 	= null;
	$image_id  				= 0;
	$image_primary 		= null;
	$image_secondary 	= null;
	$product_id 			= $post->ID;
	$product_sale 		= 0;
	$product_title 		= '<h3 class="article-item__model--title">' . get_the_title() . '</h3>';
	$product_price 		= $product->get_price_html();
	$product_sales 		= get_field('shop_product_sales', 'option');
	$product_sales 		= ($product_sales == '1') ? true : false;
	$product_variants = '';
	$variations_num 	= 0;

	// Check for product 'sale' flag
	if($product->is_on_sale() && $product_sales) {
		$product_sale = 1;
		$product_title = '<h3 class="article-item__model--title">' . get_the_title() . '<span> – </span><span class="article-item__model--sale">'. __( 'Sale', 'sasabudi' ) . '</span></h3>';
	}

	// Check for product 'primary' image
	$image_id = get_post_thumbnail_id( $post->ID );
	if ($image_id) {
		$image_primary = wp_get_attachment_image_src( $image_id, 'medium' )[0];
	}

	// Check for product 'secondary' image
	$secondaryImage	= get_field('shop_product_second_image', 'option');
	$secondaryImage = ($secondaryImage == '1') ? true : false;
	if ($secondaryImage) {
		$secondaryIDs = $product->get_gallery_image_ids();
		$image_secondary = isset($secondaryIDs[0]) ? wp_get_attachment_image_src( $secondaryIDs[0], 'medium')[0] : ' ';
	}

	echo '<li class="recently-viewed" data-id="' . $product_id . '">';
		echo '<article class="recently-article">';
			echo '<a href="' . esc_url( get_permalink() ) . '" tabindex="0" title="' . get_the_title() . '">';
				
				// Build Product Article Secondary & Primary Images & Sale Tag
				echo '<div class="recently-article__figure">';
					echo $product_sale == 1 ? '<div class="recently-article__sale">' . __( 'Sale', 'sasabudi' ) . '</div>' : '';
					if ($image_secondary) {
						echo '<img class="recently-article__figure--secondary lazy-img" id="o-' . $product_id . '" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" data-src="' . $image_secondary . '">';
					}
					if ($image_primary) {
						echo '<img class="recently-article__figure--primary lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" data-src="' . $image_primary . '">';
					} else {
						// Image is missing, so show placeholde image
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
					}
				echo '</div>';

       	// Build Product Article Description
				echo '<div class="recently-article__desc">';
					echo '<div class="article-item">';
						echo '<div class="article-item__model">' . $product_title . '</div>';
						echo '<div class="article-item__price">' . $product_price . '</div>';
						if ($variations_num > 1) {
							echo '<div class="article-item__color">' . $product_variants . '</div>';
						}
					echo '</div>';
				echo '</div>';

			echo '</a>';
		echo '</article>';
	echo '</li>';
}
