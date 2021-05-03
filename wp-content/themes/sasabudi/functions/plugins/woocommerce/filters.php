<?php
/**
 * WC filters
 *
 * @package sasabudi
 */

/**
 * Remove/Disable/DeQueue WooCommerce Stylesheets
 * Zero are hidden by default. To show empty taxes, use the snippet
 * Notification classes
 * Add custom query_vars functionality
 * Number to show at the product archive pages
 * Return updated cart fragments
 * Show only the min variation price (from $24.00)
 * Change the cart price display
 * Change the order of the endpoints in the 'account' page
 * Change the titles of the endpoints that appears in the 'account' page (inactive)
 * Add navigation arrows to single product flexslider (inactive)
 * Update the tabs in the single product page
 * Remove default sorting options in single product page
 * Adds a "sold out" identifier to out of stock variations on product pages
 * Grey out variation when out of stock
 * Change PayPal image on checkout
 * Change button text on checkout
 * Hide “Thanks for shopping with us”
 */

// -----------------------------------------------------------------------------
// Remove/Disable/DeQueue WooCommerce Stylesheets
// -----------------------------------------------------------------------------
function sasabudi_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );		// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );			// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'sasabudi_dequeue_styles' );

// -----------------------------------------------------------------------------
// Zero are hidden by default. To show empty taxes, use the snippet
// -----------------------------------------------------------------------------
add_filter( 'woocommerce_order_hide_zero_taxes', '__return_false' );

// -----------------------------------------------------------------------------
// Notification classes
// -----------------------------------------------------------------------------
function sasabudi_notification_class( $classes ) {
	global $post;
	$classes[] = !is_account_page() ? 'sasa_custom_notice' : 'sasa_classic_notice';
	return $classes;
}
add_filter( 'body_class', 'sasabudi_notification_class' );

// -----------------------------------------------------------------------------
// Add custom query_vars functionality
// -----------------------------------------------------------------------------
function sasabudi_add_query_vars_filter( $vars ){
	$vars[] = "filter_model"; // used for breadcrumb
	return $vars;
}
add_filter( 'query_vars', 'sasabudi_add_query_vars_filter' );

// -----------------------------------------------------------------------------
// Number to show at the product archive pages
// -----------------------------------------------------------------------------
add_filter( 'loop_shop_per_page', function ( $cols ) {
  // Get archive amount from Dashboard
  $products_amount 	= get_field('shop_archive_products', 'option');
  $archive_amount 	= $products_amount > 1 ? $products_amount : 4;
  return $archive_amount; 
}, 20 );

// -----------------------------------------------------------------------------
// Return updated cart fragments
// -----------------------------------------------------------------------------
function sasabudi_shopping_bag_items_number($fragments) {
	global $woocommerce;

	// Device
	ob_start();
  echo '<div class="header-device__cart--amount">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
	$fragments['div.header-device__cart--amount'] = ob_get_clean();

	ob_start();
  echo '<div class="header-device__cart--count">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
	$fragments['div.header-device__cart--count'] = ob_get_clean();

	// Desktop
  ob_start();
  echo '<div class="header-desktop__cart--amount">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
	$fragments['div.header-desktop__cart--amount'] = ob_get_clean();

	ob_start();
  echo '<div class="header-desktop__cart--count">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
	$fragments['div.header-desktop__cart--count'] = ob_get_clean();

	// Cart Free Shipping Message
	ob_start();
	$packages   = WC()->cart->get_shipping_packages();
	$package    = reset( $packages );
	$zone       = wc_get_shipping_zone( $package );
	$subtotal 	= WC()->cart->get_displayed_subtotal();
	
	if ( WC()->cart->display_prices_including_tax() ) {
		$carttotal = round( $subtotal - ( WC()->cart->get_discount_total() + WC()->cart->get_discount_tax() ), wc_get_price_decimals() );
	} else {
		$carttotal = round( $subtotal - WC()->cart->get_discount_total(), wc_get_price_decimals() );
	}

	foreach ( $zone->get_shipping_methods( true ) as $k => $method ) { 
		$shipping_amount = $method->get_option( 'min_amount' );
		$shipping_method = $method->get_option( 'title' );
		if ( $method->id == 'free_shipping' && ! empty( $shipping_amount ) && $carttotal < $shipping_amount ) {
			$remaining = $shipping_amount - $carttotal;
			echo '<div class="cart-shipping__message">' . sprintf(esc_html__('Almost there! Add %s to unlock %1s', 'sasabudi'), wc_price( $remaining ), $shipping_method) . '</div>';
		}
		if ( $method->id == 'free_shipping' && ! empty( $shipping_amount ) && $carttotal >= $shipping_amount ) {
			echo '<div class="cart-shipping__message">' . sprintf(esc_html__('%s  You have unlocked %1s!', 'sasabudi'), '<strong>Congrats!</strong>', $shipping_method ) . '</div>';
		}
	}

	$fragments['div.cart-shipping__message'] = ob_get_clean();

	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'sasabudi_shopping_bag_items_number');



