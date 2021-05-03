<?php
/**
 * The template for displaying the meta boxes definitions.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_create_collections_meta_box' ) ) {
  function sasabudi_create_collections_meta_box() {
    add_meta_box(
      'sasabudi_collections_meta_box',
      esc_html__( 'Featured Collection', 'sasabudi' ),
      'sasabudi_collections_meta_box_content',
      'collections',
      'side',
      'high'
    );
  }
}
add_action( 'add_meta_boxes', 'sasabudi_create_collections_meta_box' );

if ( ! function_exists( 'sasabudi_collections_meta_box_content' ) ) {
  function sasabudi_collections_meta_box_content( $post ) {
    $meta = get_post_meta( $post->ID );
    $arrivals_check = isset( $meta['collections_checkbox'] ) ? esc_attr( $meta['collections_checkbox'][0] ) : 'off';
    echo '<p>'; ?>
      <input type="checkbox" id="collections_checkbox" name="collections_checkbox" <?php checked( $arrivals_check, 'on' ); ?> />
    <?php
      echo '<label for="collections_checkbox">' . esc_attr_e( 'Featured', 'sasabudi') . '</label>';
    echo '</p>';
    echo esc_attr_e( 'Add this product to the homepage as featured collection.', 'sasabudi' );
    wp_nonce_field( 'sasabudi_collections_meta_box', 'sasabudi_collections_meta_box_nonce' ); // Always add nonce to your meta boxes!
  }
}

if ( ! function_exists( 'sasabudi_save_collections_meta_box' ) ) {
  function sasabudi_save_collections_meta_box( $post_id ) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return $post_id;
    }
    // If our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['sasabudi_collections_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['sasabudi_collections_meta_box_nonce'], 'sasabudi_collections_meta_box' ) ) {
      return $post_id;
    }
    // Check the user's permissions
    if ( isset( $_POST['post_type'] ) && 'collections' === $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_product', $post_id ) ) {
      return $post_id;
    }
    } else {
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
      }
    }
    $collections_checkbox_value = isset( $_POST['collections_checkbox'] ) ? 'on' : 'off';
    update_post_meta( $post_id, 'collections_checkbox', esc_attr( $collections_checkbox_value ) );
  }
}
add_action( 'save_post', 'sasabudi_save_collections_meta_box' );