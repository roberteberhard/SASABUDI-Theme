<?php

function universalWishlistRoute() {

  register_rest_route('wishlist/v1', 'manager', array(
    'methods' => WP_REST_SERVER::CREATABLE,
    'callback' => 'createWishlistItem',
    'permission_callback' => '__return_true'
  ));

  register_rest_route('wishlist/v1', 'manager', array(
    'methods' => WP_REST_SERVER::DELETABLE,
    'callback' => 'deleteWishlistItem',
    'permission_callback' => '__return_true'
  ));

}
add_action('rest_api_init', 'universalWishlistRoute');


/**
 * Wishlist :: CREATE
 */
function createWishlistItem($data) {

  // Must be loged in
  if (is_user_logged_in()) {

    // Arguments
    $productId = sanitize_text_field($data['id']);

    // Check for product post-type bevor saving!
    if (get_post_type($productId) == 'product') {
      return wp_insert_post(array(
        'post_type'     => 'wishlist',
        'post_title'    => 'p' . $productId,
        'post_status'   => 'publish',
        'meta_input'    => array(
          'wp_saved_product_id' => $productId
        )
      ));
    } else {
      die("Invalid product id!");
    }
  } else {
    die("Only logged in users can create a save!");
  }
}


/**
 * Wishlist :: DELETE
 */
function deleteWishlistItem($data) {
  
  // Arguments
  $wishlistId = sanitize_text_field($data['id']);
    
  // Check for product post-type bevor deleting!
  if (get_current_user_id() == get_post_field('post_author', $wishlistId) AND get_post_type($wishlistId) == 'wishlist') {

    // 1. delete
    wp_delete_post($wishlistId, true);

    // 2. send back amout for icon update
    $listAmount = new WP_Query(array(
      'author' => get_current_user_id(),
      'post_type' => 'wishlist',
      'posts_per_page' => -1
    ));
    
    return $listAmount->found_posts;

  } else {
    die('You do not have permission to delete that!');
  }
}