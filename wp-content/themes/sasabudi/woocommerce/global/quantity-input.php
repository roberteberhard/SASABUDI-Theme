<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) :

	echo '<div class="quantity hidden">';
		echo '<input type="hidden" id="' . esc_attr( $input_id ) . '" class="qty" name="' . esc_attr( $input_name ) . '" value="' . esc_attr( $min_value ) . '" />';
	echo '</div>';

else:

	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'sasabudi' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'sasabudi' );

	/**
	 * Custom Quantitiy
	 */
	echo '<div class="quantity">';
		?>
		<span class="cart-minus__btn">-</span>
		<input onkeyup="this.value=this.value.replace(/[^\d]/,'')" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( 0 < $max_value ? $max_value : 10 ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'sasabudi' ) ?>" id="<?php echo esc_attr( $input_id ); ?>" class="input-text custom-qty qty text" size="4" aria-labelledby="<?php echo esc_attr( $label ) ?>" />
		<span class="cart-plus__btn">+</span>
	<?php
	echo '</div>';

endif;

