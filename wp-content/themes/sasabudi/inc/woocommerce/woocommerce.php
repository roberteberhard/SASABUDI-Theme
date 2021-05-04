<?php
/**
 * The template functions used for displaying the 'woocommerce' definitions.
 *
 * [Product Feed]
 * - sasabudi_template_loop_product_thumbnail
 * - sasabudi_template_loop_product_new_item
 * - sasabudi_template_loop_product_save_item
 * - sasabudi_template_loop_product_sale_item
 * - sasabudi_template_loop_product_sizes
 * - sasabudi_template_loop_product_colors
 * - sasabudi_template_loop_product_title
 * - sasabudi_template_loop_product_price
 * - sasabudi_template_loop_product_edit
 * 
 * [Product Archive]
 * - sasabudi_catalog_header_filter
 * - sasabudi_catalog_result_breadcrumb
 * - sasabudi_catalog_archive_description
 * - sasabudi_catalog_archive_tags
 * - sasabudi_catalog_result_filter
 *
 * [product single]
 * - sasabudi_product_single_breadcrumb
 * - sasabudi_product_single_highlights
 * - sasabudi_product_single_images
 * - sasabudi_product_single_title
 * - sasabudi_product_single_price
 * - sasabudi_product_single_options
 * - sasabudi_product_single_add_to_cart
 * - sasabudi_product_single_meta
 * - sasabudi_product_single_tabs
 * - sasabudi_product_single_tagged_as
 * - sasabudi_product_single_related_items
 * - sasabudi_product_single_recently_viewed
 *
 * [Product Minicart]
 * - sasabudi_product_cart_shipping_max
 * - sasabudi_product_cart_cross_sell
 * 
 * [Shopping Cart]
 * - sasabudi_cart_continue_shopping
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_template_loop_product_thumbnail' ) ) {
  /**
   * Show the 'default' product image and a 'second' product image for 
   * the mouse over effect. When there is no 'default' image, then show
   * the placeholder image. You can toggle the view settings in the WP Dashboard.
   */
  function sasabudi_template_loop_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ):

      // Settings
      global $post, $product;
      $product_id         = $post->ID;
      $attachment_ids     = null;
      $show_two_images    = null;
      $second_image       = null;
      $second_image_src   = null;
      $second_image_alt   = null;
      $post_thumbnail_id  = null;
      $first_image        = null;
      $first_image_alt    = null;

      // Check for 'Second Image' settings
      $show_two_images = get_field('shop_product_second_image', 'option');
      $show_two_images = ($show_two_images == '1') ? true : false;

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
          echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $product_id );
        }   
      echo '</figure>';
    endif;  
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_save_item' ) ) {
  /**
   * Show the 'Save' icon on to to the image. It show the
   * saved or default state.
   */
  function sasabudi_template_loop_product_save_item() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      if ( !is_user_logged_in()) {
        echo '<object>';
          echo '<a href="#" class="product-wishlist">';
            echo '<div class="product-wishlist__icon" data-exists="signin" aria-hidden="true"></div>';
          echo '</a>';
        echo '</object>';
      }
      else {
        
        global $post;
        $product_id = $post->ID;
        $savedItem = new WP_Query(array(
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
        $product_exists = $savedItem->found_posts > 0 ? 'yes' : 'no';
        $product_wait = 'no';
        $wishlist_id = isset($savedItem->posts[0]->ID) ? $savedItem->posts[0]->ID : 0;

        echo '<object>';
          echo '<a href="#" class="product-wishlist">';
            echo '<div class="product-wishlist__icon" id="pw'. $product_id .'" data-exists="' . $product_exists . '" data-wait="' . $product_wait . '" data-saved="' . $wishlist_id . '" data-item="'. $product_id .'" aria-hidden="true">Heart</div>';
          echo '</a>';
        echo '</object>';
      }

    endif;
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_new_item' ) ) {
  /**
   * Show the 'New' icon when a new product is placed. You 
   * can toggle the view settings in the WP Dashboard.
   */
  function sasabudi_template_loop_product_new_item() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      $new_arrival = get_field('shop_product_new_flag', 'option');
      $new_arrival = ($new_arrival == '1') ? true : false;

      // Build New Flag
      if ( $new_arrival ) {
        $postdate 		= get_the_time( 'Y-m-d' );	// Post date
        $postdatestamp 	= strtotime( $postdate );	// Timestamped post date
        $newness 		= 14; 						            // Newness in days
        if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) { // If the product was published within the newness time frame display the new badge
          echo '<div class="product-new">' . esc_html__( 'new arrival', 'sasabudi' ) . '</div>';
        }
      }
    endif;
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_sale_item' ) ) {
  /**
   * Show the 'Sale' icon when a new product is placed. You 
   * can toggle the view settings in the WP Dashboard.
   */
  function sasabudi_template_loop_product_sale_item() {  
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $product;
      $product_sales = get_field('shop_product_sales', 'option');
      $product_sales = ($product_sales == '1') ? true : false;

      if ( $product->is_on_sale() && $product_sales ) {
        // Show the product sale tag
        echo '<div class="product-sale">' . esc_html__( 'Sale', 'sasabudi' ) . '</div>';
      }

    endif;
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_sizes' ) ) {
  /**
   * Show the differen product items sizes. Dim
   * the ones which are sold out.
   */
  function sasabudi_template_loop_product_sizes() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
    endif;
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_colors' ) ) {
  /**
   * Show the product item color dots or thumbs by
   * retrieving their color from its variation value.
   */
  function sasabudi_template_loop_product_colors() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $product;
      $product_id = get_the_ID();

      // Check for product variations
      if( have_rows('shop_product_variations', $product_id) ):

        // Product variations
        $product_variations 	= get_fields($product_id);
        $variantions_ids 		= $product_variations['shop_product_variations'];
        $variantions_num 		= count($variantions_ids);

        // Second variantion image settings
        $gallery_second_image	= get_field('shop_product_second_image', 'option');
        $is_gallery_image 		= ($gallery_second_image == '1') ? true : false;
        $gallery_image 			  = null;

        // Gallery images
        if( $is_gallery_image ) {
          $gallery_ids 		  = $product->get_gallery_image_ids();
          $gallery_image 		= isset($gallery_ids[0]) ? wp_get_attachment_image_src( $gallery_ids[0], 'medium')[0] : ' ';
        }

        /**
         * Show only the color variation box when
         * there is more then 1 variant.
         */
        if( $variantions_num > 1) {
          echo '<div class="product-color">';
            echo '<div class="product-variant">';
              
              echo '<object>';
                for( $i = 0; $i < $variantions_num; $i++ ) {
                  
                  // Variant
                  $variant_id = $variantions_ids[$i];
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
                  $product_url = isset($variant_url) ? ' href="' . $variant_url . '" class="variant-color" data-s-trigger="on" data-g-src="' . $gallery_image . '" data-s-src="' . $second_image . '"  data-s-id="s-' . $product_id . '"' : '';
                  
                  // Product Terms
                  $terms_color = get_the_terms( $variant_id, 'pa_colour', array( 'hide_empty'=>true ));
                  $terms_icon = get_the_terms( $variant_id, 'pa_icon', array( 'hide_empty'=>true ));
                  
                  // Render color swatches!
                  if ($terms_color && !is_wp_error($terms_color)) {
                    foreach ($terms_color as $color_item) {
                      $color_value = get_field('shop_product_colour', $color_item->taxonomy . '_' . $color_item->term_id);
                      $color_active = $product_id == $variant_id ? ' origine active' : '';
                      $color_name = $color_item->name;
                      echo '<a' . $product_url . '>';
                        echo '<span class="variant-color__icon' . $color_active . '" title="' . $color_name . '" style="background-color:' . $color_value . '">' . $color_name . '</span>';
                      echo '</a>';
                    }
                  }

                  // Render color icons!
                  if ($terms_icon && !is_wp_error($terms_icon)) {
                    foreach ($terms_icon as $thumb_item) {
                      $icon_value = get_field('shop_product_icon', $thumb_item->taxonomy . '_' . $thumb_item->term_id);
                      $icon_active = $product_id == $variant_id ? ' origine active' : '';
                      $icon_name = $thumb_item->name;
                      echo '<a' . $product_url . '>';
                        echo '<span class="variant-color__icon' . $icon_active . '" title="' . $icon_name . '" style="background-image: url(' . $icon_value . ')">' . $icon_name . '</span>';
                      echo '</a>';
                    }
                  }
                }
              echo '</object>';

            echo '</div>';
          echo '</div>';
        }
      endif;
    endif;
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_title' ) ) {
  /**
   * Show the product title and ppend a 'Sale' tag at the end of 
   * the title, when the product is set as sale.
   */
  function sasabudi_template_loop_product_title() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $product;
      $product_sales = '0';
      $product_sales = get_field('shop_product_sales', 'option');
      $product_sales = ($product_sales == '1') ? true : false;
      $product_edit = '';

      // Build sale section
      if ( $product->is_on_sale() && $product_sales ) {
        // Show the product title with the 'Sale' expression.
        echo '<h2 class="product-title">' . get_the_title() . '<span> – </span><span class="product-title__sale">'. esc_html__( 'Sale', 'sasabudi' ) . '</span></h2>';
      } else {
        // Simply show the product title without 'Sale' expression.
        echo '<h2 class="product-title">' . get_the_title() . '</h2>';				
      }
    endif;
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_price' ) ) {
  /**
   * Display the product price with sale price. And if the product
   * is sold out, then show only the sold out expression.
   */	
  function sasabudi_template_loop_product_price() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $product;
      $product_show_sold_out = null;
      $product_price = null;
      $product_show_sold_out = get_field('shop_product_sold_out', 'option');
      $product_show_sold_out = ($product_show_sold_out == '1') ? true : false;
      $product_in_stock = $product->is_in_stock();
      $product_price = $product->get_price_html();

      // Build price section
      if( $product_in_stock ) {
        if($product_price) {
          // Show product price.
          echo '<div class="product-price">' . $product_price . '</div>';		
        }
      } else if( $product_show_sold_out ) {
        if($product_price) {
          // Show product sold out expression.
          echo '<div class="product-price">';
            echo '<span class="product-price__sold">' . esc_html__( 'Out of Stock', 'sasabudi' ) . '</span>';
          echo '</div>';
        }
      }
    endif;
  }
}

