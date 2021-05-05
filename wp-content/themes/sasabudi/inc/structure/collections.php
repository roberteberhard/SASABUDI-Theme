<?php
/**
 * The template functions used for displaying the 'collection' definitions.
 *
 * - sasabudi_page_collections_archive
 * - sasabudi_page_collections_archive_ajax
 * - sasabudi_page_collection_single
 * - sasabudi_page_collection_single_ajax
 * - sasabudi_page_collection_single_share
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_page_collections_archive' ) ) {

  /**
   * Shows the 'collection' archive page content.
   */
  function sasabudi_page_collections_archive() {

    // Settings
    $products_amount 	= get_field('shop_archive_collections', 'option');
    $featured_style 	= ' extended';
    $featured_size 		= 'medium'; // (thumbnail, medium, large, full or custom size)
    $featured_amount 	= $products_amount > 1 ? $products_amount : 4;
    $paged 				    = 1;
    $counter 			    = 1;

    // Arguments
    $args = array(
      'post_type'     => array('collections'),
      'post_status'   => 'publish',
      'order'         => 'DESC',
      'orderby'       => 'date',
      'posts_per_page' => $featured_amount,
      'paged'         => $paged
    );

    // New instance of WP_Query
    $archive_collections_query = new WP_Query( $args );

    if ($archive_collections_query->have_posts()) :

      // Arguments
      $data_start = $paged;
      $data_end = $archive_collections_query->max_num_pages; // paging for ajax

      // Build Collection Feed
      echo '<div class="collections">';
        echo '<div class="is-extended">';

          echo '<div class="collections-posts" id="collections-archive">';
            while ($archive_collections_query->have_posts()) : $archive_collections_query->the_post();

              // Set Styles
              if($counter == 1) {
                $featured_style   = 'extended';
                $featured_size    = 'large';
              } else if($counter == 2 OR $counter == 3) {
                $featured_style   = 'large';
                $featured_size    = 'medium';
              } else {
                $featured_style   = 'medium';
                $featured_size    = 'medium';
              }

              // Set Title & Description
              $featured_theme     = get_field('ws_collection_off');
              $featured_title     = get_field('ws_collection_title');
              $featured_desc      = get_field('ws_collection_short_desc');
              $featured_img_id    = get_post_thumbnail_id(get_the_ID());
              $featured_img_alt   = get_post_meta($featured_img_id, '_wp_attachment_image_alt', true);
              $featured_img_title = get_the_title($featured_img_id);
              $featured_img_url   = esc_url((wp_get_attachment_image_src($featured_img_id, $featured_size)[0]));

              // Collections Posts
              echo '<article class="collections-post ' . $featured_style . '" data-promo-index="' . $counter . '">';

                // Collection Image
                echo '<figure class="collections-post__figure">';
                  echo '<div class="collections-post__figure--image lazy-bg" style="background-image: url(https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png)" width="100%" heigth="100%" alt="' . $featured_img_alt  . '" title="' . $featured_img_title . '" data-src="' . $featured_img_url .  '"></div>';
                  echo '<a class="collections-post__figure--link" href="' . esc_url( get_permalink() ) . '"></a>';
                echo '</figure>';

                // Collection Description
                echo '<figcaption class="collections-post__desc">';
                  echo '<h4>' . $featured_theme . ' - </h4>';
                  echo '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $featured_title . '</a></h2>';
                  echo '<p>' . $featured_desc . '</p>';
                  echo '<a href="' . esc_url( get_permalink() ) . '" class="button btn-light btn-short">' . esc_html__('Shop Now', 'sasabudi') . '</a>';
                echo '</figcaption>';

              echo '</article>';

              $counter++;

            endwhile;

          echo '</div>';

          // Build spin icon in combination with ajax load more
          echo '<div id="collections-next" data-start="' . $data_start . '" data-end="' . $data_end . '">';
            echo '<span class="icon-spinning">';
              echo '<img src="' . get_theme_file_uri("/images/sasabudi-spin.svg") . '" width="32" height="32" />';
            echo '</span>';
          echo '</div>';

        echo '</div>';
      echo '</div>';

    else :

      /**
       * @hooked :: woocommerce_no_products_found - 10
       */
      do_action( 'woocommerce_no_products_found' );

    endif;

    wp_reset_postdata();
  }
}

