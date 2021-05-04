<?php
/**
 * The template functions used for displaying the 'home' definitions.
 * 
 * - sasabudi_home_products_banner
 * - sasabudi_home_products_statement
 * - sasabudi_home_products_categories
 * - sasabudi_home_products_custom_categories (custom categories style)
 * - sasabudi_home_products_collection
 * - sasabudi_home_products_trending
 * - sasabudi_home_artist_blog
 * - sasabudi_home_instagram_feed
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_home_products_banner' ) ) {

  /**
   * Shows the homepage product 'banner' section.
   */
  function sasabudi_home_products_banner() {

    // Settings
    $banner_amount 	= 6;
    $banner_count   = 1;

    // Arguments
    $args = array(
      'post_type' => array('banner'),
      'post_status' => 'publish',
      'posts_per_page' => $banner_amount,
      'orderby'        => 'rand'
    );

    // New instance of WP_Query
    $banner_query = new WP_Query( $args );

    // If WP_Query return results
    if ($banner_query->have_posts()) :

      while($banner_query->have_posts()) : $banner_query->the_post();

        if ( $banner_count == 1 ) {

          // Banner Info
          $banner_id        = get_the_ID();
          $banner_title     = get_field('ws_banner_title');
          $banner_off       = get_field('ws_banner_off');
          $banner_color     = get_field('ws_banner_color');
          $banner_desc      = get_field('ws_banner short_description');

          // Banner Image
          $image_id 	   = get_post_thumbnail_id($banner_id);
          $image_url     = wp_get_attachment_url($image_id);
          $image_alt     = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          $image_title   = get_the_title($image_id);

          // Mugs Image
          $thumb_object     = get_field('ws_banner_excerpt'); 
          $thumb_size       = 'medium';
          $thumb_id         = $thumb_object['ID'];
          $thumb_alt        = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
          $thumb_url        = $thumb_object['sizes'][$thumb_size];
          $thumb_title      = get_the_title($thumb_id);

          // Avatar Image
          $avatar_object    = get_field('ws_banner_avatar'); 
          $avatar_size      = 'thumbnail';
          $avatar_id        = $avatar_object['ID'];
          $avatar_alt       = get_post_meta($avatar_id, '_wp_attachment_image_alt', true);
          $avatar_url       = $avatar_object['sizes'][$avatar_size];
          $avatar_title     = get_the_title($avatar_id);

          // Banner Button
          $button_title  = get_field('ws_action_button_title');
          $button_link   = get_field('ws_action_button_link');

          // Build Banner
          echo '<div id="hero_banner" class="banner" style="background-color: ' . $banner_color . ';">';

            echo '<div class="banner-box">';

              echo '<div class="banner-box__teaser">';
                echo '<div class="thumb-img" style="background-image: url(' . $thumb_url . ')" alt="' . $thumb_alt . '">' . $thumb_title . '</div>';
                echo '<div class="thumb-desc">';
                  echo '<span>' . $banner_off . '</span>';
                  echo '<h1>' . $banner_title  . '</h1>';
                  echo '<p>' . $banner_desc . '</p>';
                echo '</div>';
              echo '</div>';

              echo '<div class="banner-box__avatar"><img src="'. $avatar_url . '" alt="'. $avatar_alt . '" title="'. $avatar_title . '" /></div>';
              echo '<div class="banner-box__discover"><a href="' . $button_link . '">Discover</a></div>';
              
            echo '</div>';

            // background image
            echo '<img class="banner-image device" src="' . $image_url .  '" alt="' . $image_alt  . '" title="' . $image_title . '" />';
            echo '<img class="banner-image desktop" src="' . $image_url .  '" alt="' . $image_alt  . '" title="' . $image_title . '" />';
          
          echo '</div>';
          
          // Build Button
          echo '<div class="banner-explore">';
            echo '<a class="banner-explore__button" href="' . $button_link . '">' . $button_title . '</a>';
          echo '</div>';
        };

        $banner_count++;

      endwhile;
    
    endif; 

    wp_reset_postdata();

  }
}