// -----------------------------------------------------------------------------
// Show only the min variation price (from $24.00)
// -----------------------------------------------------------------------------
function sasabudi_variable_price_format( $price, $product ) {
  $product_prefix = sprintf('<span class="product-price__from">%s</span> ', esc_html__('from', 'sasabudi'));
  $product_regular_price = $product->get_variation_regular_price( 'min', true );
	$product_sale_price = $product->get_variation_sale_price( 'min', true );
	$product_min_price = $product->get_variation_price( 'min', true );
  $product_max_price = $product->get_variation_price( 'max', true );
  $price = ( $product_sale_price == $product_regular_price ) ? wc_price( $product_regular_price ) : '<del>' . wc_price( $product_regular_price ) . '</del>' . ' ' . '<ins>' . wc_price( $product_sale_price ) . '</ins>';
	return ( $product_min_price == $product_max_price ) ? $price : sprintf('%s%s', $product_prefix, $price);
}
add_filter( 'woocommerce_variable_sale_price_html', 'sasabudi_variable_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'sasabudi_variable_price_format', 10, 2 );

// -----------------------------------------------------------------------------
// Change the cart price display
// -----------------------------------------------------------------------------
function sasabudi_change_cart_table_price_display( $price, $values, $cart_item_key ) {
  $slashed_price = $values['data']->get_price_html();
  $is_on_sale = $values['data']->is_on_sale();
  if ( $is_on_sale ) {
    $price = $slashed_price;
  }
  return $price;
}
add_filter( 'woocommerce_cart_item_price', 'sasabudi_change_cart_table_price_display', 30, 3 );

// -----------------------------------------------------------------------------
// Change the order of the endpoints in the 'account' page
// -----------------------------------------------------------------------------
function sasabudi_wc_my_account_order() {
  $myorder = array(
    'dashboard'          => esc_html__( 'Dashboard', 'sasabudi' ),
		'edit-account'       => esc_html__( 'Settings', 'sasabudi' ),
    'orders'             => esc_html__( 'Orders', 'sasabudi' ),
    'downloads'          => esc_html__( 'Downloads', 'sasabudi' ),
    'edit-address'       => esc_html__( 'Addresses', 'sasabudi' ),
		'payment-methods'    => esc_html__( 'Payments', 'sasabudi' ),
    'customer-logout'    => esc_html__( 'Sign Out', 'sasabudi' )
  );
  return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'sasabudi_wc_my_account_order' );

// -----------------------------------------------------------------------------
// Change the titles of the endpoints that appears in the 'account' page
// -----------------------------------------------------------------------------
function sasabudi_wc_endpoint_title( $title, $id ) {
  if ( is_wc_endpoint_url( 'orders' ) && in_the_loop() ) {
    $title = esc_html__( 'Order History', 'sasabudi' );
  }
  if ( is_wc_endpoint_url( 'view-order' ) && in_the_loop() ) {
    $title = "";
  }
  elseif ( is_wc_endpoint_url( 'downloads' ) && in_the_loop() ) {
    $title = esc_html__( 'Download History', 'sasabudi' );
  }
  elseif ( is_wc_endpoint_url( 'edit-address' ) && in_the_loop() ) {
    $title = esc_html__( 'Addresses', 'sasabudi' );
  }
  elseif ( is_wc_endpoint_url( 'edit-account' ) && in_the_loop() ) {
    $title = esc_html__( 'Account details', 'sasabudi' );
  }
  else {
    // Dashboard show my account!
  }
  return $title;
}
// add_filter( 'the_title', 'sasabudi_wc_endpoint_title', 10, 2 );

// -----------------------------------------------------------------------------
// Add navigation arrows to single product flexslider
// -----------------------------------------------------------------------------
function sasabudi_update_woo_flexslider_options( $options ) {
  $options['directionNav'] = true;
  return $options;
}
// add_filter( 'woocommerce_single_product_carousel_options', 'sasabudi_update_woo_flexslider_options' );

// -----------------------------------------------------------------------------
// Update the tabs in the single product page
// -----------------------------------------------------------------------------
function sasabudi_update_product_tabs( $tabs ) {
	// Unset tabs
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );
	// $tabs['description']['title'] = "Description";
	// Update tabs
	$tabs['description'] = array (
		'title' => 'Description',
		'priority' => 10,
		'callback' => 'show_product_description'
	);
	// Add new tabs
	$tabs['product_sizing'] = array (
		'title' => 'Sizing',
		'priority' => 20,
		'callback' => 'show_product_sizing'
	);
	$tabs['product_shipping'] = array (
		'title' => 'Shipping',
		'priority' => 30,
		'callback' => 'show_product_shipping'
	);
	return $tabs;
}
add_filter('woocommerce_product_tabs', 'sasabudi_update_product_tabs', 98);