if ( ! function_exists( 'sasabudi_page_collections_archive_ajax' ) ) {

  /**
   * Shows the 'collection' archive page content executed by ajax.
   */
  function sasabudi_page_collections_archive_ajax() {

    // wp_query data from ajax
    $js_data = $_POST;
    $js_page = (int)(sanitize_text_field($js_data['paged']));

    // wp_query attributes
    $products_amount 	= get_field('shop_archive_collections', 'option');
    $featured_style 	= 'medium';
    $featured_size 		= 'medium'; // (thumbnail, medium, large, full or custom size)
    $featured_amount 	= $products_amount > 1 ? $products_amount : 4;
    $paged 				    = ($js_page >= 1 ) ? $js_page : 1;
    $counter 			    = ($paged * $featured_amount) -1;

    // wp_query arguments
    $args = array(
      'post_type'     => array('collections'),
      'post_status'   => 'publish',
      'order'         => 'DESC',
      'orderby'       => 'date',
      'posts_per_page' => $featured_amount,
      'paged'         => $paged
    );

    // New instance of WP_Query
    $archive_collections_query = null;
    $archive_collections_query = new WP_Query( $args );

    // If WP_Query return results
    if ($archive_collections_query->have_posts()) :
      while($archive_collections_query->have_posts()) : $archive_collections_query->the_post();

        // Collection Arguments
        $featured_theme     = get_field('ws_collection_off');
        $featured_title     = get_field('ws_collection_title');
        $featured_desc      = get_field('ws_collection_short_desc');
        $featured_img_id    = get_post_thumbnail_id(get_the_ID());
        $featured_img_alt   = get_post_meta($featured_img_id, '_wp_attachment_image_alt', true);
        $featured_img_title = get_the_title($featured_img_id);
        $featured_img_url   = esc_url((wp_get_attachment_image_src($featured_img_id, $featured_size)[0]));

        echo '<article class="collections-post ' . $featured_style . ' " data-promo-index="' . $counter . '">';

          // Collection Image
          echo '<figure class="collections-post__figure">';
            echo '<div class="collections-post__figure--image lazy-bg" style="background-image: url(https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png)" width="100%" heigth="100%" alt="' . $featured_img_alt  . '" title="' . $featured_img_title . '" data-src="' . $featured_img_url .  '"></div>';
            echo '<a class="collections-post__figure--link" href="' . esc_url( get_permalink() ) . '"></a>';
          echo '</figure>';

          // Collection Description
          echo '<figcaption class="collections-post__desc">';
            echo '<h4>' . $featured_theme . ' - </h4>';
            echo '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $featured_title . '</a></h2>';
            echo '<p>' . $featured_desc . '</p>';
            echo '<a href="' . esc_url( get_permalink() ) . '" class="button btn-light btn-short">' . esc_html__('Shop Now', 'sasabudi') . '</a>';
          echo '</figcaption>';

        echo '</article>';

        $counter++;

      endwhile;

    endif;

    wp_reset_postdata();

    die();
  }
}


