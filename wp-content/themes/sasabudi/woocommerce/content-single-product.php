<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form(); // WPCS: XSS ok.
		return;
	}

	echo '<div class="product-summary">';
		echo '<div class="is-extended">'; ?>

			<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10  	[hint :: removed]
				 * @hooked woocommerce_show_product_images - 20  			[hint :: removed]
				 * @hooked sasabudi_product_single_breadcrumb - 10
				 * @hooked sasabudi_product_single_highlights - 20
				 * @hooked sasabudi_product_single_images - 30
				 */
				do_action( 'woocommerce_before_single_product_summary' );

				echo '<div class="summary entry-summary">';

					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5  					[hint :: removed]
					 * @hooked woocommerce_template_single_rating - 10  				[hint :: removed]
					 * @hooked woocommerce_template_single_price - 10  					[hint :: removed]
					 * @hooked woocommerce_template_single_excerpt - 20  				[hint :: removed]
					 * @hooked woocommerce_template_single_add_to_cart - 30px  	[hint :: removed]
					 * @hooked woocommerce_template_single_meta - 40  					[hint :: removed]
					 * @hooked woocommerce_template_single_sharing - 50  				[hint :: removed]
					 * @hooked sasabudi_product_single_title - 5
					 * @hooked sasabudi_product_single_price - 10
					 * @hooked sasabudi_product_single_options - 20
					 * @hooked sasabudi_product_single_add_to_cart - 30
					 * @hooked sasabudi_product_single_meta - 40

					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );

				echo '</div>';
			echo '</div>';

		echo '</div>';

	echo '</div>';

	/**
	 * @hooked woocommerce_output_product_data_tabs - 10  	[hint :: removed]
	 * @hooked woocommerce_upsell_display - 15  						[hint :: removed]
	 * @hooked woocommerce_output_related_products - 20  		[hint :: removed]
	 * @hooked sasabudi_product_single_tabs - 10
	 * @hooked sasabudi_product_single_tagged_as - 20
	 * @hooked sasabudi_product_single_related_items - 30
	 * @hooked sasabudi_product_single_recently_viewed - 40
	 * @hooked sasabudi_products_statements - 50
	 */
	do_action( 'woocommerce_after_single_product_summary' );

	/**
	 * Hook :: After Single Product
	 */
	do_action( 'woocommerce_after_single_product' );
