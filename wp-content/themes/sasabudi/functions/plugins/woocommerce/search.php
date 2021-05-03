<?php
/**
 * WC Search
 *
 * @package sasabudi
 */

/**
 * Resister Search
 */
function sasabudiRegisterSearch() {

  register_rest_route('sasabudi/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'sasabudiSearchResults',
    'permission_callback' => '__return_true'
  ));
}
add_action('rest_api_init', 'sasabudiRegisterSearch');

function sasabudiSearchResults($data) {
  $searchQuery = New WP_Query(array(
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'post_type' => array('product'),
    'meta_query' => array(
      array(
        'key' => '_stock_status', // Don't show out of stock items
        'value' => 'instock'
      )
    ),
    's' => sanitize_text_field($data['term'])
  ));
  $results = array(
    // 'general' => array(),
    'products'  => array()
  );

  while($searchQuery->have_posts()) {

    $searchQuery->the_post();

    if (get_post_type() == 'product') {

      // Attributes
      global $product;
      $image_id = get_post_thumbnail_id( $searchQuery->get_product_id() );
      $image_url = wp_get_attachment_image_src( $image_id, 'medium' );
      $image_primary = $image_url[0];
      $image_secondary = null;
      $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
      $product_id = $searchQuery->post->ID;
      $product_sale = 0;
      $product_title= '<h3 class="item-box__model--title">' . get_the_title() . '</h3>';
      $product_price = $product->get_price_html();
      $product_sales = get_field('shop_product_sales', 'option');
      $product_sales = ($product_sales == '1') ? true : false;
      $variations = '';
      
      // Check if product ist 'on sale' and add sale flag
      if( $product->is_on_sale() && $product_sales ) {
        $product_sale = 1;
        $product_title = '<h2 class="item-box__model--title">' . get_the_title() . '<span> – </span><span class="item-box__model--sale">'. __( 'Sale', 'sasabudi' ) . '</span></h2>';
      }

      // Check first for existing product variations (colors)
      if( have_rows('shop_product_variations', $product_id) ) :
        
        // Product variations
        $product_variations 	= get_fields($product_id);
        $variations_ids 		  = $product_variations['shop_product_variations'];
        $variations_num 		  = count($variations_ids);
        
        // Second variantion image settings
        $gallery_second_image	= get_field('shop_product_second_image', 'option');
        $is_gallery_image 		= ($gallery_second_image == '1') ? true : false;
        
        // Gallery images
        if( $is_gallery_image ) {
          $gallery_ids 		    = $product->get_gallery_image_ids();
          $image_secondary 		= isset($gallery_ids[0]) ? wp_get_attachment_image_src( $gallery_ids[0], 'medium')[0] : ' ';
        }

        /**
         * Show only the color variation box when
         * there is more then 1 variant.
         */        
        if( $variations_num > 1) {

          $variations .= '<div class="item-box__color--variant">';
          $variations .= '<object>';
          
          for( $i = 0; $i < $variations_num; $i++ ) {
            
            // Variant
            $variant_id = $variations_ids[$i];
            $variant_product = wc_get_product( $variant_id );
            
            // First Image
            $variant_image = wp_get_attachment_image_src( get_post_thumbnail_id( $variant_id ), 'medium' );
            $first_image = isset($variant_image[0]) ? $variant_image[0] : ' ';
            
            // Second Image
            $second_image = null;
            if ( $is_gallery_image ) {
              $variant_ids = $variant_product->get_gallery_image_ids();
              $second_image = isset($variant_ids[0]) ? wp_get_attachment_image_src( $variant_ids[0], 'medium')[0] : ' ';
            }
            
            // Product URL
            $variant_url = get_permalink( $variant_id );
            $product_url = isset($variant_url) ? ' href="' . $variant_url . '" class="variant-color" data-s-trigger="on" data-g-src="' . $image_secondary . '" data-s-src="' . $second_image . '"  data-s-id="r-' . $product_id . '"' : '';
            
            // Product Terms
            $terms_color = get_the_terms( $variant_id, 'pa_colour', array( 'hide_empty'=>true ));
            $terms_icon = get_the_terms( $variant_id, 'pa_icon', array( 'hide_empty'=>true ));
            
            /* Render color swatches */
            if ($terms_color && !is_wp_error($terms_color)) {
              foreach ($terms_color as $color_item) {
                $color_value  = get_field('shop_product_colour', $color_item->taxonomy . '_' . $color_item->term_id);
                $color_active = $product_id == $variant_id ? ' origine active' : '';
                $color_name   = $color_item->name;
                $variations  .= '<a' . $product_url . '>';
                $variations  .= '<span class="variant-color__icon' . $color_active . '" title="' . $color_name . '" style="background-color:' . $color_value . '">' . $color_name . '</span>';
                $variations  .= '</a>';
              }
            }

            /* Render icon swatches */
            if ($terms_icon && !is_wp_error($terms_icon)) {
              foreach ($terms_icon as $thumb_item) {
                $icon_value   = get_field('shop_product_icon', $thumb_item->taxonomy . '_' . $thumb_item->term_id);
                $icon_active  = $product_id == $variant_id ? ' origine active' : '';
                $icon_name    = $thumb_item->name;
                $variations  .= '<a' . $product_url . '>';
                $variations  .= '<span class="variant-color__icon' . $icon_active . '" title="' . $icon_name . '" style="background-image: url(' . $icon_value . ')">' . $icon_name . '</span>';
                $variations  .= '</a>';
              }
            }
          }
          $variations .='</object>';
          $variations .='</div>';
        }
      endif;

      array_push($results['products'], array(
        'title' => $product_title,
        'permalink' => get_the_permalink(),
        'id' => $product_id,
        'primary' => $image_primary,
        'secondary' => $image_secondary,
        'alt' => $image_alt,
        'sale' => $product_sale,
        'price' => $product_price,
        'colors' => $variations
      ));
    }
  }

  return $results;
  die();
}