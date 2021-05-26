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



/**
 * Tag type: GA4 Event / View Item
 */

global $product;

// product category
$product_id = $product->get_id();
$product_terms = get_the_terms( $product_id, 'product_cat' );
$product_cat = array();
foreach ( $product_terms as $term ) {
	$product_cat[] = $term->name;
}
$categroy = array_merge(array_diff($product_cat, array('New Arrivals', 'On Our Radar'))); // Exclude categories

// attribute category
$attribute_type = get_the_terms($product_id, 'pa_model', array('hide_empty'=>true));
$attribute_name = isset($attribute_type[0] ) ? $attribute_type[0]->name : '';

// attribute variant
$product_attribute = $product->get_default_attributes();
$product_variant = array();
foreach ( $product_attribute as $variant) {
	$product_variant[] = $variant;
}
?>

<script>
dataLayer.push({
  'event': 'view_item',
  'ecommerce': {
    'currency': '<?php echo get_woocommerce_currency(); ?>',
    'quantity': '1',
    'product_id': '<?php echo $product_id; ?>',
    'product_category': '<?php echo $categroy[0]; ?>',
    'value': '<?php echo $product->get_price(); ?>',
    'items': [{
      'item_name': '<?php echo get_the_title(); ?>', // Name or ID is required.
      'item_id': '<?php echo $product_id; ?>',
      'affiliation': 'sasabudi online shop',
      'price': '<?php echo $product->get_price(); ?>',
      'item_brand': 'SASABUDI',
      'item_category': '<?php echo $categroy[0]; ?>',
      'item_category2': '<?php echo $attribute_name; ?>',
      'item_category3': '',
      'item_category4': '',
      'item_variant': '<?php echo $product_variant[0]; ?>',
      'item_list_name': '',  // If associated with a list selection.
      'item_list_id': '',  // If associated with a list selection.
      'index': '',  // If associated with a list selection.
      'quantity': '1'
    }],
    'line_items': [{ // Used for Pinterest!
      'product_name': '<?php echo get_the_title(); ?>',
      'product_id': '<?php echo $product_id; ?>',
      'product_category': '<?php echo $categroy[0]; ?>',
      'product_variant': '<?php echo $product_variant[0]; ?>',
      'product_price': '<?php echo $product->get_price(); ?>',
      'product_quantity': '1',
      'product_brand': 'SASABUDI'
    }]
  }
});
</script>

<script>
// Measure when a product is added to a shopping cart
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  'event': 'add_to_cart',
  'ecommerce': {
    'currency': '<?php echo get_woocommerce_currency(); ?>',
    'quantity': '1',
    'product_id': '<?php echo $product_id; ?>',
    'product_category': '<?php echo $categroy[0]; ?>',
    'value': '<?php echo $product->get_price(); ?>',
    'items': [{
      'item_name': '<?php echo get_the_title(); ?>', // Name or ID is required.
      'item_id': '<?php echo $product_id; ?>',
      'affiliation': 'sasabudi online shop',
      'price': '<?php echo $product->get_price(); ?>',
      'item_brand': 'SASABUDI',
      'item_category': '<?php echo $categroy[0]; ?>',
      'item_category2': '<?php echo $attribute_name; ?>',
      'item_category3': '',
      'item_category4': '',
      'item_variant': '<?php echo $product_variant[0]; ?>',
      'item_list_name': '',  // If associated with a list selection.
      'item_list_id': '',  // If associated with a list selection.
      'index': '',  // If associated with a list selection.
      'quantity': '1'
    }],
    'line_items': [{ // Used for Pinterest!
      'product_name': '<?php echo get_the_title(); ?>',
      'product_id': '<?php echo $product_id; ?>',
      'product_category': '<?php echo $categroy[0]; ?>',
      'product_variant': '<?php echo $product_variant[0]; ?>',
      'product_price': '<?php echo $product->get_price(); ?>',
      'product_quantity': '1',
      'product_brand': 'SASABUDI'
    }]
  }
});
</script>