function show_product_description() {

	global $post, $product;
	$product_terms = wp_get_post_terms($post->ID, 'product_cat');
  $category_terms = array_slice($product_terms, 0, 1);
	$attribute_model = null;
  
	if($category_terms && !is_wp_error($category_terms)) {

		// evaluate model
		$attribute_type = get_the_terms($post->ID, 'pa_model', array('hide_empty'=>true));
		if($attribute_type) {
			$attribute_model = $attribute_type[0]->slug;
		}

		// tab description
		echo '<div class="wc-tab-description">';
			echo '<h2>'. esc_html('Product Description', 'sasabudi') . '</h2>';
			the_excerpt();
			the_content();
			
			// include 'share' template
			wc_get_template( 'single-product/share.php' );

			/*
			if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :
				echo '<span class="sku-wrapper">' . esc_html__( 'SKU: ', 'sasabudi' );
					echo '<span class="sku">' . ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'sasabudi' ) . '</span>';
				echo '</span>';
			endif;
			*/

		echo '</div>';

		// tab details
		echo '<div class="wc-tab-details">';
			echo '<h2>' . esc_html__( 'Details', 'sasabudi' ) . '</h2>';

			// include 'coffee-mug' details template
			if( $attribute_model == 'coffee-mug') {
				$file = get_template_directory().'/templates/template-details-' . $attribute_model . '.php';
				include($file);
			}
		
		echo '</div>';
	}
}

function show_product_sizing() {

	global $post;
	$product_terms = wp_get_post_terms($post->ID, 'product_cat');
  $category_terms = array_slice($product_terms, 0, 1);
	$attribute_model = null;

	if($category_terms && !is_wp_error($category_terms)) {

		// evaluate model
		$attribute_type = get_the_terms($post->ID, 'pa_model', array('hide_empty'=>true));
		if($attribute_type) {
			$attribute_model = $attribute_type[0]->slug;
		}

		// include 'coffee-mug' sizing template
		if( $attribute_model == 'coffee-mug') {
			$file = get_template_directory().'/templates/template-sizing-' . $attribute_model . '.php';
			include($file);
		}
	}
}

