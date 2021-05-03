<?php
/**
 * WC Account Wishlist Tab
 *
 * @package sasabudi
 */

// -----------------------------------------------------------------------------
// Step 1. Add Link (Tab) to My Account menu
// -----------------------------------------------------------------------------
function sasabudi_my_saved_items_link( $menu_links ){
 
	$menu_links = array_slice( $menu_links, 0, 4, true ) 
	+ array( 'saved-items' => 'Saved Items' )
	+ array_slice( $menu_links, 4, NULL, true );
 
	return $menu_links;
}
add_filter ( 'woocommerce_account_menu_items', 'sasabudi_my_saved_items_link', 40 );

// -----------------------------------------------------------------------------
// 2. Register Permalink Endpoint
// -----------------------------------------------------------------------------
function sasabudi_add_custom_endpoints() {
  add_rewrite_endpoint( 'saved-items', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'sasabudi_add_custom_endpoints' );

// -----------------------------------------------------------------------------
// Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
// -----------------------------------------------------------------------------
function sasabudi_my_account_endpoint_wishlist_content() {

	// Arguments
	$shop_url 		  	= esc_url( get_permalink( wc_get_page_id( 'shop' ) ) );
	$current_user 		= wp_get_current_user();
	$display_name 		= esc_attr( $current_user->display_name );
	$second_image 		= get_field('shop_product_second_image', 'option');
	$is_second_image	= ($second_image == '1') ? true : false;
	$product_sales 		= get_field('shop_product_sales', 'option');
	$show_sales 			= ($product_sales == '1') ? true : false;
	$new_arrival 			= get_field('shop_product_new_flag', 'option');
	$show_new_arrival = ($new_arrival == '1') ? true : false;
	$sold_out 				= get_field('shop_product_sold_out', 'option');
	$show_sold_out 		= ($sold_out == '1') ? true : false;

	echo '<h1 class="account-content__title">';
		echo esc_html__( 'Saved Items History', 'sasabudi' );
	echo '</h1>';


	/**
	 * 1. Query for saved product ids by author
	 */
	$savedItem = new WP_Query(array(
		'author' => get_current_user_id(),
		'post_type' => 'wishlist',
		'posts_per_page' => -1
	));

	if ($savedItem->have_posts()) :

		$saved_ids_products = array();
		$saved_ids_wishlist = array();

		while ($savedItem->have_posts()) : $savedItem->the_post();
			$saved_ids_products[] = get_field('wp_saved_product_id');
			$saved_ids_wishlist[] = get_the_ID();
		endwhile;

		/**
		 * 2. Query products by the saved product ids!
		 */
		$listItem = new WP_Query(array(
			'post_type' => 'product',
			'post__in' => $saved_ids_products,
			'posts_per_page' => -1
		));

		echo '<div class="account-wishlist">';
			while ($listItem->have_posts()) : $listItem->the_post();

				global $product;

				// Product & Wishlist ID's
				$product_id = $listItem->post->ID;
				$key = array_search($product_id, $saved_ids_products);
				$wishlist_id = $saved_ids_wishlist[$key];

				// Primary image
				$image_id = get_post_thumbnail_id( $listItem->get_product_id() );
				$image_url = wp_get_attachment_image_src( $image_id, 'medium' );
				$image_primary = $image_url[0];
				$image_primary_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

				// Secondary image
				if ($is_second_image) {
					$image_secondary = null;
					$image_secondary_ids = $product->get_gallery_image_ids();
					if ($image_secondary_ids) {
						$image_secondary = wp_get_attachment_image_src($image_secondary_ids[0], 'medium')[0];
						$image_secondary_alt = get_post_meta($image_secondary_ids[0], '_wp_attachment_image_alt', true);
					}
				}

				echo '<article class="wishlist-item" id="wi' . $product_id . '">';

					// Image
					echo '<a href="' . esc_url( get_permalink() ) . '" tabindex="0">';
						echo '<figure class="wishlist-item__figure">';

							if ($image_id) {
								// secondary image
								if (isset($image_secondary) AND $is_second_image) { 
									echo ent2ncr('<img class="wishlist-item__figure--secondary lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="' . $image_secondary_alt . '" data-src="' . $image_secondary . '">');
								}
								// primary image
								echo ent2ncr('<img class="wishlist-item__figure--primary lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="' . $image_primary_alt . '" data-src="' . $image_primary . '">');
							}
							else {
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $image_id );
							}

							if ($show_sales AND $product->is_on_sale()) {
								echo '<div class="wishlist-item__figure--sale">' . esc_html__( 'Sale', 'sasabudi' ) . '</div>';
							}

							if ($show_new_arrival) {
								$postdate = get_the_time( 'Y-m-d' );
								$postdatestamp = strtotime( $postdate );
								$newness = 14;
								if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) { // If the product was published within the newness time frame display the new badge
									echo '<div class="wishlist-item__figure--new">' . esc_html__( 'new arrival', 'sasabudi' ) . '</div>';
								}
							}

						echo '</figure>';

					echo '</a>';

					// Body
					echo '<div class="wishlist-item__body">';
						
						// title
						echo '<a href="' . esc_url( get_permalink() ) . '" tabindex="0">';
							if ($show_sales AND $product->is_on_sale()) {
								echo '<h3 class="wishlist-item__body--title">' . get_the_title() .  '<span> – </span><span class="sale">' . esc_html__( 'Sale', 'sasabudi' ) . '</span></h3>';
							} else {
								echo '<h3 class="wishlist-item__body--title">' . get_the_title() . '</h3>';
							}
						echo '</a>';
					
						// price
						if ($product->is_in_stock()) {
							echo '<div class="wishlist-item__body--price">' . $product->get_price_html() . '</div>';	
						}
						else if ($show_sold_out) {
							echo '<div class="wishlist-item__body--price">';
								echo '<span class="sold-out">' . esc_html__( 'Out of Stock', 'sasabudi' ) . '</span>';
							echo '</div>';
						}
						
						// remove
						echo '<div class="wishlist-item__remove">';
							echo '<a href="#" class="wishlist-remove-saved-item" data-saved="' . $wishlist_id . '"  data-item="'. $product_id .'">' . esc_html__( 'Remove this item', 'sasabudi' ) . '</a>';
						echo '</div>';

					echo '</div>';
					
				echo '</article>';

			endwhile;
		echo '</div>';

	else :

		echo '<div class="account-wishlist empty">';
			echo '<p>';
				printf( __( '%1$s, no products has been saved to your wishlist yet. Please, have a look at our %2$s and get inspired.', 'sasabudi' ), '<strong>' . $display_name . '</strong>', '<a class="primary-link" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . __( 'products', 'sasabudi' ) . '</a>' );							
			echo '</p>';
			echo '<a class="button btn-auto" href="' . $shop_url . '">' . esc_html__( 'Choose a product', 'sasabudi' ) . '</a>';
		echo '</div>';

	endif;

	wp_reset_postdata();

}
add_action( 'woocommerce_account_saved-items_endpoint', 'sasabudi_my_account_endpoint_wishlist_content' );

