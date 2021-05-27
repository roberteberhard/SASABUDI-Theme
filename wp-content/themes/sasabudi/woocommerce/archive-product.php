<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

  /**
   * Hook :: woocommerce_before_main_content.
   *
   * @hooked woocommerce_output_content_wrapper - 10
   * @hooked woocommerce_breadcrumb - 20 [hint :: removed]
   * @hooked WC_Structured_Data::generate_website_data() - 30
   */
  do_action( 'woocommerce_before_main_content' );

    echo '<div class="catalog">';
    
      /**
       * Show the product archive header
       */
      echo '<div class="catalog-header">';
        
        echo '<div class="catalog-header__filter">';
          /**
           * Hook :: sasabudi_archive_filter.
           *
           * @hooked sasabudi_catalog_header_filter - 10
           */
           do_action( 'sasabudi_archive_filter' );
        echo '</div>';

        echo '<div class="is-wrapper">';
        
          echo '<nav class="catalog-header__nav">';
            /**
             * Hook :: sasabudi_archive_breadcrumb.
             *
             * @hooked sasabudi_catalog_result_breadcrumb - 10
             */
            do_action( 'sasabudi_archive_breadcrumb' );
          echo '</nav>';

          $topic = is_product_tag() ? ' is-topic' : ''; // ternary for product tag class
          echo '<aside class="catalog-header__desc' . $topic . '">';
            /**
             * Hook :: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10 [hint :: removed]
             * @hooked woocommerce_product_archive_description - 10
             * @hooked sasabudi_catalog_archive_description - 10
             * @hooked sasabudi_catalog_archive_tags - 20
             */
            do_action( 'woocommerce_archive_description' );
          echo '</aside>';

        echo '</div>';

      echo '</div>';

      /**
       * Show the product archive feed
       */
      echo '<div class="catalog-archive">';
        
        if ( woocommerce_product_loop() ) {
          /**
           * Hook :: woocommerce_before_shop_loop.
           *
           * @hooked woocommerce_output_all_notices - 10
           * @hooked woocommerce_result_count - 20 [hint :: removed]
           * @hooked woocommerce_catalog_ordering - 30 [hint :: removed]
           * @hooked sasabudi_catalog_result_filter - 20
           */
          do_action( 'woocommerce_before_shop_loop' );

            echo '<div class="is-extended">';
              echo '<div class="catalog-archive__products">';

                // Loop Start
                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {

                  while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );
              
                    // Include product template
                    wc_get_template_part( 'content', 'product' );

                  }
                }

                // Loop End
                woocommerce_product_loop_end();

              echo '</div>';
            echo '</div>';
          
          /**
           * Hook :: woocommerce_after_shop_loop.
           *
           * @hooked woocommerce_pagination - 10
           */
          do_action( 'woocommerce_after_shop_loop' );

        } else {

          /**
           * Hook :: woocommerce_no_products_found.
           *
           * @hooked wc_no_products_found - 10
           */
          do_action( 'woocommerce_no_products_found' );
        }
       
      echo '</div>';

    echo '</div>';

  /**
   * Hook :: woocommerce_after_main_content.
   *
   * @hooked woocommerce_output_content_wrapper_end - 10
   */
  do_action( 'woocommerce_after_main_content' );



  if( is_shop() || is_product_category() ) {

    /**
     * DataLayer - Category Event
     */
    $title = is_product_category() ? single_cat_title('', false) : 'All';

    ?>

    <script>
     dataLayer.push({
      'viewcategory' : 'Category',
      'ecommerce': {
        'product_category' : '<?php echo $title ?>'
      }
     });
    </script>

   <?php
  }

get_footer();
