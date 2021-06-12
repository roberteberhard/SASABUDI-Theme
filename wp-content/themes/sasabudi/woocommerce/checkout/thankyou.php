<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

echo '<div class="woocommerce-order">';

if ( $order ) :

	/**
	 * Hook :: Before Thankyou
	 */
	do_action( 'woocommerce_before_thankyou', $order->get_id() );

	if ( $order->has_status( 'failed' ) ) :

		/**
		 * Failed message
		 */
		echo '<div class="checkout-prompt">';
			echo '<div class="checkout-message">';
				echo '<div class="woocommerce-error--icon"></div>';
				echo '<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">' . esc_html__( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'sasabudi' ) . '</p>';
				echo '<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">';
					echo '<a href="' . esc_url( $order->get_checkout_payment_url() ) . '" class="button btn-short pay">' . esc_html__( 'Pay', 'sasabudi' ) . '</a>';
					if ( is_user_logged_in() ) :
						echo '<a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '" class="button btn-short pay">' . esc_html__( 'My account', 'sasabudi' ) . '</a>';
					endif;
				echo '</p>';
			echo '</div>';
		echo '</div>';

	else :

		/**
		 * Success Message
		 */
		echo '<h2 class="awesome">';
			printf( __( 'Thank you for making your purchase, %1$s!', 'sasabudi' ), esc_html( $order->get_billing_first_name() ) );
		echo '</h2>';

		echo '<div class="thankyou-heading">';
			// Your order has been received and we have emailed the purchase receipt to you.
			echo '<p class="woocommerce-notice woocommerce-notice--success">' . apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'We are glad that you found what you were looking for. It is our goal that you are always satisfied with what you have purchased from us. Please let us know if your buying experience was anything less than excellent.', 'sasabudi' ), $order ) . '</p>';
			echo '<p class="woocommerce-notice woocommerce-notice--success">' . apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'We look forward to seeing you again. Have a great day!', 'sasabudi' ), $order ) . '</p>';
		echo '</div>';

		echo '<div class="thankyou-address">';
			echo '<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">';

				if ( is_user_logged_in() ) {
					$before = '<a class="primary-link" href="' . esc_url( $order->get_view_order_url() ) . '">';
					$after  = '</a>';
				} else {
					$before = '';
					$after  = '';
				}

				echo '<li class="woocommerce-order-overview__order order">';
					echo '<span class="capitalized">' . esc_html__( 'Order number: ', 'sasabudi' ) . '</span>';
					echo $before . '<strong>' . $order->get_order_number() . '</strong>' . $after;
				echo '</li>';

				echo '<li class="woocommerce-order-overview__date date">';
					echo '<span class="capitalized">' . esc_html__( 'Date: ', 'sasabudi' ) . '</span>';
					echo '<strong>' . wc_format_datetime( $order->get_date_created() ) . '</strong>';
				echo '</li>';

				if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) :
					echo '<li class="woocommerce-order-overview__email email">';
						echo '<span class="capitalized">' . esc_html__( 'Email: ', 'sasabudi' ) . '</span>';
						echo '<strong>' . $order->get_billing_email() . '</strong>';
					echo '</li>';
				endif;

				echo '<li class="woocommerce-order-overview__total total">';
					echo '<span class="capitalized">' .  esc_html__( 'Total: ', 'sasabudi' ) . '</span>';
					echo '<strong>' . $order->get_formatted_order_total() . '</strong>';
				echo '</li>';

				if ( $order->get_payment_method_title() ) :
					echo '<li class="woocommerce-order-overview__payment-method method">';
					echo '<span class="capitalized">' . esc_html__( 'Payment method: ', 'sasabudi' ) . '</span>';
					echo '<strong>' . wp_kses_post( $order->get_payment_method_title() ) . '</strong>';
					echo '</li>';
				endif;

			echo '</ul>';
		echo '</div>';

	endif;

	/**
	 * Hook :: Thankyou
	 */
	do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
	do_action( 'woocommerce_thankyou', $order->get_id() );

else :

	echo '<div class="order-received">';
		echo '<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">' . apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Your order has been received and we have emailed the purchase receipt to you.', 'sasabudi' ), null ) . '</p>';
	echo '</div>';

endif;

echo '</div>';


/**
 * Tag type: GA4 Event / Purchase
 */

	$quantity = 0;

?>

<script>
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  'event': 'purchase',
  'ecommerce': {
      'transaction_id': '<?php echo $order->get_order_number(); ?>',
      'affiliation': 'sasabudi online shop',
      'value': '<?php echo number_format($order->get_subtotal(), 2, ".", ""); ?>',
      'tax': '<?php echo number_format($order->get_total_tax(), 2, ".", ""); ?>',
      'shipping': '<?php echo number_format($order->calculate_shipping(), 2, ".", ""); ?>',
      'currency': '<?php echo get_woocommerce_currency(); ?>',
      <?php if($order->get_coupon_codes()): ?>
      'coupon': '<?php echo implode("-", $order->get_coupon_codes()); ?>'
      <?php endif; ?>
'items': [
<?php foreach($order->get_items() as $key => $item):
$variant_name = ($item['variation_id']) ? wc_get_product($item['variation_id']) : '';
$product_id = $item['product_id'];
$terms = get_the_terms( $product_id, 'product_cat' );
$quantity = $quantity + $item->get_quantity();
$product_cat = array();
foreach ( $terms as $term ) {
	$product_cat[] = $term->name;
}
$categroy = array_merge(array_diff($product_cat, array('New Arrivals', 'On Our Radar')));
?>
      {
        'item_name': '<?php echo $item['name']; ?>',
        'item_id': '<?php echo $item['product_id']; ?>',
        'price': '<?php echo number_format($order->get_line_subtotal($item), 2, ".", ""); ?>',
        'item_brand': 'SASABUDI',
        'item_category': '<?php echo $categroy[0]; ?>',
        'item_variant': '<?php echo ($variant_name) ? implode("-", $variant_name->get_variation_attributes()) : ''; ?>',
        'quantity': '<?php echo $item['qty']; ?>'
      },
<?php endforeach; ?>
    ],
    'line_items': [ // Used for Pinterest!
<?php foreach($order->get_items() as $key => $item):
$variant_name = ($item['variation_id']) ? wc_get_product($item['variation_id']) : '';
$product_id = $item['product_id'];
$terms = get_the_terms( $product_id, 'product_cat' );
$product_cat = array();
foreach ( $terms as $term ) {
	$product_cat[] = $term->name;
}
$categroy = array_merge(array_diff($product_cat, array('New Arrivals', 'On Our Radar')));
?>
     {
      'product_name': '<?php echo $item['name']; ?>',
      'product_id': '<?php echo $item['product_id']; ?>',
      'product_category': '<?php echo $categroy[0]; ?>',
      'product_variant': '<?php echo ($variant_name) ? implode("-", $variant_name->get_variation_attributes()) : ''; ?>',
      'product_price': '<?php echo number_format($order->get_line_subtotal($item), 2, ".", ""); ?>',
      'product_quantity': '<?php echo $item['qty']; ?>',
      'product_brand': 'SASABUDI'
     },
<?php endforeach; ?>
    ],
    'contents': [ // Used for Facebook!
<?php foreach($order->get_items() as $key => $item): ?>
      { 
        'id': '<?php echo $item['product_id']; ?>',
        'product': '<?php echo esc_html(get_the_title($item['product_id'])); ?>',
        'quantity': '<?php echo $item['qty']; ?>'
      },
<?php endforeach; ?>
    ],
    'order_quantity' : '<?php echo $quantity; ?>'
  }
});
</script>