if ( ! function_exists( 'sasabudi_page_collection_single' ) ) {

  /**
   * Shows the 'collection' single page content.
   */
  function sasabudi_page_collection_single() {

    // Settings
    $args 					        = array();
    $data_id 				        = get_the_ID(); // post id for ajax
    $featured_title	        = get_field('ws_collection_title');
    $featured_img_url       = get_the_post_thumbnail_url( $data_id, 'full' );
    $featured_img_id        = get_post_thumbnail_id($data_id);
    $featured_img_alt       = get_post_meta($featured_img_id, '_wp_attachment_image_alt', true);
    $featured_author 	      = get_field('ws_collection_author');
    $featured_author_url    = get_field('ws_collection_author_url');
    $avatar_data 			      = get_field_object('ws_collection_avatar');
    $avatar_value 		      = $avatar_data['value'];
    $avatar_label 		      = $avatar_data['choices'][ $avatar_value ];
    $featured_desc 		      = get_field('ws_collection_large_desc');
    $featured_url			      = get_permalink();
    $featured_hashtag1      = get_field('ws_collection_hashtag_one');
    $featured_hashtag2      = get_field('ws_collection_hashtag_two');
    $featured_edit          = current_user_can( 'edit_posts' ) ? '<span class="spacer-left"></span>|<span class="spacer-right"></span><a class="primary-link" href="' . get_edit_post_link( $data_id ) .' " target="_blank">Edit</a>' : '';

    // Settings
    $products_amount 		    = get_field('shop_collection_products', 'option');
    $featured_taxonomy	    = get_field('ws_products_by_taxonomy', $data_id);
    $featured_relationship  = get_field('ws_products_by_relationship', $data_id);
    $featured_amount 		    = $products_amount > 1 ? $products_amount : 4;
    $paged 					        = 1;
    $data_start 			      = 0;
    $data_end 				      = 0; // paging for ajax

    // Arguments
    if (isset($featured_relationship) && !$featured_taxonomy) {
      // Query by "Relationship"
      $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => $featured_amount,
        'order' => 'desc',
        'orderby' => 'date',
        'post__in' => $featured_relationship
      );
    } else if (!$featured_relationship && isset($featured_taxonomy)){
      // Query by "Taxonomy"
      $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => $featured_amount,
        'order' => 'desc',
        'orderby' => 'date',
        'tax_query' => array(
          array(
            'taxonomy' => 'product_tag', // tags
            'field'    => 'slug',
            'terms'    => $featured_taxonomy->slug
          )
        )
      );
    } else if (isset($featured_relationship) && isset($featured_taxonomy)) {

      // Don't show any products if "tags" and "products" are selected!
      $args = array();
    }

    // New instance of WP_Query
    $collection_single_query = new WP_Query( $args );

    // If WP_Query return results
    if ($collection_single_query->have_posts()) :

      // Arguments
      $data_start = $paged;
      $data_end   = $collection_single_query->max_num_pages; // paging for ajax

      echo '<div class="collection is-single">';

        // Build Collection Header
        echo '<div class="collection-header">';

          // Banner
          echo '<figure class="collection-header__figure">';
            echo '<div class="collection-header__figure--white"></div>';
            echo '<div class="collection-header__figure--banner" style="background-image: url(' . $featured_img_url . ')" width="100%" heigth="100%" alt="' . $featured_img_alt . '">';
              echo '<div class="collection-header__container">';
                echo '<h4>' . esc_html__('We All Love Mugs - SASABUDI', 'sasabudi') . '</h4>';
              echo '</div>';
            echo '</div>';
          echo '</figure>';

          // Avatar
          echo '<div class="collection-header__avatar">';
            echo '<div class="collection-header__avatar--thumb">';
              echo '<img src="' . get_theme_file_uri('/images/sasabudi-avatar-') . $avatar_value . '.png" alt="'. $avatar_label . '">';
            echo '</div>';
          echo '</div>';

          // Author & Share
          echo '<div class="collection-header__share">';
            // Author
            echo '<p class="collection-header__share--author">';
              if ($featured_author_url) {
                echo 'Created by <a class="primary-link" href="' . $featured_author_url . '" target="_blank">' . $featured_author . '</a><span class="spacer-left"></span>|<span class="spacer-right"></span><a class="primary-link" href="' . get_post_type_archive_link('collections') . '">' . esc_html__('Collections', 'sasabudi') . '</a>' . $featured_edit;
              } else {
                echo 'Created by ' . $featured_author . '<span class="spacer-left"></span>|<span class="spacer-right"></span><a class="primary-link" href="' . get_post_type_archive_link('collections') . '">' . esc_html__('Collections', 'sasabudi') . '</a>' . $featured_edit;
              }
            echo '</p>';
            // Share
            echo '<div class="collection-header__share--link">';
              echo '<ul>';
                ?>
                <li class="is-share">
                  <?php echo esc_html_e('Share: ', 'sasabudi'); ?>
                </li>
                <li>
                  <a class="share-btn facebook" title="Share on Facebook" rel="nofollow noreferrer" target="_blank" href="<?php echo sasabudi_share_link('facebook', $featured_title, $featured_desc, $featured_img_url, $featured_url, $featured_hashtag1, $featured_hashtag2) ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                  </a>
                </li>
                <li>
                  <a class="share-btn twitter" title="Share on Twitter" rel="nofollow noreferrer" target="_blank" href="<?php echo sasabudi_share_link('twitter', $featured_title, $featured_desc, $featured_img_url, $featured_url, $featured_hashtag1 , $featured_hashtag2) ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
                  </a>
                </li>
                <li>
                  <a class="share-btn pinterest" title="Share on Pinterest" rel="nofollow noreferrer" target="_blank" href="<?php echo sasabudi_share_link('pinterest', $featured_title, $featured_desc, $featured_img_url, $featured_url, $featured_hashtag1 , $featured_hashtag2) ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"></path></svg>
                  </a>
                </li>
                <li>
                  <a class="share-btn buffer" title="Share on Buffer" rel="nofollow noreferrer" target="_blank" href="<?php echo sasabudi_share_link('buffer', $featured_title, $featured_desc, $featured_img_url, $featured_url, $featured_hashtag1 , $featured_hashtag2) ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M427.84 380.67l-196.5 97.82a18.6 18.6 0 0 1-14.67 0L20.16 380.67c-4-2-4-5.28 0-7.29L67.22 350a18.65 18.65 0 0 1 14.69 0l134.76 67a18.51 18.51 0 0 0 14.67 0l134.76-67a18.62 18.62 0 0 1 14.68 0l47.06 23.43c4.05 1.96 4.05 5.24 0 7.24zm0-136.53l-47.06-23.43a18.62 18.62 0 0 0-14.68 0l-134.76 67.08a18.68 18.68 0 0 1-14.67 0L81.91 220.71a18.65 18.65 0 0 0-14.69 0l-47.06 23.43c-4 2-4 5.29 0 7.31l196.51 97.8a18.6 18.6 0 0 0 14.67 0l196.5-97.8c4.05-2.02 4.05-5.3 0-7.31zM20.16 130.42l196.5 90.29a20.08 20.08 0 0 0 14.67 0l196.51-90.29c4-1.86 4-4.89 0-6.74L231.33 33.4a19.88 19.88 0 0 0-14.67 0l-196.5 90.28c-4.05 1.85-4.05 4.88 0 6.74z"></path></svg>
                  </a>
                </li>
                <li>
                  <a class="share-btn email" title="Share with Email" rel="nofollow noreferrer" target="_self" href="<?php echo sasabudi_share_link('email', $featured_title, $featured_desc, $featured_img_url, $featured_url, $featured_hashtag1 , $featured_hashtag2) ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentcolor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg>
                  </a>
                </li>
                <?php
              echo '</ul>';
            echo '</div>';
          echo '</div>';

          // Heading
          echo '<div class="collection-header__heading">';
            echo '<div class="collection-header__container">';
              echo '<h1>' . $featured_title. '</h1>';
              if ( $featured_desc ) {
                echo '<p>' . $featured_desc . '</p>';
              }
            echo '</div>';
          echo '</div>';
        echo '</div>';

        // Build Collection Body
        echo '<div class="collection-body">';
          echo '<div class="is-extended">';

            // Products
            echo '<div class="collection-products">';
              echo '<ul class="products" id="collection-single">';
                while ( $collection_single_query->have_posts() ) : $collection_single_query->the_post();
                  wc_get_template_part( 'content', 'product' );
                endwhile;
              echo '</ul>';
            echo '</div>';

            echo '<div id="collection-next" data-start="' . $data_start . '" data-end="' . $data_end . '" data-id="' . $data_id . '">';
              echo '<span class="icon-spinning">';
                echo '<img src="' . get_theme_file_uri("/images/sasabudi-spin.svg") . '" width="32" height="32" />';
              echo '</span>';
            echo '</div>';

          echo '</div>';
        echo '</div>';

      echo '</div>';

    else:

      echo '<div class="collection">';

        /**
         * @hooked :: woocommerce_no_products_found - 10
         */
        do_action( 'woocommerce_no_products_found' );

      echo '</div>';

    endif;

    wp_reset_postdata();

  }
}

