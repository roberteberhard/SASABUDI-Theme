<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

echo '<div class="cart-listing">';

	/**
   * Hook :: Before Cart
   */
 do_action( 'woocommerce_before_cart' );

	echo '<form class="woocommerce-cart-form" action="' . esc_url( wc_get_cart_url() ) . '" method="post">';

		/**
		 * Hook :: Before Cart Table
		 */
		do_action( 'woocommerce_before_cart_table' );

			/**
			 * Shop Table Cart
			 */
			echo '<table class="woocommerce-cart-form__contents" cellspacing="0">';
				
				echo '<thead>';
					echo '<tr>';
						echo '<th colspan="6"><h2 class="cart-listing__title">' . __("Shopping Cart", "sasabudi") . '</h2></th>';
					echo '</tr>';
				echo '</thead>';

				echo '<tbody>';
				
					/**
					 * Before Cart Contents
					 */		
					do_action( 'woocommerce_before_cart_contents' );

						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

							// Arguments
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
							
							// Show when products excists
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							
								// product settings
								$product_thumb			= apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key );
								$product_sales			= get_field('shop_product_sales', 'option') ? true : false;
								$product_permalink	= apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								$sale_flag					 = ($_product->is_on_sale() && $product_sales) ? '<div class="product-sale">' . esc_html__( 'Sale', 'sasabudi' ) . '</div>' : '';

								echo '<tr class="' . esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) . '">';
									
									// Product Thumbnail
									echo '<td class="product-thumbnail">';
										
										if ( ! $product_permalink ) {
											echo $product_thumb; // PHPCS: XSS ok.
											echo $sale_flag;
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_thumb ); // PHPCS: XSS ok.
											echo $sale_flag;
										}

									echo '</td>';	

									// Product Name
									echo '<td class="product-name" data-title="' . esc_attr__( 'Product', 'sasabudi' ) . '">';
										
										// Evaluate Sales
										$is_sale = get_field('shop_product_sales', 'option') ? true : false;
										$sale_tag = ($_product->is_on_sale() && $is_sale) ? '<span> - <span><span class="product-name__sale">' . esc_html__('Sale', 'sasabudi') . '</span>' : '';
										
										if ( ! $product_permalink ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', esc_html( $_product->get_name() ) . '' . $sale_tag , $cart_item, $cart_item_key ) . '&nbsp;' );
										} else {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s%1s</a>', esc_url( $product_permalink ), esc_html($_product->get_name()), $sale_tag), $cart_item, $cart_item_key ) );
										}
										
										// After cart item
										do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
										
										// Meta data
										echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
										
										// Backorder notification
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'sasabudi' ) . '</p>', $product_id ) );
										}
									echo '</td>';							

									// Product Remove
									echo '<td class="product-remove">';
										echo apply_filters( 
											'woocommerce_cart_item_remove_link',
											sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'sasabudi' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										), $cart_item_key );
									echo '</td>';

									// Product Price
									echo '<td class="product-price" data-title="' . esc_attr__( 'Price', 'sasabudi' ) . '">';
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									echo '</td>';	

									// Product Quantity
									echo '<td class="product-quantity" data-title="' . esc_attr__( 'Quantity', 'sasabudi' ) . '">';
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {
											$product_quantity = woocommerce_quantity_input( 
												array(
													'input_name'    => "cart[{$cart_item_key}][qty]",
													'input_value'   => $cart_item['quantity'],
													'max_value'     => $_product->get_max_purchase_quantity(),
													'min_value'     => '1',
													'product_name'  => $_product->get_name(),
												),
												$_product,
												false
											);
										}
										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									echo '</td>';

									// Product Subtotal
									echo '<td class="product-subtotal" data-title="' . esc_attr__( 'Total', 'sasabudi' ) . '">';
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									echo '</td>';

								echo '</tr>';
							}
						}

					/**
					 * Hook :: Cart Contents
					 */
					do_action( 'woocommerce_cart_contents' );

					 echo '<tr>';
						 echo '<td colspan="6" class="actions">';

							if ( wc_coupons_enabled() ) {

								echo '<div class="coupon">';

									echo '<p class="coupon__code">' . esc_html__( 'If you have a coupon code, please apply it below', 'sasabudi' ) . '</p>';
									echo '<div class="coupon__group mce-code">';
										echo '<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="' . esc_attr__( 'Promo or coupon code', 'sasabudi' ) . '" />';
									echo '</div>';
									echo '<input type="submit" class="button coupon__button" name="apply_coupon" value="' . esc_attr__( 'Apply', 'sasabudi' ) . '" />';
									
									/**
									 * Hook :: Cart Coupon
									 */						
									do_action( 'woocommerce_cart_coupon' );

								echo '</div>';

							}
							
							echo '<button type="submit" class="button coupon__update" id="coupon_update" name="update_cart" value="' . esc_attr__( 'Update cart', 'sasabudi' ) . '">' . esc_html__( 'Update cart', 'sasabudi' ) . '</button>';

							/**
							 * Hook :: Cart Actions
							 */
							 do_action( 'woocommerce_cart_actions' );

							 wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' );

						 echo '</td>';
					echo '</tr>';

					/**
					 * Hook :: After Cart Contents
					 */			
					do_action( 'woocommerce_after_cart_contents' );

				echo '</tbody>';			
			echo '</table>';
			
		/**
		 * Hook :: After Cart Table
		 */
		do_action( 'woocommerce_after_cart_table' );
				
	echo '</form>';
echo '</div>';

/**
 * Hook :: Before Cart Collaterals
 */
do_action( 'woocommerce_before_cart_collaterals' );

	/**
	 * Cart Collaterals
	 */
	echo '<div class="cart-collaterals">';
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	echo '</div>';

/**
 * Hook :: After Cart
 */
do_action( 'woocommerce_after_cart' );
