<?php
/**
 * The template for displaying the 404 page.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

	echo '<main class="main" role="main">';

		echo '<div class="pagenotfound">';
			echo '<div class="is-wrapper">';

				echo '<h2 class="pagenotfound-title">' . esc_html__('Oops! Page Not Found.', 'sasabudi') . '</h2>';
				
				echo '<p class="pagenotfound-desc">' . esc_html__("Unfortunately we can't find the page you've requested. This could be because it has been moved, taken down or the address has been entered incorrectly.", 'sasabudi') . '</p>';

				echo '<div class="pagenotfound-back">';
					echo '<a href="' . esc_url(home_url()) . '" class="button btn-short">' . esc_html__( 'Go back to Home', 'sasabudi' ) . '</a>';
				echo '</div>';

			echo '</div>';
			
		echo '</div>';
		/**
		 * @hooked :: sasabudi_products_catalog_best_sellers - 10
		 */
		do_action( 'sasabudi_render_page_not_found' );

	echo '</main>';

get_footer();