if ( ! function_exists( 'sasabudi_home_products_statement' ) ) {

  /**
   * Shows the homepage product 'statement' section.
   */
  function sasabudi_home_products_statement() {

    $page_section = 'home';

    if( is_page_template( 'page-about.php' )) {
      $page_section = 'about';
    }
    else if( is_page_template( 'page-help.php' )) {
      $page_section = 'help';
    }
    else if( is_page_template( 'page-policy.php' )) {
      $page_section = 'policy';
    }

    // Build statements slider
    echo '<div class="statements">';
      echo '<div class="is-wrapper">';
        
        // Glide Slider
        echo '<div class="glide" id="glide_statements" >';
          echo '<div class="glide__track" data-glide-el="track">';
            echo '<ul class="glide__slides">';
              
              // Authentic artwork
              echo '<li class="glide__slide">';
                echo '<div class="glide__slide--artwork"></div>';
                echo '<h4>' . esc_html__('Inspiring Artwork', 'sasabudi') . '</h4>';
                echo '<p>' . esc_html__('SASABUDI artworks are inspiring. We believe in creativity and deliver products with a great design that creates an everyday environment for your personal style.', 'sasabudi') . '</p>';
              echo '</li>';

              // Custom Made
              echo '<li class="glide__slide">';
                echo '<div class="glide__slide--order"></div>';
                echo '<h4>' . esc_html__('Made To Order', 'sasabudi') . '</h4>';
                echo '<p>' . esc_html__('SASABUDI products are custom made and individually printed at the time of order - just for you! Please allow 2-5 business days for the manufacture time of your item.', 'sasabudi') . '</p>';
              echo '</li>';

              // Worldwide shipping
              echo '<li class="glide__slide">';
                echo '<div class="glide__slide--shipping"></div>';
                echo '<h4>' . esc_html__('Worldwide Shipping', 'sasabudi') . '</h4>';
                echo '<p>'; 
                  printf(  esc_html__('SASABUDI works with selected manufacturing partners in the USA, Europe, Japan and Australia. Please note the following %1$s for worldwide delivery.', 'sasabudi'), '<a class="primary-link" href="' . esc_url( home_url('/help/shipping/') ) . '">shipping times</a>' );
                echo '</p>';
              echo '</li>';

            echo '</ul>';
          echo '</div>';

          // Bullets
          echo '<div class="glide__bullets" data-glide-el="controls[nav]">';
            echo '<button class="glide__bullet" data-glide-dir="=0"></button>';
            echo '<button class="glide__bullet" data-glide-dir="=1"></button>';
            echo '<button class="glide__bullet" data-glide-dir="=2"></button>';
          echo '</div>';

        echo '</div>';
        
      echo '</div>';
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_home_products_categories' ) ) {

  /**
   * Shows the homepage product 'categories' section.
   */
  function sasabudi_home_products_categories() {

    // Settings
    $catTerms = get_terms( array(
      'taxonomy' => 'product_cat',
      'hide_empty' => false,
      'orderby' => 'term_group' // 'name', 'slug', 'term_group', 'term_id', 'id', 'description'
      //'order' => 'desc' 
    ));
    $catNum = count($catTerms);

    if ( $catNum >= 1 ) {	
      $counter = 1;

      echo '<div class="categories">';
        echo '<div class="is-extended">';

          echo '<div class="category-themes">';

            foreach($catTerms as $catTerm) :

              if( $counter > 0 AND $counter < 4 ) {
                
                // Settings
                $image_id 	  = get_term_meta( $catTerm->term_id, 'thumbnail_id', true ); 
                $image_alt    = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                $image_title  = get_the_title($image_id);
                $image_url 	  = esc_url((wp_get_attachment_image_src( $image_id, 'medium' )[0]));
                $cat_title 	  = get_field('shop_category_title', $catTerm->taxonomy . '_' . $catTerm->term_id);
                $cat_name 	  = get_field('shop_category_button_name', $catTerm->taxonomy . '_' . $catTerm->term_id);
                $cat_count 	  = $catTerm->count;

                // Build category articles
                echo '<article class="category-article">';
                  echo '<figure class="category-figure">';
                    echo '<a href="' . esc_url( get_term_link( $catTerm ) ) . '">';
                      echo '<div class="category-figure__title">';
                        echo '<h2>' . $cat_title . '</h2>';
                        echo '<span class="category-figure__button">' . $cat_name . '</span>';
                      echo '</div>';
                      echo '<div class="category-figure__white"></div>';
                      echo '<div class="category-figure__image lazy-bg" style="background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)" width="100%" heigth="100%" alt="' . $image_alt  . '" title="' . $image_title . '" data-src="' . $image_url .  '"></div>';
                    echo '</a>';
                  echo '</figure>';
                echo '</article>';
              }

              // Increment counter
              $counter++;
              
            endforeach;

          echo '</div>';

        echo '</div>';
      echo '</div>';
    }
  }
}


if ( ! function_exists( 'sasabudi_home_products_custom_categories' ) ) {

  /**
   * Shows the homepage product cusutom 'categories' section.
   */
  function sasabudi_home_products_custom_categories() {

    echo '<div class="categories">';
      echo '<div class="is-extended">';
        echo '<div class="category-themes">';

          // Settings
          $image_1_url 	    = 'https://sasabudi.com/wp-content/uploads/2021/04/Sasabudi-We-All-Love-Mugs.jpg';
          $image_1_alt      = 'We All Love Mugs';
          $image_1_title    = 'We All Love Mugs';
          $category_1_title = 'We All Love Mugs';
          $category_1_name 	= 'Explore all mugs';
          $category_1_url 	= 'https://sasabudi.com/catalog/mugs/?orderby=popularity&filter_model=coffee-mug';
          
          // Explore all mugs
          echo '<article class="category-article">';
            echo '<figure class="category-figure">';
              echo '<a href="' . $category_1_url . '">';
                echo '<div class="category-figure__title">';
                  echo '<h2>' . $category_1_title . '</h2>';
                  echo '<span class="category-figure__button">' . $category_1_name . '</span>';
                echo '</div>';
                echo '<div class="category-figure__white"></div>';
                echo '<div class="category-figure__image lazy-bg" style="background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)" width="100%" heigth="100%" alt="' . $image_1_alt  . '" title="' . $image_1_title . '" data-src="' . $image_1_url .  '"></div>';
              echo '</a>';
            echo '</figure>';
          echo '</article>';

          // Settings
          $image_2_url 	    = 'https://sasabudi.com/wp-content/uploads/2021/04/Sasabudi-Home-Sweet-Home.jpg';
          $image_2_alt      = 'Home Sweet Home';
          $image_2_title    = 'Home Sweet Home';
          $category_2_title = 'Home Sweet Home';
          $category_2_name 	= 'Shop new arrivals';
          $category_2_url 	= 'https://sasabudi.com/catalog/new-arrivals/?orderby=date';
          
          // Shop new arrivals
          echo '<article class="category-article">';
            echo '<figure class="category-figure">';
              echo '<a href="' . $category_2_url . '">';
                echo '<div class="category-figure__title">';
                  echo '<h2>' . $category_2_title . '</h2>';
                  echo '<span class="category-figure__button">' . $category_2_name . '</span>';
                echo '</div>';
                echo '<div class="category-figure__white"></div>';
                echo '<div class="category-figure__image lazy-bg" style="background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)" width="100%" heigth="100%" alt="' . $image_2_alt  . '" title="' . $image_2_title . '" data-src="' . $image_2_url .  '"></div>';
              echo '</a>';
            echo '</figure>';
          echo '</article>';

          // Settings
          $image_3_url 	    = 'https://sasabudi.com/wp-content/uploads/2021/04/Sasabudi-On-Our-Radar.jpg';
          $image_3_alt      = 'On Our Radar';
          $image_3_title    = 'On Our Radar';
          $category_3_title = 'On Our Radar';
          $category_3_name 	= 'What we\'re loving';
          $category_3_url 	= 'https://sasabudi.com/catalog/exclusive/?orderby=date';

          // What we're loving
          echo '<article class="category-article">';
            echo '<figure class="category-figure">';
              echo '<a href="' . $category_3_url . '">';
                echo '<div class="category-figure__title">';
                  echo '<h2>' . $category_3_title . '</h2>';
                  echo '<span class="category-figure__button">' . $category_3_name . '</span>';
                echo '</div>';
                echo '<div class="category-figure__white"></div>';
                echo '<div class="category-figure__image lazy-bg" style="background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)" width="100%" heigth="100%" alt="' . $image_3_alt  . '" title="' . $image_3_title . '" data-src="' . $image_3_url .  '"></div>';
              echo '</a>';
            echo '</figure>';
          echo '</article>';

        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}


if ( ! function_exists( 'sasabudi_home_products_collection' ) ) {

  /**
   * Shows the homepage product 'collection' section.
   */
  function sasabudi_home_products_collection() {

    // Settings
    $featured_amount 	= 1;
    $featured_paged 	= 1;

    // Arguments
    $args = array(
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
      'posts_per_page' => $featured_amount,
      'paged' => $featured_paged
    );

    // New instance of WP_Query
    $home_collections_query = new WP_Query( $args );
    
    // If WP_Query return results
    if ($home_collections_query->have_posts()) :

      echo '<div class="collection is-home">';

        while($home_collections_query->have_posts()) : $home_collections_query->the_post();
          
          // Featured Info
          $featured_theme   = get_field('ws_collection_off');
          $featured_title   = get_field('ws_collection_title');
          $featured_desc    = get_field('ws_collection_short_desc');

          // Featured Image
          $image_object     = get_field('ws_collection_excerpt'); 
          $image_size       = 'large';
          $image_id 	      = $image_object['ID']; 
          $image_alt        = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          $image_url        = $image_object['sizes'][$image_size];
          $image_title      = get_the_title($image_id);

          echo '<article class="collection-article is-extended">';

            echo '<div class="collection-featured right">';
              echo '<figure class="collection-featured__figure">';
                echo '<div class="collection-featured__figure--image lazy-bg" style="background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)" width="100%" heigth="100%"  alt="' . $image_alt  . '" title="' . $image_title . '" data-src="' . $image_url .  '"></div>';
                echo '<a class="collection-featured__figure--link" href="' . esc_url( get_permalink() ) . '"></a>';
              echo '</figure>';
            echo '</div>';

            echo '<div class="collection-featured left">';
              echo '<div class="collection-featured__desc">';
                
                echo '<h4>' . $featured_theme . ' - </h4>';
                echo '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $featured_title . '</a></h2>';
                echo '<p>' . $featured_desc . '</p>';
                
                echo '<div class="collection-featured__desc--action">';
                  echo '<a href="' . esc_url( get_permalink() ) . '" class="button btn-short">' . esc_html__('Shop Now', 'sasabudi') . '</a>';
                  echo '<a href="' . esc_url( get_post_type_archive_link('collections') ) . '" class="button btn-light">' . esc_html__('Collections', 'sasabudi') . '</a>';
                echo '</div>';

              echo '</div>';
            echo '</div>';

          echo '</article>';

        endwhile;
          
      echo '</div>';

    endif; 

    wp_reset_postdata();
  }
}

if ( ! function_exists( 'sasabudi_home_products_trending' ) ) {

  /**
   * Shows the homepage product 'trending' section.
   */
  function sasabudi_home_products_trending() {

    // Settings
    $option = get_field('shop_featured_products', 'option');
    $amount = $option > 0 ? $option : 4;

    // Arguments
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => $amount,
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'desc',
      'meta_query' => array( // check if featured meta box checkbox is active
        array(
          'key' => 'trending_checkbox',
          'value' => 'on',
        )
      ),
      'tax_query' => array( // check if featured state is active
        array(
          'taxonomy' => 'product_visibility',
          'field'    => 'name',
          'terms'    => 'featured',
          'operator' => 'IN'
        ),
      ),
    );

    // Build trending section
    echo '<div class="trending">';
      echo '<div class="is-extended">';

        echo '<h2 class="trending-title">' . esc_html__( 'What We\'re Loving', 'sasabudi' ) . '</h2>';

        echo '<p class="trending-subtitle">'. esc_html__( 'Takes these trending mugs home with you. 100% Satisfaction Guaranteed.', 'sasabudi' ) . '</p>';

        echo '<div class="trending-products">';
          echo '<ul class="products">';

            // New instance of WP_Query
            $trending_loop = new WP_Query( $args );

            if ( $trending_loop->have_posts() ) {
              while ( $trending_loop->have_posts() ) : $trending_loop->the_post();
                wc_get_template_part( 'content', 'product' );
              endwhile;
            } else {
              echo '<li>';
                echo '<div class="products-empty">';
                  echo '<p>' . esc_html__( 'Hmm, no products were found...', 'sasabudi' ) . '</p>';
                echo '</div>';
              echo '</li>';
            }
            
          echo '</ul>';
        echo '</div>';

        echo '<div class="trending-all">';
          printf( esc_html__( '%1$s', 'sasabudi' ), '<a class="button btn-short" href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . 'mugs/">Shop all</a>');
        echo '</div>';

      echo '</div>';
    echo '</div>';

    wp_reset_postdata();
  }
}

if ( ! function_exists( 'sasabudi_home_artist_blog' ) ) {

  /**
   * Shows the homepage 'blog' section.
   */
  function sasabudi_home_artist_blog() {

    $amount = 3;
    $counter = 0;

    $args = array(
	    'post_type'       => 'post',
      'posts_per_page'  => $amount,
      'post_status'     => 'publish',
      'orderby'         => 'date',
      'order'           => 'desc'
    );
    
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
	 
      echo '<div class="artist-blog">';
        echo '<div class="artist-blog__wrapper">';
        
          while ( $the_query->have_posts() ) :

            $the_query->the_post();

            $counter ++;

            $leftmargin       = $counter % 3 == 1 ? ' is-start' : '';
            $middlemargin     = $counter % 3 == 2 ? ' is-middle' : '';
            $rightmargin      = $counter % 3 == 0 ? ' is-end' : '';
            
            // Get the image object returned by ACF
            $image_object = get_field('wp_excerpt_image'); 
            $image_size = 'medium';
            $image_url = $image_object['sizes'][$image_size];

            echo '<article class="artist-blog__post' . $leftmargin . '' . $middlemargin . '' . $rightmargin . '">';
              
              // Thumbnail
              echo '<a href="' . get_permalink() . '" class="article-thumbnail">';
                echo '<div class="article-thumbnail__white"></div>';
                echo '<div class="article-thumbnail__image lazy-bg" style="background-image:url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)" width="100%" heigth="100%" data-src="' . $image_url . '"></div>';
              echo '</a>';

              // Category
              the_category();

              // Title
              the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
              
              // Excerpt
              echo '<p>' . wp_trim_words(get_the_excerpt(), 15) . ' </p>';
                
              // More
              echo '<p><a class="read_more primary-link" href="' . get_permalink() . '">' . esc_html__('Read More', 'roberteberhard') . '</a> <span class="post-date">' . get_the_time('m/j/y') . '</span></p>';
         
            echo '</article>';

          endwhile;

        echo '</div>';

        echo '<div class="artist-blog__action">';
          echo '<a class="button btn-short" href="' . esc_url(home_url('/blog')) . '">' . esc_html__('Read All', 'roberteberhard') . '</a>';
        echo '</div>';

      echo '</div>';
  
      wp_reset_postdata();
    }
  }
}

if ( ! function_exists( 'sasabudi_home_instagram_feed' ) ) {

  /**
   * Shows the homepage 'instagram' section.
   */
  function sasabudi_home_instagram_feed() {

    // $offset = ( $page - 1 ) * $amount;
    $args_a = array( 
      'post_type' => array('instagram'),
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 4,
      'paged' =>  1,
      'offset' => 0
    );
    $args_b = array( 
      'post_type' => array('instagram'),
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 1,
      'paged' =>  5,
      'offset' => 4
    );
    $args_c = array( 
      'post_type' => array('instagram'),
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 4,
      'paged' =>  2,
      'offset' => 5
    );
    $args_d = array( 
      'post_type' => array('instagram'),
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 5,
      'paged' =>  1
    );
    // New instance of WP_Query
    $instagram_query_a = new WP_Query( $args_a );
    $instagram_query_b = new WP_Query( $args_b );
    $instagram_query_c = new WP_Query( $args_c );
    $instagram_query_d = new WP_Query( $args_d ); 

    echo '<div class="instagram is-home">';
      echo '<div class="is-extended">';

        echo '<h2 class="instagram-title">';
          echo esc_html__( '#SASABUDI', 'sasabudi' );
        echo '</h2>';

        echo '<p class="instagram-desc">';
          printf( esc_html__( 'Tag %2$s on Instagram for a chance to be featured in our gallery %1$s', 'sasabudi' ), '<a href="https://www.instagram.com/sasabudi/" class="primary-link">@sasabudi</a>', '<span class="darken">#sasabudi</span>');
        echo '</p>';

        /**
         * Device Version
         */
        echo '<article class="instagram-device">';

          if ($instagram_query_d->have_posts()) :

            $counter_d = 1;

            while($instagram_query_d->have_posts()) : $instagram_query_d->the_post();

              $image_id_d   = get_post_thumbnail_id(get_the_ID());
              $image_alt_d  = get_post_meta($image_id_d, '_wp_attachment_image_alt', true);

              // Show medium and large image size
              if($counter_d == 1) { 
                $image_url_d = esc_url((wp_get_attachment_image_src($image_id_d, 'large')[0]));
              } else {
                $image_url_d = esc_url((wp_get_attachment_image_src($image_id_d, 'medium')[0]));
              }

              echo '<figure class="showcase ig-' . $counter_d  . '">';
                echo '<a class="showcase-link" href="' . get_post_type_archive_link('instagram') . '">';
                  echo '<div class="showcase-link__white"></div>';
                  echo '<div class="showcase-link__image"><img class="lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" alt="' . $image_alt_d . '" data-src="' . $image_url_d .  '"></div>';
                echo '</a>';
              echo '</figure>';

              $counter_d++;

            endwhile;

          endif;

        echo '</article>';
        
        /**
         * Desktop Version
         */
        echo '<article class="instagram-desktop">';

          if ($instagram_query_a->have_posts()) :

            echo '<div class="instagram-desktop__one">';

              $counter_a = 1;

              while($instagram_query_a->have_posts()) : $instagram_query_a->the_post();

                // Show medium image size
                $image_id_a   = get_post_thumbnail_id(get_the_ID());
                $image_alt_a  = get_post_meta($image_id_a , '_wp_attachment_image_alt', true);
                $image_url_a  = esc_url((wp_get_attachment_image_src($image_id_a, 'medium')[0]));
                echo '<figure class="showcase ig-' . $counter_a . '">';
                  echo '<a class="showcase-link" href="' . get_post_type_archive_link('instagram') . '">';
                    echo '<div class="showcase-link__white"></div>';
                    echo '<div class="showcase-link__image"><img class="lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" alt="' . $image_alt_a . '" data-src="' . $image_url_a .  '"></div>';
                  echo '</a>';
                echo '</figure>';

                $counter_a++;

              endwhile;

            echo '</div>';

          endif;

          if ($instagram_query_b->have_posts()) :

            echo '<div class="instagram-desktop__two">';

              while($instagram_query_b->have_posts()) : $instagram_query_b->the_post();

                // Show medium image size
                $image_id_b   = get_post_thumbnail_id(get_the_ID());
                $image_alt_b  = get_post_meta($image_id_b, '_wp_attachment_image_alt', true);
                $image_url_b  = esc_url((wp_get_attachment_image_src($image_id_b, 'medium')[0]));

                echo '<figure class="showcase">';
                  echo '<a class="showcase-link" href="' . get_post_type_archive_link('instagram') . '">';
                    echo '<div class="showcase-link__white"></div>';
                    echo '<div class="showcase-link__image"><img class="lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" alt="' . $image_alt_b . '" data-src="' . $image_url_b .  '"></div>';
                  echo '</a>';
                echo '</figure>';
              endwhile;

            echo '</div>';

          endif;

          if ($instagram_query_c->have_posts()) :

            echo '<div class="instagram-desktop__three">';

              $counter_c = 1;

              while($instagram_query_c->have_posts()) : $instagram_query_c->the_post();

                // Show medium image size
                $image_id_c   = get_post_thumbnail_id(get_the_ID());
                $image_alt_c  = get_post_meta($image_id_c, '_wp_attachment_image_alt', true);
                $image_url_c  = esc_url((wp_get_attachment_image_src($image_id_c, 'medium')[0]));

                echo '<figure class="showcase ig-' . $counter_c . '">';
                  echo '<a class="showcase-link" href="' . get_post_type_archive_link('instagram') . '">';
                    echo '<div class="showcase-link__white"></div>';
                    echo '<div class="showcase-link__image"><img class="lazy-img" src="https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png" width="100%" heigth="100%" alt="' . $image_alt_c . '" data-src="' . $image_url_c .  '"></div>';
                  echo '</a>';
                echo '</figure>';

                $counter_c++;

              endwhile;

            echo '</div>';

          endif;

        echo '</article>';

        echo '<div class="instagram-all">';
          echo '<a href="' . get_post_type_archive_link('instagram') . '" class="button btn-light btn-short">' . esc_html__('Shop Insta', 'sasabudi') . '</a>';
        echo '</div>';

      echo '</div>';
    echo '</div>';

    wp_reset_postdata();

  }
}