if ( ! function_exists( 'sasabudi_template_loop_product_edit' ) ) {
  /**
   * Shows the 'Edit' admin link.
   */
  function sasabudi_template_loop_product_edit() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      global $post;

      // Build edit section
      if( current_user_can( 'edit_posts' ) ) {
        echo '<div class="product-edit"><a href="' . get_edit_post_link( $post->id ) . '" target="_blank">[Edit]</a></div>';
      }
    endif;
  }
}

if ( ! function_exists( 'sasabudi_catalog_header_filter' ) ) {
  /**
   * Shows filter section for the product archive page header.
   */	
   function sasabudi_catalog_header_filter() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      global $wp_query;

      // Settings
      $total = $wp_query->found_posts;
      $item = ($total > 1) ? esc_html__('Items','sasabudi') : esc_html__('Item','sasabudi');			
  
      echo '<ul class="filter-bar">';

        echo '<li class="filter-bar__btn">';
          echo '<a href="#" class="filter-bar__btn--filter">' . esc_html__( 'Filters', 'sasabudi' ) . '</a>';
        echo '</li>';

        echo '<li class="filter-bar__total">';
          echo '<span>' . $total . ' ' . $item . '</span>';
        echo '</li>';

      echo '</ul>';	

    endif;
  }
}

if ( ! function_exists( 'sasabudi_catalog_result_breadcrumb' ) ) {
  /**
   * Shows the titel and the breadcrumb section in the
   * product archive page header.
   */	
  function sasabudi_catalog_result_breadcrumb() {

    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      echo '<ul class="catalog-header__nav--list">';
        echo '<li><a href="' . esc_url( home_url( '/' ) ) .'">' . esc_html__('Home ', 'sasabudi') . '</a></li>';     

        // Show on shop page
        if( is_shop() ) {

          // retrieve order 
          $order = get_query_var('orderby');
          if ($order == 'popularity') {
            echo '<li><span class="spacer">/</span><a href="' . esc_url( home_url( '/catalog' ) ) . '">' . esc_html__('Catalog ', 'sasabudi') . '</a><span class="spacer">/</span><a class="active" href="' . esc_url( home_url( '/catalog/?orderby=popularity' ) ) .'">' . esc_html__('Bestsellers', 'sasabudi') . '</a></li>';
          } else {
            echo '<li><span class="spacer">/</span><a href="' . esc_url( home_url( '/catalog' ) ) . '">' . esc_html__('Catalog ', 'sasabudi') . '</a></li>';
          }  
        }

        // Show on product archive page
        if( is_product_category() ) { 
          echo '<li><span class="spacer">/</span><a href="' . esc_url( home_url( '/catalog' ) ) . '">' . esc_html__('Catalog ', 'sasabudi') . '</a></li>'; 
        }
        // + Categories
        if ( is_product_category( 'mugs' ) ) {
          echo '<li><span class="spacer">/</span><a class="active" href="' . esc_url( home_url( '/catalog/mugs' ) ) . '">' . esc_html__('Mugs', 'sasabudi') . '</a></li>';
        }
        elseif ( is_product_category( 'new-arrivals' ) ) {
          echo '<li><span class="spacer">/</span><a class="active" href="' . esc_url( home_url( '/catalog/new-arrivals' ) ) . '">' . esc_html__('New Arrivals', 'sasabudi') . '</a></li>';
        }
        elseif ( is_product_category( 'exclusive' ) ) {
          echo '<li><span class="spacer">/</span><a class="active" href="' . esc_url( home_url( '/catalog/exclusive' ) ) . '">' . esc_html__('On Our Radar', 'sasabudi') . '</a></li>';
        }

        // Show on product archive-tag page
        if( is_product_tag() ) {
          $current_term = $GLOBALS['wp_query']->get_queried_object();
          $tag_name = $current_term->name;
          echo '<li><span class="spacer">/</span><a href="' . esc_url( home_url( '/catalog' ) ) . '">' . esc_html__('Catalog ', 'sasabudi') . '</a></li>';
          if( $tag_name ) {
            echo '<li><span class="spacer">/</span><a class="tag-active" href="' . get_term_link( $current_term->term_taxonomy_id, 'product_tag' ) . '">' . $tag_name . '</a></li>';
          }
        }

      echo '</ul>';

      // Append the layered navigation!
      dynamic_sidebar('layered-navigation');
      
    endif;
  }
}

