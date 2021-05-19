<?php
/**
 * The template for displaying the 'sitemap' page.
 *
 * Template name: Page-Sitemap
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main is-sitemap" role="main">';

    echo '<div class="sitemap is-sitemap">';
      echo '<div class="is-wrapper">'; 

        // Breadcrump
/*         echo '<nav class="catalog-header__nav">';
          echo '<ul class="catalog-header__nav--list">';
            echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
            echo '<li><span class="spacer">/</span><a href="' . esc_url(home_url('/sitemap/')) . '">sitemap</a></li>';
          echo '</ul>';
        echo '</nav>'; */

        echo '<div class="sitemap-content">';
          
          echo '<h1 class="sitemap-content__title">SASABUDI Sitemap</h1>';

          echo '<div class="sitemap-row">';

            echo '<div class="sitemap-col">';
              echo '<h3>Company</h3>';
              echo '<ul class="sitemap-list">';
                echo '<li><a href="' . esc_url(home_url('/help/contact/')) . '">' . esc_html('Contact', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/about/')) . '">' . esc_html('Our Story', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/my-account/')) . '">' . esc_html('My Account', 'sasabudi') . '</a></li>';
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Catalog</h3>';
              echo '<ul class="sitemap-list">';
                echo '<li><a href="' . esc_url(home_url('/catalog/')) . '">' . esc_html('Catalog', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?orderby=date')) . '">' . esc_html('New Arrivals', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/exclusive/?orderby=date')) . '">' . esc_html('On Our Radar', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?orderby=popularity')) . '">' . esc_html('Bestsellers', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/collections/')) . '">' . esc_html('Collections', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/instashop/')) . '">' . esc_html('Instashop', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_model=coffee-mug')) . '">' . esc_html('Coffee Mug', 'sasabudi') . '</a></li>';
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Collections</h3>';
              echo '<ul class="sitemap-list">';
                echo '<li><a href="' . esc_url(home_url('/collections/explore-urban-art/')) . '">' . esc_html('Explore Urban Art', 'sasabudi') . '</a></li>';
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Help</h3>';
              echo '<ul class="sitemap-list">';
                echo '<li><a href="' . esc_url(home_url('/help/faqs/')) . '">' . esc_html('FAQs', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/ordering/')) . '">' . esc_html('Ordering', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/shipping/')) . '">' . esc_html('Shipping', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/returns/')) . '">' . esc_html('Returns', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/payment/')) . '">' . esc_html('Payment', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/promotions/')) . '">' . esc_html('Promotions', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/size-guide/')) . '">' . esc_html('Size Guide', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/account/')) . '">' . esc_html('Customer Accout', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/help/hashtag/')) . '">' . esc_html('#SASABUDI', 'sasabudi') . '</a></li>';
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Policies</h3>';
              echo '<ul class="sitemap-list">';
                echo '<li><a href="' . esc_url(home_url('/policies/terms-of-service/')) . '">' . esc_html('Terms of Service', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/policies/privacy-policy/')) . '">' . esc_html('Privacy Policy', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/policies/cookie-policy/')) . '">' . esc_html('Cookie Policy', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/policies/legal-notice/')) . '">' . esc_html('Legal Notice', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/policies/disclaimer/')) . '">' . esc_html('Disclaimer', 'sasabudi') . '</a></li>';
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Shop by Theme</h3>';
              echo '<ul class="sitemap-list">';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=black-white')) . '">' . esc_html('Black & White', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=geometric')) . '">' . esc_html('Geometric', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=illustration')) . '">' . esc_html('Illustration', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=kids')) . '">' . esc_html('Kids', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=love')) . '">' . esc_html('Love ', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=motivational')) . '">' . esc_html('Motivational ', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=popart')) . '">' . esc_html('Pop Art', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=quote')) . '">' . esc_html('Quote', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=typography')) . '">' . esc_html('Typography', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_theme=urbanart')) . '">' . esc_html('Urban Art', 'sasabudi') . '</a></li>';
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Shop by Color</h3>';
              echo '<ul class="sitemap-list">';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=beige')) . '">' . esc_html('Beige', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=black')) . '">' . esc_html('Black', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=blue')) . '">' . esc_html('Blue', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=brown')) . '">' . esc_html('Brown', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=colorized')) . '">' . esc_html('Colorized', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=golden')) . '">' . esc_html('Golden', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=gray')) . '">' . esc_html('Gray', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=green')) . '">' . esc_html('Green', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=orange')) . '">' . esc_html('Orange', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=pink')) . '">' . esc_html('Pink', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=red')) . '">' . esc_html('Red', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=white')) . '">' . esc_html('White', 'sasabudi') . '</a></li>';
                echo '<li><a href="' . esc_url(home_url('/catalog/?filter_color=yellow')) . '">' . esc_html('Yellow', 'sasabudi') . '</a></li>';
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Instashop</h3>';
              echo '<ul class="sitemap-list">';
                $instagram_args = array(
                  'post_type' => array('instagram'),
                  'post_status' => 'publish',
                  'order' => 'DESC',
                  'orderby' => 'date',
                  'posts_per_page' => 10,
                  'paged' => 1
                );
                $instagram_query = new WP_Query( $instagram_args );
                if ($instagram_query->have_posts()) :
                  while($instagram_query->have_posts()) : $instagram_query->the_post();
                    $insta_url = get_field('instagram_target_url');
                    $insta_name = get_the_title();
                    echo '<li><a href="' . $insta_url . '">' . $insta_name . '</a></li>';
                  endwhile;
                endif;
                wp_reset_postdata();
                
              echo '</ul>';
            echo '</div>';

            echo '<div class="sitemap-col">';
              echo '<h3>Coffee Mugs</h3>';
              echo '<ul class="sitemap-list">';
                $coffeemug_args = array(
                  'post_type' => array('product'),
                  'post_status' => 'publish',
                  'order' => 'DESC',
                  'orderby' => 'date',
                  'posts_per_page' => 10,
                  'paged' => 1
                );
                $coffeemug_query = new WP_Query( $coffeemug_args );
                if ($coffeemug_query->have_posts()) :
                  while($coffeemug_query->have_posts()) : $coffeemug_query->the_post();
                    $product_url = get_the_permalink();
                    $product_name = get_the_title();
                    echo '<li><a href="' . $product_url . '">' . $product_name . '</a></li>';
                  endwhile;
                endif;
                wp_reset_postdata();
              echo '</ul>';
            echo '</div>';

          echo '</div>';
        echo '</div>';
        
      echo '</div>';
    echo '</div>'; 
    
    /** 
     * @hooked :: sasabudi_home_products_statement - 10
     */
    do_action( 'sasabudi_render_sitemap_page' );

  echo '</main>';

get_footer();