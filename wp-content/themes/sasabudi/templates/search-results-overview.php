<?php
/**
* The template part for search overview section
*
* @package WordPress
* @subpackage SASABUDI
* @since 1.0
*/

/* Left */
echo '<div class="overview-left">';
  
  /** Categories **/
  echo '<section class="overview-categories">';
    echo '<ul class="categories-lists">';
      /* Left */
      echo '<li class="category-list">';
      echo '<h3 class="category-title">Catalog</h3>';
        echo '<ul class="category-links shop-all">';
          echo '<li><a href="' . esc_url( home_url( '/catalog/new-arrivals/?orderby=date' ) ) .'">New Arrivals</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity' ) ) .'">Best Sellers</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/exclusive/?orderby=date' ) ) .'">On our Radar</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/collections/' ) ) .'">Collections</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/instashop/' ) ) .'">#SASABUDI</a></li>';
          echo '<li class="shop-all"><a href="' . esc_url( home_url( '/catalog/mugs/?orderby=popularity&filter_model=coffee-mug' ) ) .'" class="shop-all">Coffee Mugs</a></li>';
        echo '</ul>';
      echo '</li>';
      /* Middle */
      echo '<li class="category-list">';
        echo '<h3 class="category-title">Themes</h3>';
        echo '<ul class="category-links">';     
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=kids' ) ) .'">Kids</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=geometric' ) ) .'">Geometric</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=typography' ) ) .'">Typography</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=popart' ) ) .'">Pop Art</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=urbanart' ) ) .'">Urban Art</a></li>';
        echo '</ul>';
      echo '</li>';
      /* Right */
      echo '<li class="category-list">';
        echo '<h3 class="category-title"></h3>';
        echo '<ul class="category-links">';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=love' ) ) .'">Love</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog?orderby=popularity&filter_theme=quote' ) ) .'">Quote</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=illustration' ) ) .'">Illustration</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=motivational' ) ) .'">Motivational</a></li>';
          echo '<li><a href="' . esc_url( home_url( '/catalog/?orderby=popularity&filter_theme=black-white' ) ) .'">Black & White</a></li>';
        echo '</ul>';
      echo '</li>';
    echo '</ul>';
  echo '</section>';

  /** Collection **/
  echo '<section class="overview-collection">';
    echo '<h3 class="overview-title">' . __('Collection', 'sasabudi') . '</h3>';
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      // Settings
      $amount = 1;
      $paged 	= 1;
      // Arguments
      $collQuery = array(
        'post_type' => array('collections'),
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'date',
        'meta_query' => array( // check if featured meta box checkbox is active
          array(
            'key' => 'collections_checkbox',
            'value' => 'on',
          )
        ),
        'posts_per_page' => $amount,
        'paged' => $paged
      );

      /* WPQuery */
      $collectionQuery = new WP_Query($collQuery);
      if ($collectionQuery->have_posts()) :
        echo '<ul class="collection-teaser">';
          while($collectionQuery->have_posts()) : $collectionQuery->the_post();
          
            // Arguments
            $featured_size    = 'medium';
            $featured_title   = get_field('ws_collection_title');
            $featured_desc    = get_field('ws_collection_short_desc');
            $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), $featured_size );

            // Build Collection Thumbnail
            echo '<li class="collection-teaser__thumbnail">';
              echo '<figure class="thumb-figure">';
                echo '<div class="thumb-figure__image lazy-bg" style="background-image: url(https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png)" width="128px" heigth="128px" data-src="' . $featured_img_url .  '"></div>';
                echo '<a class="thumb-figure__link" href="' . esc_url( get_permalink() ) . '"></a>';
              echo '</figure>';
            echo '</li>';
            // Build Collection Description
            echo '<li class="collection-teaser__description">';
              echo '<div class="collection-teaser__description--wrapper">';
                echo '<h3 class="description-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $featured_title . '</a></h3>';
                echo '<p>' . $featured_desc. '</p>';
              echo '</div">';
            echo '</li>';
          endwhile;
        echo '</ul>';
      endif;
      wp_reset_postdata();
    endif;
  echo '</section>';
echo '</div>';

