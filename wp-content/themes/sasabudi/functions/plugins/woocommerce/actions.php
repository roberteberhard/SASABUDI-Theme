<?php
/**
 * WC actions
 *
 * Remove Gutenberg Block Library CSS from loading on the frontend
 * Add 'firstname' and 'lastname' to register validation fields
 * Save and update the 'firstname' and 'lastname' validation fields
 * Track product view for recently viewed products
 *
 * @package sasabudi
 */

// -----------------------------------------------------------------------------
// Remove Gutenberg Block Library CSS from loading on the frontend
// -----------------------------------------------------------------------------
function sasabudi_remove_wp_block_library_css(){
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'sasabudi_remove_wp_block_library_css', 100 );

// -----------------------------------------------------------------------------
// Add 'firstname' and 'lastname' to register validation fields
// -----------------------------------------------------------------------------
function sasabudi_wc_validate_extra_register_fields( $username, $email, $validation_errors ) {
  // first name
  if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
    $validation_errors->add( 'billing_first_name_error', __( 'First name is required.', 'sasabudi' ) );
  }
  // last name
  if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
    $validation_errors->add( 'billing_last_name_error', __( 'Last name is required.', 'sasabudi' ) );
  }
  return $validation_errors;
}
add_action( 'woocommerce_register_post', 'sasabudi_wc_validate_extra_register_fields', 10, 3 );

// -----------------------------------------------------------------------------
// Save and update the 'firstname' and 'lastname' validation fields
// -----------------------------------------------------------------------------
function sasabudi_wc_save_extra_register_fields( $customer_id ) {  
  // first name
  if ( isset( $_POST['billing_first_name'] ) ) {
    update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
  }
  // last name
  if ( isset( $_POST['billing_last_name'] ) ) {
    update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
  }
}
add_action( 'woocommerce_created_customer', 'sasabudi_wc_save_extra_register_fields' );
 

// -----------------------------------------------------------------------------
// Track product view for recently viewed products
// -----------------------------------------------------------------------------
function sasabudi_track_product_view() {
	global $post;

	// Stop here when not on the single product page
	if ( ! is_singular( 'product' ) ) return;
	
	// Build viewed product array
  if ( empty( $_COOKIE['wp_wc_recently_viewed'] ) ) {
    $viewed_products = array();
  } else {
    $viewed_products = (array) explode( '|', $_COOKIE['wp_wc_recently_viewed'] );
	}

	// Save the viewed product id if not already stored
  if ( ! in_array( $post->ID, $viewed_products ) ) {
    $viewed_products[] = $post->ID;
	}
	
	// Keep max 12 ids in the array
  if ( sizeof( $viewed_products ) > 12 ) {
    array_shift( $viewed_products );
	}
	
  // Store them as cookie
  wc_setcookie( 'wp_wc_recently_viewed', implode( '|', $viewed_products ) );
}
add_action( 'template_redirect', 'sasabudi_track_product_view', 20 );
