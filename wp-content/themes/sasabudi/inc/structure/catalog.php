<?php
/**
 * The template functions used for displaying the 'shop' definitions.
 * 
 * - sasabudi_products_catalog_featuring
 * - sasabudi_products_catalog_featuring_ajax
 * - sasabudi_products_catalog_best_sellers
 * - sasabudi_products_catalog_best_sellers_ajax
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_products_catalog_featuring' ) ) {
  /**
   * Simply lists the 'featuring' products items.
   */
  function sasabudi_products_catalog_featuring() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) {
      
      // settings
      $paged = 1;
      $amount = 8;

      // New instance of WP_Query
			$featuring = new WP_Query(array(
				'paged' => $paged,
				'posts_per_page' => $amount,
				'post_type' => 'product',
				'post_status' => 'publish',
				'meta_key' => 'total_sales',
        'orderby' => 'date',
        'order' => 'desc',
        'meta_query' => array(
          array(
            'key' => 'trending_checkbox',
            'value' => 'on',
          )
        ),
        'tax_query' => array(
          array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN'
          ),
        ),
      ));

      // Build bestsellers product list
      if ($featuring->have_posts()) {

        // Arguments
        $data_start = $paged;
        $data_end = $featuring->max_num_pages; // paging for ajax

        echo '<div class="featuring">';
          echo '<div class="is-extended">';
          
            echo '<h2 class="featuring-title">' . esc_html__('Designed Just For You!', 'sasabudi') . '</h2>';
            
            echo '<div class="featuring-products">';
              echo '<ul class="products product-featuring">';
                while($featuring->have_posts()) : $featuring->the_post();
                  wc_get_template_part( 'content', 'product' );
                endwhile;
              echo '</ul>';
            echo '</div>';

            if ($data_end > 1) {
              echo '<div class="featuring-next" data-start="' . $data_start . '" data-end="' . $data_end . '">';
                echo '<div class="featuring-next__button">' . esc_html__('Load More', 'sasabudi') . '</div>';
                echo '<span class="icon-waiting"></span>';
              echo '</div>';
            }
          
          echo '</div>';
        echo '</div>';
      }

    wp_reset_postdata();

    }
  }
}

if ( ! function_exists( 'sasabudi_products_catalog_featuring_ajax' ) ) {
  /**
   * Simply lists (by ajax) the 'featuring' products items.
   */
  function sasabudi_products_catalog_featuring_ajax() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) {

      // wp_query data from ajax
			$js_data = $_POST;
      $js_page = (int)($js_data['paged']);

      // wp_query attributes
      $amount = 8;
      $paged = ($js_page >= 1 ) ? $js_page : 1;

      $featuring = new WP_Query(array(
        'paged' => $paged,
				'posts_per_page' => $amount,
				'post_type' => 'product',
				'post_status' => 'publish',
				'meta_key' => 'total_sales',
        'orderby' => 'date',
        'order' => 'desc',
        'meta_query' => array(
          array(
            'key' => 'trending_checkbox',
            'value' => 'on',
          )
        )
        /* 'tax_query' => array(
          array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN'
          ),
        ) */
      ));

			if ($featuring->have_posts()) {
				while($featuring->have_posts()) : $featuring->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
      }
      
      wp_die();
			wp_reset_postdata();
    }
  }
}



if ( ! function_exists( 'sasabudi_products_catalog_best_sellers' ) ) {

  /**
   * Simply lists the 'best sellers' products items.
   */
  function sasabudi_products_catalog_best_sellers() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) {

      // Settings
      $paged = 1;
			$num_best_sellers = get_field('shop_best_sellers', 'option');
      $amount = $num_best_sellers > 1 ? $num_best_sellers : 4;
      
      // New instance of WP_Query
			$bestSellers = new WP_Query(array(
				'paged' => $paged,
				'posts_per_page' => $amount,
				'post_type' => 'product',
				'post_status' => 'publish',
				'meta_key' => 'total_sales',
				'orderby' => 'meta_value_num',
				'order' => 'desc'
			));

      // Build bestsellers product list
			if ($bestSellers->have_posts()) {

        // Arguments
				$data_start = $paged;
				$data_end = $bestSellers->max_num_pages; // paging for ajax

        echo '<div class="bestseller">';
          echo '<div class="is-extended">';
            echo '<h2 class="bestseller-title">' . esc_html__('Discover Our Best Sellers', 'sasabudi') . '</h2>';
            
            echo '<div class="bestseller-products">';
              echo '<ul class="products product-bestseller">';
                while($bestSellers->have_posts()) : $bestSellers->the_post();
                  wc_get_template_part( 'content', 'product' );
                endwhile;
              echo '</ul>';
            echo '</div>';

            if ($data_end > 1) {
              echo '<div class="bestseller-next" data-start="' . $data_start . '" data-end="' . $data_end . '">';
                echo '<div class="bestseller-next__button">' . esc_html__('Load More', 'sasabudi') . '</div>';
                echo '<span class="icon-waiting"></span>';
              echo '</div>';
            }
          
          echo '</div>';
				echo '</div>';
			}

			wp_reset_postdata();
		}
  }
}

if ( ! function_exists( 'sasabudi_products_catalog_best_sellers_ajax' ) ) {
  /**
   * Simply lists (by ajax) the 'best sellers' products item.
   */
  function sasabudi_products_catalog_best_sellers_ajax() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) {

      // wp_query data from ajax
			$js_data = $_POST;
      $js_page = (int)($js_data['paged']);

      // wp_query attributes
      $bestsellers = get_field('shop_best_sellers', 'option');
      $amount = $bestsellers > 1 ? $bestsellers : 4;
			$paged = ($js_page >= 1 ) ? $js_page : 1;
			
			$bestSellers = new WP_Query(array(
				'paged' => $paged,
				'posts_per_page' => $amount,
				'post_type' => 'product',
				'post_status' => 'publish',
				'meta_key' => 'total_sales',
				'orderby' => 'meta_value_num',
				'order' => 'desc'
      ));

			if ($bestSellers->have_posts()) {
				while($bestSellers->have_posts()) : $bestSellers->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
      }
      
      wp_die();
			wp_reset_postdata();		
    }
  }
}
