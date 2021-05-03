<?php
/**
 * The template functions used for displaying the 'instagram' definitions.
 *
 * - sasabudi_page_instagram_archive
 * - sasabudi_page_instagram_archive_ajax
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_page_instagram_archive' ) ) {

  /**
   * Simply display the instagram archive page.
   */
  function sasabudi_page_instagram_archive() {

    // Settings
    $instagrams = get_field('shop_archive_instagrams', 'option');
    $amount = $instagrams > 1 ? $instagrams : 4;
    $paged = 1;
    $counter = 0;
    $args = array(
      'post_type' => array('instagram'),
      'post_status' => 'publish',
      'order' => 'DESC',
      'orderby' => 'date',
      'posts_per_page' => $amount,
      'paged' => $paged
    );
    
    // New instance of WP_Query
    $instagram_query = new WP_Query( $args );
    
    // If WP_Query return results
    if ($instagram_query->have_posts()) :

      // Arguments
      $data_start = $paged;
      $data_end = $instagram_query->max_num_pages; // paging for ajax

      echo '<div class="instagram">';
      
        echo '<div class="is-extended">';

          // Build Posts Header
          echo '<h1 class="instagram-title">' . __('Instashop', 'sasabudi') . '</h1>';
          echo '<p class="instagram-heading">';
            printf( __( 'Shopping made easy! Discover our coffee and tea mugs from our Instagram community and shop them instantly<br/>%1$s', 'sasabudi' ), '<a href="https://www.instagram.com/sasabudi/" class="primary-link" target="_blank">@sasabudi</a>');
          echo '</p>';

          // Build Posts Feed
          echo '<div class="instagram-posts" id="ig-posts">';
            while($instagram_query->have_posts()) : $instagram_query->the_post();
              $insta_url = get_field('instagram_target_url');
              $image_id  = get_post_thumbnail_id(get_the_ID());
              $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
              $image_url = esc_url((wp_get_attachment_image_src($image_id, 'medium')[0]));
              echo '<figure class="instagram-figure">';
                echo '<a class="instagram-figure__link" href="' . $insta_url . '">';
                  echo '<div class="instagram-figure__link--white"></div>';
                  echo '<div class="instagram-figure__link--image"><img class="lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="' . $image_alt . '" data-src="' . $image_url .  '"></div>';
                echo '</a>';
              echo '</figure>';
            endwhile;
          echo '</div>';

          // Build spin icon in combination with ajax load more
          echo '<div id="ig-next" data-start="' . $data_start . '" data-end="' . $data_end . '">';
            echo '<span class="icon-spinning">';
              echo '<img src="' . get_theme_file_uri("/images/sasabudi-spin.svg") . '" width="32px" height="32px" />';
            echo '</span>';
          echo '</div>';
        echo '</div>';

      echo '</div>';

    else:

      /**
       * @hooked :: woocommerce_no_products_found - 10
       */
      do_action( 'woocommerce_no_products_found' );

    endif;

    wp_reset_postdata();

  }
}

if ( ! function_exists( 'sasabudi_page_instagram_archive_ajax' ) ) {

  /**
   * Simply display the instagram archive section executed by ajax.
   */
  function sasabudi_page_instagram_archive_ajax() {

    // wp_query data from ajax
    $js_data = $_POST;
    $js_page = (int)($js_data['paged']);
    
    // wp_query attributes
    $instagrams = get_field('shop_archive_instagrams', 'option');
    $amount = $instagrams > 1 ? $instagrams : 4;
    $paged = ($js_page >= 1 ) ? $js_page : 1;
    $counter = $amount * ($paged-1);

    // wp_query arguments
    $insta_ajax_query = new WP_Query(array(
      'paged' => $paged,
      'posts_per_page' => $amount,
      'post_type' => array('instagram'),
      'post_status' => 'publish',
      'order' => 'desc',
      'orderby' => 'date'
    ));

    // If WP_Query return results
    if ($insta_ajax_query->have_posts()) :
      while($insta_ajax_query->have_posts()) : $insta_ajax_query->the_post();
        
        $insta_url = get_field('instagram_target_url');
        $image_id  =  get_post_thumbnail_id(get_the_ID());
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        $image_url = esc_url((wp_get_attachment_image_src($image_id, 'medium')[0]));
        
        echo '<figure class="instagram-figure">';
          echo '<a class="instagram-figure__link" href="' . $insta_url . '">';
            echo '<div class="instagram-figure__link--white"></div>';
            echo '<div class="instagram-figure__link--image"><img class="lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="' . $image_alt . '" data-src="' . $image_url .  '"></div>';
          echo '</a>';
        echo '</figure>';

      endwhile;
    endif;

    wp_reset_postdata();

    die();			
  }
}