if ( ! function_exists( 'sasabudi_page_collection_single_ajax' ) ) {

  /**
   * Shows the 'collection' single page content executed by ajax.
   */
  function sasabudi_page_collection_single_ajax() {

    if ( ! DOING_AJAX ) {
      // die();
    }

    // Query data from ajax
    $js_data      = $_POST;
    $js_security  = $js_data['security'];
    $js_post      = (int)(sanitize_text_field($js_data['post']));
    $js_page      = (int)(sanitize_text_field($js_data['paged']));
    
    // Collection arguments
    $products_amount 		    = get_field('shop_collection_products', 'option');
    $featured_taxonomy 		  = get_field('ws_products_by_taxonomy', $js_post);
    $featured_relationship 	= get_field('ws_products_by_relationship', $js_post);
    $featured_amount 		    = $products_amount > 1 ? $products_amount : 4;
    $paged 					        = ($js_page >= 1 ) ? $js_page : 1;

    if ( isset($featured_relationship) && !$featured_taxonomy ) {
      // Query by "Relationship"
      $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => $featured_amount,
        'order' => 'desc',
        'orderby' => 'date',
        'post__in' => $featured_relationship
      );
    } else if ( !$featured_relationship && isset($featured_taxonomy) ){
      // Query by "Taxonomy"
      $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => $featured_amount,
        'order' => 'desc',
        'orderby' => 'date',
        'tax_query' => array(
          array(
            'taxonomy' => 'product_tag', // tags
            'field'    => 'slug',
            'terms'    => $featured_taxonomy->slug
          )
        )
      );
    }

    // New instance of WP_Query
    $single_collection_ajax_query = null;
    $single_collection_ajax_query = new WP_Query( $args );

    // If Query return results
    if ($single_collection_ajax_query->have_posts()) :
      while($single_collection_ajax_query->have_posts()) : $single_collection_ajax_query->the_post();
        wc_get_template_part( 'content', 'product' );
      endwhile;
    endif;

    wp_reset_postdata();

    die();
  }
}

