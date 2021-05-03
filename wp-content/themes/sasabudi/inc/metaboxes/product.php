<?php
/**
 * The template for displaying the meta boxes definitions.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_create_product_meta_box' ) ) {
  function sasabudi_create_product_meta_box() {
    add_meta_box(
      'sasabudi_product_meta_box',
      esc_html__( 'Main Product', 'sasabudi' ),
      'sasabudi_product_meta_box_content',
      'product',
      'side',
      'high'
    );
  }
}
add_action( 'add_meta_boxes', 'sasabudi_create_product_meta_box' );

if ( ! function_exists( 'sasabudi_product_meta_box_content' ) ) {
  function sasabudi_product_meta_box_content( $post ) {
    $meta = get_post_meta( $post->ID );
    $arrivals_check = isset( $meta['trending_checkbox'] ) ? esc_attr( $meta['trending_checkbox'][0] ) : 'off';
    echo '<p>'; ?>
      <input type="checkbox" id="trending_checkbox" name="trending_checkbox" <?php checked( $arrivals_check, 'on' ); ?> />
    <?php
      echo '<label for="trending_checkbox">' . esc_attr_e( 'Featured', 'sasabudi') . '</label>';
    echo '</p>';
    echo esc_attr_e( 'Add this product to the trending and collection feed.', 'sasabudi' );
    wp_nonce_field( 'sasabudi_product_meta_box', 'sasabudi_product_meta_box_nonce' ); // Always add nonce to your meta boxes!
  }
}

if ( ! function_exists( 'sasabudi_save_product_meta_box' ) ) {
  function sasabudi_save_product_meta_box( $post_id ) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return $post_id;
    }
    // If our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['sasabudi_product_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['sasabudi_product_meta_box_nonce'], 'sasabudi_product_meta_box' ) ) {
      return $post_id;
    }
    // Check the user's permissions
    if ( isset( $_POST['post_type'] ) && 'product' === $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_product', $post_id ) ) {
      return $post_id;
    }
    } else {
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
      }
    }
    $trending_checkbox_value = isset( $_POST['trending_checkbox'] ) ? 'on' : 'off';
    update_post_meta( $post_id, 'trending_checkbox', esc_attr( $trending_checkbox_value ) );
  }
}
add_action( 'save_post', 'sasabudi_save_product_meta_box' );