if ( ! function_exists( 'sasabudi_catalog_archive_description' ) ) {
  /**
   * Show an archive description on taxonomy archives.
   */	
  function sasabudi_catalog_archive_description() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      /**
       * Use this as long you dont't have a shop landing page
       */
      if(is_shop()) {
        
        // retrieve order 
        $order = get_query_var('orderby');
        $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

        echo '<div class="term-description"><p>';
          if ($order == 'popularity') {
            printf(esc_html__('Browse our best-selling designs and find popular tea or %2$s that reflect your lifestyle or add a personal touch to your decor. These beautiful %1$s are also one of the most popular gift items for your loved ones.', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs">mugs</a>', '<a class="primary-link" href="' . $shop_page_url . 'mugs/?filter_model=coffee-mug">coffee mugs</a>');
          } else {
            printf(esc_html__('Celebrate your daily lifestyle with our inspiring %1$s. Discover the unique and beautiful designs and find the perfect %2$s or tea cup for you that highlights your personal taste and makes a design statement in your environment.', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs">mugs</a>', '<a class="primary-link" href="' . $shop_page_url . 'mugs/?filter_model=coffee-mug">coffee mug</a>');
          }
        echo '</p></div>';
      }
  
      /**
       * Print category descriptions
       */

		  if ( is_product_taxonomy() ) {
        
        // settings
        $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
        $term = get_queried_object();
        $slug = $term->slug;
        $model = get_query_var('filter_model');
   
        echo '<div class="term-description"><p>';

          // Category: New Arrivals
          if($slug == 'new-arrivals') {
            if ($model == 'coffee-mug') {
              printf(esc_html__('Browse our selection and discover the newest additions of %1$s and find the perfect type for you. Add a personal touch to your morning or evening coffee enjoyment with our unique and beautiful %2$s designs.', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date">mugs</a>', '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date&filter_model=coffee-mug">coffee mug</a>');
            } else {
              printf(esc_html__('Browse our selection and discover the newest additions of %1$s and find the perfect type for you. Add a personal touch to your morning or evening coffee enjoyment with our unique and beautiful %2$s designs.', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date">mugs</a>', '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date&filter_model=coffee-mug">coffee mug</a>');
            }
          }

          // Category: Exclusive
          if($slug == 'exclusive') {
            if ($model == 'coffee-mug') {
              printf(esc_html__('Take a look at our selected and trendy %1$s and discover the most popular designs of the moment. The inspiring motifs are sure to impress you and these cool %2$s are among the most popular gift items.', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date">mugs</a>', '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date&filter_model=coffee-mug">coffee mug</a>');
            } else {
              printf(esc_html__('Take a look at our selected and trendy %1$s and discover the most popular designs of the moment. The inspiring motifs are sure to impress you and these cool %2$s are among the most popular gift items.', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date">mugs</a>', '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=date&filter_model=coffee-mug">coffee mug</a>');
            }
          }

          // Category: Mugs
          if($slug == 'mugs') {
            if ($model == 'coffee-mug') {
              printf(esc_html__('Start your day with an inspiring coffee mug. Browse our selection and find the perfect %1$s to match your personal style or home decor. And did you know that coffee mugs are one of the most popular gift items? Have fun exploring!', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=popularity">mug</a>');
            } else {
              printf(esc_html__('Explore our mug selection and find the perfect tea or coffee mug for you or your loved ones. Start your day with an inspiring and beautiful %1$s in either standard 11 ounces or the mega 15 ounces.', 'sasabudi'), '<a class="primary-link" href="' . $shop_page_url . 'mugs/?orderby=popularity&filter_model=coffee-mug">coffee mug</a>');
            }
          }
        echo '</p></div>';
		  }
      
    endif;
  }
}


if ( ! function_exists( 'sasabudi_catalog_archive_tags' ) ) {
  /**
   * Shows a list of randomly generated tags.
   */	
  function sasabudi_catalog_archive_tags() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      if ( is_product_tag() ) {

        // Get all terms
        $term_id  = get_queried_object()->term_id;
        $tag_id   = array($term_id);
        $terms    = get_terms( array(
          'taxonomy'     => 'product_tag',
          'hide_empty'   => false,
          'exclude'      => $tag_id
        ) );  

        // Randomize Term Array
        shuffle( $terms );

        // Grab Indices 0 - 10
        $random_terms = array_slice( $terms, 0, 10 );
        if ( ! empty( $random_terms ) && ! is_wp_error( $random_terms ) ) {
          echo '<div class="catalog-tags">';
            foreach ( $random_terms as $term ) {
              echo '<a class="tagged" href="'.get_term_link($term->slug, 'product_tag').'" rel="tag">'.$term->name.'</a>';
            }
          echo '</div>';
        }
      }

    endif;
  }
}

if ( ! function_exists( 'sasabudi_catalog_result_filter' ) ) {
  /**
   * Shows the filter menu section in the product archive
   * page with its layered navigation.
   */	
  function sasabudi_catalog_result_filter() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $wp_query;
      $total = $wp_query->found_posts;
      $item = ($total > 1) ? esc_html__('Items','sasabudi') : esc_html__('Item','sasabudi');	
      
      // Build archive filter
      echo '<div class="catalog-archive__filter">';
        echo '<ul class="filter-bar">';

          echo '<li class="filter-bar__btn">';
            echo '<a href="#" class="filter-bar__btn--filter">' . esc_html__( 'Filters', 'sasabudi' ) . '</a>';
          echo '</li>';

          echo '<li class="filter-bar__nav">';
            dynamic_sidebar( 'layered-navigation' );
          echo '</li>';

          echo '<li class="filter-bar__total">';
            echo '<span>' . $total . ' ' . $item . '</span>';
          echo '</li>';

        echo '</ul>';		
      echo '</div>';

    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_breadcrumb' ) ) {
  /**
   * Shows the breadcrump at the top in the single product page.
   */	
  function sasabudi_product_single_breadcrumb() {

    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $post, $product;
      $category_terms = null;
      $product_id     = $product->get_id();
      $product_terms  = wp_get_post_terms($product_id, 'product_cat');
      $product_title  = get_the_title($post->post_parent);	

      // Build Summary Breadcrumb
      echo '<nav class="summary-breadcrumb">';
			  echo '<ul>';	

          // Catalog
          if ( is_product() ) {
            echo '<li>';
              echo '<a class="product-link" href="' . apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) .'">' . esc_html__('Catalog ', 'sasabudi') . '</a>';
            echo '</li>';
          }

          // Category
          if ( $product_terms && !is_wp_error($product_terms) ) {
            
            /** 
             * HACK :: Exclude 'new-arrivals' && 'exclusive'
             */
            $category_terms = array_slice($product_terms, 0, 3);
            $category_count = count($category_terms);

            if ($category_count == 1) {
              $slug_0 = $category_terms[0]->slug;
              $slug_1 = null;
              $slug_2 = null;
              $name_0 = $category_terms[0]->name;
              $name_1 = null;
              $name_2 = null;
            }
            else if ($category_count == 2) {
              $slug_0 = $category_terms[0]->slug;
              $slug_1 = $category_terms[1]->slug;
              $slug_2 = null;
              $name_0 = $category_terms[0]->name;
              $name_1 = $category_terms[1]->name;
              $name_2 = null;
            }
            else if ($category_count == 3) {
              $slug_0 = $category_terms[0]->slug;
              $slug_1 = $category_terms[1]->slug;
              $slug_2 = $category_terms[2]->slug;
              $name_0 = $category_terms[0]->name;
              $name_1 = $category_terms[1]->name;
              $name_2 = $category_terms[2]->name;
            }
        
            $category_slug = [];
            $category_name = [];

            // evaluate categroy
            if($slug_0 != 'new-arrivals' && $slug_0 != 'exclusive') {
              array_push($category_slug, $slug_0);
              array_push($category_name, $name_0);
            }
            if($slug_1 != 'new-arrivals' && $slug_1 != 'exclusive') {
              array_push($category_slug, $slug_1);
              array_push($category_name, $name_1);
            }
            if($slug_2 != 'new-arrivals' && $slug_2 != 'exclusive') {
              array_push($category_slug, $slug_2);
              array_push($category_name, $name_2);
            }

            // apply category
            if ( isset($category_slug[0]) ) {
              echo '<li>';
                echo '<span class="spacer">/</span><a class="product-link" href="' . apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) . '' . $category_slug[0] . '">' . $category_name[0] . '</a>';        
              echo '</li>';
            }
          }

          // Model 
          if ( $category_terms && !is_wp_error($category_terms) ) {
            
            $attribute_type = get_the_terms($product_id, 'pa_model', array('hide_empty'=>true));
            $attribute_name = isset($attribute_type[0] ) ? $attribute_type[0]->name : '';
            $attribute_slug = isset($attribute_type[0] ) ? $attribute_type[0]->slug : '';
            $attribute_url  = apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) . $category_slug[0] . '/?filter_model=' . $attribute_slug;

            // apply model
            if ( isset($category_slug[0]) ) {
              echo '<li>';
                echo '<span class="spacer">/</span><a class="product-link active" href="' . $attribute_url . '">' . $attribute_name . '</a>';
              echo '</li>';
            }
          }
          
          // Apply product edit
          if ( current_user_can( 'edit_posts' ) ) {
            echo '<li>';
              echo '<span class="spacer">/</span><span><a class="edit-item" href="' . get_edit_post_link( $post->id ) .' " target="_blank">[Edit]</a></span>';
            echo '</li>';
          }

          // Get next and prev products
          /*
          if ( is_single() ) {

            // Settings
				    $product_title = get_field('next_product_title');
				    $product_link = get_field('next_product_link');

            // Build summary navigation
            echo '<div class="summary-navigation" role="navigation">';

              if ( $product_title && $product_link ) {
                
                // product object
                $product_obj = $product_link[0];
                $product_id = $product_obj->ID;
                $product_img = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'small' );
                
                echo '<a href="' . get_permalink( $product_id ) . '">';
                  echo '<div class="next-thumb"><img src="' . $product_img[0] . '"></div>';
                  echo '<div class="next-product">' . $product_title . '</div>';
                  echo '<div class="next-arrow"></div>';	
                echo '</a>';

              }
            echo '</div>';
          }
          */

        echo '<ul>';
		  echo '</nav>';

    endif;

  }
}

if ( ! function_exists( 'sasabudi_product_single_highlights' ) ) {
  /**
   * Shows the highlights for the device version at the top
   * of the single product page.
   */	
  function sasabudi_product_single_highlights() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $product;
      $style_name = '';
      $product_sales = '0';
      $product_sales = get_field('shop_product_sales', 'option');
      $product_sales = ($product_sales == '1') ? true : false;

      /**
       * Show the product 'title' and append it with a
       * red 'sale' expression if the product is on sale.
       */
      echo '<div class="summary-highlights">';
        
        if ( $product->is_on_sale() && $product_sales ) {
          echo '<h2 itemprop="name" class="product-title"><span class="item-fit">' . $style_name . '</span>' . get_the_title() . ' - <span class="item-sale">'. esc_html__( 'Sale', 'sasabudi' ) . '</span></h2>';
        } else {
          echo '<h2 itemprop="name" class="product-title"><span class="item-fit">' . $style_name . '</span>' . get_the_title() . '</h2>';
        }
        echo '<p class="price">' . $product->get_price_html() . '</p>';
    
      echo '</div>';

    endif;

  }
}

if ( ! function_exists( 'sasabudi_product_single_images' ) ) {
  /**
   * Includes the product image template for
	 * the single product page.
   */	
  function sasabudi_product_single_images() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      wc_get_template( 'single-product/product-image.php' );
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_title' ) ) {
  /**
   * Includes the product title template for the
	 * single product page.
   */	
  function sasabudi_product_single_title() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      wc_get_template( 'single-product/title.php' );
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_price' ) ) {
  /**
   * Includes the product price template for the
	 * single product page.
   */	
  function sasabudi_product_single_price() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      wc_get_template( 'single-product/price.php' );
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_options' ) ) {
  /**
   * Includes the 'related items' section filtered by attributes for
   * the single product page.
   */	
  function sasabudi_product_single_options() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Settings
      global $post, $product;
      $product_id = $post->ID;

      // Check first for existing product variations
      if (have_rows('shop_product_variations', $product_id)) :

        // Get relationship by post id
				$related_items = get_fields($product_id);
        $variatons_ids = $related_items['shop_product_variations'];
        
        // Build product options
				echo '<div class="product-options">';
					echo '<h4 class="options-title">' . esc_html__( 'Select Model', 'sasabudi' ) . '</h4>';

          // Add variations
          if ($variatons_ids) {

            echo '<ul class="options-content">';

              for ($i = 0; $i < count($variatons_ids); $i++) {

                // Arguments
                $attribute_name = '';
                $variation_id   = $variatons_ids[$i];
								$product_inks   = get_the_terms( $variation_id, 'pa_colour', array( 'hide_empty'=>true ));
                $product_thumbs = get_the_terms( $variation_id, 'pa_icon', array( 'hide_empty'=>true ));

                // Evaluate colour or icon
                if ($product_inks) :
									// Product Ink Name
									$attribute_name = $product_inks[0]->name;
								elseif ($product_thumbs) : 
									// Product Thumb Name
									foreach ($product_thumbs as $thumb) {
										$attribute_name = $thumb->name;
									}
                endif;
                
                // Arguments
                $product_title = get_the_title($variation_id);
								$product_item = wc_get_product($variation_id);
								$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_item->get_id() ), 'woocommerce_gallery_thumbnail' );
                $active = ($product_id == $variation_id ? ' active-variant' : '');
        
                // Build product variants
								echo '<li class="pa-color' . $active . '">';
									echo '<a href="' . get_permalink($variation_id) . '" alt="' . $product_title . '" title="' . $product_title . '">';
										echo '<figure><img src="' . $product_image[0] . '"></figure>';
										echo '<h6>' . $attribute_name . '</h6>';
									echo '</a>';
                echo '</li>';
                
              }

            echo '</ul>';
            
          }
          
        echo '</div>';

      endif;

    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_add_to_cart' ) ) {
  /**
   * Includes the 'add to cart' section for
	 * the single product page.
   */	
  function sasabudi_product_single_add_to_cart() {

    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      global $product;

      // Build add to cart
      do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
      
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_meta' ) ) {
  /**
   * Includes the product meta template for the
	 * single product page.
   */	
  function sasabudi_product_single_meta() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      wc_get_template( 'single-product/meta.php' );
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_tabs' ) ) {
  /**
   * Includes the product tabs template for the
	 * single product page.
   */	
  function sasabudi_product_single_tabs() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      wc_get_template( 'single-product/tabs/tabs.php' );
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_tagged_as' ) ) {
  /**
   * Includes the 'tagged' product section for the
	 * single product page.
   */	
  function sasabudi_product_single_tagged_as() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

			global $product;
    
			// Settings
			$sep = '';
			$before = '';
      $after = '';

      // Retrieve tags
			$category_tags = wc_get_product_tag_list( $product->get_id(), $sep, $before, $after );
   
      // Build tag feed
			echo '<div class="tagged">';
        echo '<div class="is-wrapper">';      
          echo $category_tags;    
				echo '</div>';
      echo '</div>';
      
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_related_items' ) ) {
  /**
   * Includes the 'related' product items as a slider feed for
   * the single product page.
   */	
  function sasabudi_product_single_related_items() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      global $product; // If not set…

      if ( ! is_a( $product, 'WC_Product' ) ){
          $product = wc_get_product(get_the_id());
      }
      
      // Arguments
      $args = array(
          'posts_per_page' => 4,
          'columns'        => 4,
          'orderby'        => 'rand',
          'order'          => 'desc',
      );
      
      // Related product arguments
      $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
      $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );
      
      // Set global loop values
      wc_set_loop_prop( 'name', 'related' );
      wc_set_loop_prop( 'columns', $args['columns'] );
      
      // Include related template
      wc_get_template( 'single-product/related.php', $args );

    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_single_recently_viewed' ) ) {
  /**
   * Includes the 'recently viewed' section for the
	 * single product page.
   */	
  function sasabudi_product_single_recently_viewed() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

			global $woocommerce;

      // Settings
      $per_page = get_field('shop_recently_viewed', 'option');

      // Get recently viewed product cookies data
			$recently_viewed = ! empty( $_COOKIE['wp_wc_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['wp_wc_recently_viewed'] ) : array();
			$reversed_viewed = array_reverse($recently_viewed);

			// If no data, quit
      if ( empty( $reversed_viewed ) ) return;

      // Get products per page
      if( !isset( $per_page ) ? $number = 6 : $number = $per_page );

      // Create query arguments array
      $query_args = array(
        'posts_per_page' => $number, 
        'no_found_rows'  => 1, 
        'post_status'    => 'publish', 
        'post_type'      => 'product', 
        'post__in'       => $reversed_viewed, 
        'orderby'        => 'post__in'
      );

      // Add meta_query to query args
      if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
        $query_args['tax_query'] = array(
          array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'outofstock',
            'operator' => 'NOT IN'
          )
        );
      }

			// Create a new query
      $loop_recently = new WP_Query($query_args);
      
      // If query return results
      if ( $loop_recently->have_posts() ) :
        echo '<div class="recently">';
          echo '<div class="is-extended">';

          // Recently Title
          echo '<h2 class="recently-title">' . esc_html__('Recently Viewed', 'sasabudi') . '</h2>';
          
          // Recently Products
          echo '<div class="recently-products">';
						echo '<ul class="products">';
              while ($loop_recently->have_posts() ) : $loop_recently->the_post();
                wc_get_template_part( 'content', 'product-recently' );
              endwhile;	
            echo '</ul>';
          echo '</div>';

          echo '</div>';
        echo '</div>';
      endif;

      wp_reset_postdata();
    endif;
  }
}

if ( ! function_exists( 'sasabudi_product_cart_shipping_max' ) ) {
  /**
   * Evalutates the shipping max amout and show the current status
   * with a prograss bar.
   */	
  function sasabudi_product_cart_shipping_max() {

    // Attributes
    $shipping_method  = '';	
    $shipping_amount  = 0;
    //$cookie_name      = 'wp_store_selector_UgNz4K';
    //$cookie_value     = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name]: null;
    $subtotal         = 0;
    $carttotal        = 0;
    $packages         = WC()->cart->get_shipping_packages();
    $package          = reset( $packages );
    $zone             = wc_get_shipping_zone( $package );
    $destination      = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
    
    // Calculate cart total amount
    $subtotal = WC()->cart->get_displayed_subtotal();
    if ( WC()->cart->display_prices_including_tax() ) {
      $carttotal = round( $subtotal - ( WC()->cart->get_discount_total() + WC()->cart->get_discount_tax() ), wc_get_price_decimals() );
    } else {
      $carttotal = round( $subtotal - WC()->cart->get_discount_total(), wc_get_price_decimals() );
    }

    echo '<li class="mini-cart__shipping">';

      foreach ( $zone->get_shipping_methods( true ) as $k => $method ) {
        $shipping_amount = $method->get_option( 'min_amount' );
        $shipping_method = $method->get_option( 'title' );

        // Carttotal < Min Amount
        if ( $method->id == 'free_shipping' AND ! empty( $shipping_amount ) AND $carttotal < $shipping_amount ) {
          $remaining = $shipping_amount - $carttotal;
          echo '<p class="mini-cart__shipping--message">' .  sprintf(esc_html__('Almost there! Add %s to unlock %1s', 'sasabudi'), wc_price( $remaining ), $shipping_method) . '</p>';
        }

        // Carttotal >= Min Amount
        if ( $method->id == 'free_shipping' AND ! empty( $shipping_amount ) AND $carttotal >= $shipping_amount ) {
          echo '<p class="mini-cart__shipping--message">' .  sprintf(esc_html__('%s  You have unlocked %1s!', 'sasabudi'), '<strong>Congrats!</strong>', $shipping_method ) . '</p>';
        }

      }
      // Show Progressbar lenght
      echo '<div class="mini-cart__progressbar">';
        $percent_amount   = ceil(($carttotal / floor($shipping_amount)) * 100);
        $progress_amount  = $percent_amount >= 100 ? 100 : $percent_amount;
        echo '<div class="mini-cart__progressbar--progress" style="width:' . $progress_amount . '%;"></div>';
      echo '</div>';

      // Show shipping options
      echo '<span class="mini-cart__options">';
        if ($destination) {
          printf( esc_html__( 'Shipping options estimated for %s.', 'sasabudi' ) . ' ', '<strong>' . esc_html( $destination ) . '</strong>' );
        } else {
          echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', esc_html__( 'Shipping options will be updated during checkout', 'sasabudi' ) ) );
        }
      echo '</span>';

    echo '</li>';
  }
}


if ( ! function_exists( 'sasabudi_product_cart_cross_sell' ) ) {
  /**
   * sasabudi_product_cart_cross_sell
   */	
  function sasabudi_product_cart_cross_sell() {
    global $woocommerce;
    $crosssel_ids = array();
    foreach ( $woocommerce->cart->get_cart() as $item ) {
      if( $item_crosssel_ids = get_post_meta( $item['product_id'], '_crosssell_ids', true ) ) {
        $crosssel_ids = array_unique( array_merge( $item_crosssel_ids, $crosssel_ids ));
      }
    }
    /* product query */
    if( !empty( $crosssel_ids ) ) :
      $amount = 2;
      $args = array(
        'post_type'           => array('product'),
        'posts_per_page'      => $amount,
        'post_status'         => 'publish',
        'post__in'            => $crosssel_ids,
        'orderby'             => 'post__in',
        'meta_query' => array(
          array(
            'key' => '_stock_status', // Don't show out of stock items
            'value' => 'instock'
          )
        ),
      );
      $crosssel_query = new WP_Query( $args );
      if ( $crosssel_query->have_posts() ) {
        while ( $crosssel_query->have_posts() ) : $crosssel_query->the_post();
          $product_id = $crosssel_query->post->ID;
          $thumbnail_id = get_post_thumbnail_id( $product_id );
          $product_image = wp_get_attachment_image_src( $thumbnail_id, 'woocommerce_gallery_thumbnail' );
          echo '<li class="mini-cart__crossell">';
            echo '<div class="mini-cart__item--left">';
              if ( isset( $product_image )) {
                echo '<img class="" src="' . $product_image[0] . '" width="100%" heigth="100%" alt="">';
              }
            echo '</div>';
            echo '<div class="mini-cart__item--right">';
              echo '<h2 class="product-title">' . get_the_title() . '</h2>';			
            echo '</div>';
          echo '</li>';
          wp_reset_postdata();
        endwhile;
      }
    endif;
  }
}

if ( ! function_exists( 'sasabudi_cart_continue_shopping' ) ) {
	/**
	 * Show the "continue" section at the end of cart totals.
	 */	
	function sasabudi_cart_continue_shopping() {
		if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      echo '<div class="continue-description">';
        echo '<p>';
          printf( esc_html__( 'Need Help? Visit our %1$s before writing an %2$s or %3$s.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/faqs/')) . '">FAQs</a>', '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">email</a>', '<a class="primary-link" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '">continue shopping</a>' );
        echo '</p>';
      echo '</div>';
		endif;
	}	
}