/**
 * Helper Function
 */
function sasabudi_page_collection_single_share( $social, $posttitle, $postcontent, $media, $featured_hashtag1 , $featured_hashtag2, $featured_url) {
}

function sasabudi_archive_collection_share_link( $social, $posttitle, $postcontent, $media, $featured_hashtag1, $featured_hashtag2, $featured_url ) {

  $url 		        = '';
  $permalink 	    = rawurlencode( $featured_url );
  $twitter_title 	= rawurlencode( '"' . $posttitle . '" collection via @sasabudi ' . $featured_hashtag1 . ' ' . $featured_hashtag2 );
  $pinterest_desc = rawurlencode( '"' . $posttitle . '" - ' . $postcontent );

  switch ( $social ) {
      case 'facebook':
          $url = add_query_arg(
              array(
        'u' => $permalink,
        'title' => rawurlencode( $posttitle ),
        'description' => rawurlencode( $postcontent ),
        'quote' => rawurlencode( $postcontent ),
        'hashtag' => rawurlencode( $featured_hashtag1 )
              ),
              'https://www.facebook.com/sharer/sharer.php'
          );
    break;
      case 'twitter':
          $url = add_query_arg(
              array(
                  'url' => $permalink,
                  'text' => $twitter_title
              ),
              'https://twitter.com/intent/tweet'
          );
    break;
      case 'pinterest':
          $url = add_query_arg(
              array(
                  'url' => $permalink,
                  'media' => rawurlencode( $media ),
                  'description' => $pinterest_desc
              ),
              '//www.pinterest.com/pin/create/button/'
          );
    break;
  case 'tumblr':
          $url = add_query_arg(
              array(
                  'url' => $permalink
              ),
              'https://plus.google.com/share'
          );
          break;
  case 'email':
          $url = add_query_arg(
              array(
        'subject' => $twitter_title,
                  'body' => $permalink . ' ' . $pinterest_desc
              ),
              'mailto:'
          );
    break;
      default:
          break;
  }
  return $url;

  die();
}
