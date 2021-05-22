<?php
/**
 * The template for displaying the 'cart' pages.
 *
 * Template name: Page-Cart
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main is-cart" role="main">';
  
    /**
     * Render the cart / checkout progress
     */
    echo '<div class="cart-progress">';

      echo '<nav class="cart-progress__breadcrumb">';
        echo '<ul>';
          echo '<li><a href="' . esc_url( home_url( '/' ) ) .'">' . esc_html__('Home', 'sasabudi') . '</a></li>';
          echo '<li><span class="spacer">/</span><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '">' . esc_html__('Catalog', 'sasabudi') . '</a></li>';
          echo '<li class="active"><span class="spacer">/</span><a href="' . get_permalink( wc_get_page_id( 'cart' ) ) . '">' . esc_html__('Cart', 'sasabudi') . '</a></li>';
          echo '<li class="next"><span class="spacer">/</span>' . esc_html__('Checkout', 'sasabudi') . '</li>';
          echo '<li class="next"><span class="spacer">/</span>' . esc_html__('Confirmation', 'sasabudi') . '</li>';
        echo '</ul>';
      echo '</nav>';

    echo '</div>';

    echo '<div class="cart-content">';

      /**
       * Render the cart section
       */
      if( is_page( 'cart' ) ):
        while ( have_posts() ) : the_post();
            the_content();
        endwhile; 
      endif;

    echo '</div>';

    /**
     * @hooked :: sasabudi_home_products_statement - 10
     */
    do_action( 'sasabudi_render_cart_page' );

  echo '</main>'; 

get_footer();
