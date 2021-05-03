<?php
/**
 * The template for displaying the 'policy' pages.
 *
 * Template name: Page-Checkout
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header('checkout');

	echo '<main class="main" role="main">';
		/**
		 * Render the cart / checkout progress
		 */
		echo '<div class="checkout-progress">';

			echo '<nav class="checkout-progress__breadcrumb">';
				echo '<ul>';
					echo '<li><a href="' . esc_url( home_url( '/' ) ) .'">' . esc_html__('Home', 'sasabudi') . '</a></li>';
					echo '<li><span class="spacer">/</span><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '">' . esc_html__('Catalog', 'sasabudi') . '</a></li>';
						if( !is_wc_endpoint_url( 'order-received' ) AND !is_wc_endpoint_url( 'order-pay' )) {
							echo '<li><span class="spacer">/</span><a href="' . esc_url( wc_get_cart_url() ) . '">' . esc_html__('Cart', 'sasabudi') . '</a></li>';
							echo '<li class="active"><span class="spacer">/</span><a href="' . esc_url( wc_get_checkout_url() ) . '">' . esc_html__('Checkout', 'sasabudi') . '</a></li>';
							echo '<li class="next"><span class="spacer">/</span>' . esc_html__('Confirmation', 'sasabudi') . '</li>';
						}
						if( is_wc_endpoint_url( 'order-received' ) ) {
							echo '<li><span class="spacer">/</span><a href="' . esc_url( wc_get_cart_url() ) . '">' . esc_html__('Cart', 'sasabudi') . '</a></li>';
							echo '<li><span class="spacer">/</span><a href="' . esc_url( wc_get_checkout_url() ) . '">' . esc_html__('Checkout', 'sasabudi') . '</a></li>';
							echo '<li class="active"><span class="spacer">/</span>' . esc_html__('Confirmation', 'sasabudi') . '</li>';
						}
						if( is_wc_endpoint_url( 'order-pay' ) ) {
							echo '<li><span class="spacer">/</span><a href="' . esc_url( wc_get_cart_url() ) . '">' . esc_html__('Cart', 'sasabudi') . '</a></li>';
							echo '<li><span class="spacer">/</span><a href="' . esc_url( wc_get_checkout_url() ) . '">' . esc_html__('Checkout', 'sasabudi') . '</a></li>';
							echo '<li class="active"><span class="spacer">/</span>' . esc_html__('Order Pay', 'sasabudi') . '</li>';
						}
				echo '</ul>';
			echo '</nav>';

		echo '</div>';

		echo '<div class="checkout-content">';

			/**
			 * Render the checkout content
			 */
			if( is_page( 'checkout' ) ):
				while ( have_posts() ) : the_post();
					the_content();
				endwhile; 
			endif;

		echo '</div>';
	
	echo '</main>';  

get_footer('checkout');