function show_product_shipping() {

	global $post;
	$product_terms = wp_get_post_terms($post->ID, 'product_cat');
  $category_terms = array_slice($product_terms, 1, 1);
  
	if($category_terms && !is_wp_error($category_terms)) {
		
		// evaluate model
		$attribute_type = get_the_terms($post->ID, 'pa_model', array('hide_empty'=>true));
		$attribute_model = $attribute_type[0]->slug;

		// include 'coffee-mug' shipping template
		if( $attribute_model == 'coffee-mug') {
			$file = get_template_directory().'/templates/template-shipping-' . $attribute_model . '.php';
			include($file);
		}
	}
}

// -----------------------------------------------------------------------------
// Remove default sorting options in catalog page
// -----------------------------------------------------------------------------
function sasabudi_remove_default_sorting_options( $options ){
	//unset( $options[ 'popularity' ] );
	//unset( $options[ 'menu_order' ] );
	unset( $options[ 'rating' ] );
	//unset( $options[ 'date' ] );
	unset( $options[ 'price' ] );
	unset( $options[ 'price-desc' ] );

	$options[ 'popularity' ] = 'Sort by Popular'; // rename
	$options[ 'menu_order' ] = 'Sort by Name'; // rename
	$options[ 'date' ] = 'Sort by New'; // rename
 
	return $options;
}
add_filter( 'woocommerce_catalog_orderby', 'sasabudi_remove_default_sorting_options' );

// -----------------------------------------------------------------------------
// Adds a "sold out" identifier to out of stock variations on product pages
// -----------------------------------------------------------------------------
function custom_get_availability( $availability, $_product ) {
	 global $product;

	 if ( !$_product->is_in_stock() ) $availability['availability'] = '';
	 return $availability;
}
add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);

// -----------------------------------------------------------------------------
// Grey out variation when out of stock
// -----------------------------------------------------------------------------
function grey_out_variations_when_out_of_stock( $grey_out, $variation ){
	if ( ! $variation->is_in_stock() ) {
		return false;
	} else {
		return true;
	}
}
add_filter( 'woocommerce_variation_is_active', 'grey_out_variations_when_out_of_stock', 10, 2 );

// -----------------------------------------------------------------------------
// Change PayPal image on checkout
// -----------------------------------------------------------------------------
function sasabudi_change_what_is_paypal( $icon_html, $gateway_id ) {
	if( 'paypal' == $gateway_id ) {
		$icon_html = '<img src="' . get_theme_file_uri('/images/sasabudi-paypal.png') . '" alt="PayPal Acceptance Mark">';
	}
	return $icon_html;
}
add_filter( 'woocommerce_gateway_icon', 'sasabudi_change_what_is_paypal', 10, 2 );

// -----------------------------------------------------------------------------
// Change button text on checkout
// -----------------------------------------------------------------------------
function sasabudi_rename_place_order_button() {
  return esc_html__('Pay and place order', 'sasabudi'); 
}
add_filter( 'woocommerce_order_button_text', 'sasabudi_rename_place_order_button', 9999 );

// -----------------------------------------------------------------------------
// Hide “Thanks for shopping with us”
// -----------------------------------------------------------------------------
function sasabudi_translate_woocommerce_strings_emails( $translated ) {
   // Get strings and translate them into empty string >>> ''
   $translated = str_ireplace( 'Thanks for shopping with us.', '', $translated );
	 $translated = str_ireplace( 'We hope to see you again soon.', '', $translated );
	 $translated = str_ireplace( 'We look forward to seeing you soon.', '', $translated );
   return $translated;
}
add_filter( 'gettext', 'sasabudi_translate_woocommerce_strings_emails', 999 );
