<?php
/**
 * Additional Customer Details
 *
 * This is extra customer data which can be filtered by plugins. It outputs below the order item table.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-customer-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 2.5.0
 */

defined( 'ABSPATH' ) || exit;
?>
<?php if ( ! empty( $fields ) ) : ?>
	<div style="margin-bottom: 40px;">
		<h2 style="font-family:'Helvetica',Arial,Verdana,sans-serif; color:#202020; font-size:20px;"><?php esc_html_e( 'Customer details', 'woocommerce' ); ?></h2>
		<ul>
			<?php foreach ( $fields as $field ) : ?>
				<li style="font-family:'Helvetica',Arial,Verdana,sans-serif; color:#202020;"><strong><?php echo wp_kses_post( $field['label'] ); ?>:</strong> <span><?php echo wp_kses_post( $field['value'] ); ?></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