/* Right */
echo '<div class="overview-right">';
  
  /** Products **/
  echo '<section class="overview-products">';
    echo '<h3 class="overview-title">' . __('Random Products', 'sasabudi') . '</h3>';
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :
      $amount = 4;
      $size = 'medium'; // (thumbnail, medium, large, full or custom size)
      $argsQuery = array(
        'post_type' => array('product'),
        'post_status' => 'publish',
        'posts_per_page' => $amount,
        'orderby' => 'rand',
        'order' => 'desc',
        'tax_query' => array(
          'taxonomy' => 'product_visibility',
          'field'    => 'name',
          'terms'    => 'featured',
          'operator' => 'IN' // or 'NOT IN' to exclude feature products
        ),
        'meta_query' => array(
          array(
          'key' => '_stock_status', // Don't show out of stock items
          'value' => 'instock'
          )
        )
      );
      /* WPQuery */
      $overviewQuery = new WP_Query( $argsQuery );
      if ($overviewQuery->have_posts()) :
        // Build Overview Random Product List of 4
        echo '<ul class="results">';
          while($overviewQuery->have_posts()) : $overviewQuery->the_post();
            // Attributes
            global $product;
            $attachment_ids = null;
            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $overviewQuery->get_product_id() ), 'medium' );
            $image_primary = $image_url[0];
            $image_secondary = null;
            $product_id = $overviewQuery->post->ID;
            $product_sale = 0;
            $product_title = '<h3 class="item-box__model--title">' . get_the_title() . '</h3>';
            $product_price = $product->get_price_html();
            $product_sales = get_field('shop_product_sales', 'option');
            $product_sales = ($product_sales == '1') ? true : false;
            $product_variants = '';
            $variations_num = 0;
            // Check for product 'sale' flag
            if($product->is_on_sale() && $product_sales) {
              $product_sale = 1;
              $product_title = '<h3 class="item-box__model--title">' . get_the_title() . '<span> – </span><span class="item-box__model--sale">'. __( 'Sale', 'sasabudi' ) . '</span></h3>';
            }
            // Check for product 'secondary' image
            $secondaryImage	= get_field('shop_product_second_image', 'option');
            $secondaryImage = ($secondaryImage == '1') ? true : false;
            if($secondaryImage) {
              $secondaryIDs = $product->get_gallery_image_ids();
              $image_secondary = isset($secondaryIDs[0]) ? wp_get_attachment_image_src( $secondaryIDs[0], 'medium')[0] : ' ';
            }
            
            // Check for product 'variations'
            if(have_rows('shop_product_variations', $product_id)) :
              // Product variations
              $product_variations = get_fields($product_id);
              $variations_ids = $product_variations['shop_product_variations'];
              $variations_num = count($variations_ids);
              // Show only the color variation box when there is more then 1 variant
              if($variations_num > 1) {
                $product_variants .= '<div class="item-box__color--variant">';
                $product_variants .= '<object>';
                for($i = 0; $i < count($variations_ids); $i++) {
                  // Variant
                  $variant_id = $variations_ids[$i];
                  $variant_product = wc_get_product($variant_id);
                  // First Image
                  $variant_image = wp_get_attachment_image_src( get_post_thumbnail_id( $variant_id ), 'medium' );
                  $variant_first_image = isset($variant_image[0]) ? $variant_image[0] : ' ';
                  // Second Image
                  $variant_second_image = null;
                  if ($secondaryImage) {
                    $variant_ids = $variant_product->get_gallery_image_ids();
                    $variant_second_image = isset($variant_ids[0]) ? wp_get_attachment_image_src( $variant_ids[0], 'medium')[0] : ' ';
                  }
                  // Variant URL
                  $variant_url = get_permalink( $variant_id );
                  $product_url = isset($variant_url) ? ' href="' . $variant_url . '" class="variant-color" data-s-trigger="on" data-g-src="' . $image_secondary . '" data-s-src="' . $variant_second_image . '"  data-s-id="o-' . $product_id . '"' : '';
                  // Variant Terms
                  $terms_color = get_the_terms( $variant_id, 'pa_colour', array( 'hide_empty'=>true ));
                  $terms_icon = get_the_terms( $variant_id, 'pa_icon', array( 'hide_empty'=>true ));
                  /* Render color swatches */
                  if ($terms_color && !is_wp_error($terms_color)) {
                    foreach ($terms_color as $color_item) {
                      $color_value = get_field('shop_product_colour', $color_item->taxonomy . '_' . $color_item->term_id);
                      $color_active = $product_id == $variant_id ? ' origine active' : '';
                      $color_name = $color_item->name;
                      $product_variants .= '<a' . $product_url . '>';
                      $product_variants .= '<span class="variant-color__icon' . $color_active . '" title="' . $color_name . '" style="background-color:' . $color_value . '">' . $color_name . '</span>';
                      $product_variants .= '</a>';
                    }
                  }
                  /* Render color icons */
                  if ($terms_icon && !is_wp_error($terms_icon)) {
                    foreach ($terms_icon as $thumb_item) {
                      $icon_value = get_field('shop_product_icon', $thumb_item->taxonomy . '_' . $thumb_item->term_id);
                      $icon_active = $product_id == $variant_id ? ' origine active' : '';
                      $icon_name = $thumb_item->name;
                      $product_variants .= '<a' . $product_url . '>';
                      $product_variants .= '<span class="variant-color__icon' . $icon_active . '" title="' . $icon_name . '" style="background-image: url(' . $icon_value . ')">' . $icon_name . '</span>';
                      $product_variants .= '</a>';
                    }
                  }
                }
                $product_variants .='</object>';
                $product_variants .='</div>';
              }
            endif;

            // Build Product Article List 
            echo '<li class="result-item" data-id="' . $product_id . '">';
              echo '<article class="result-article">';
                echo '<a href="' . esc_url( get_permalink() ) . '" tabindex="0">';
                  // Build Product Article Secondary & Primary Images & Sale Tag
                  echo '<div class="result-article__figure">';
                    echo $product_sale == 1 ? '<div class="result-article__sale">' . __( 'Sale', 'sasabudi' ) . '</div>' : '';
                    if ($image_secondary) {
                      echo '<img class="result-article__figure--secondary lazy-img" id="o-' . $product_id . '" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" data-src="' . $image_secondary . '">';
                    }
                    if ($image_primary) {
                      echo '<img class="result-article__figure--primary lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" data-src="' . $image_primary . '">';
                    } else {
                      echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img class="result-article__figure--primary lazy-fade" src="%s" alt="Sasabudi\'s image placeholder" />', wc_placeholder_img_src() ), $post->ID );     
                    }
                  echo '</div>';
                  // Build Product Article Description
                  echo '<div class="result-article__desc">';
                    echo '<div class="item-box">';
                      echo '<div class="item-box__model">' . $product_title . '</div>';
                      echo '<div class="item-box__price">' . $product_price . '</div>';
                      if($variations_num > 1) {
                        echo '<div class="item-box__color">' . $product_variants . '</div>';
                      }
                    echo '</div>';
                  echo '</div>';
                echo '</a>';
              echo '</article>';
            echo '</li>';
          endwhile;
        echo '</ul>';
      endif;
      wp_reset_postdata();
    endif;
  echo '</section>';
echo '</div>';
