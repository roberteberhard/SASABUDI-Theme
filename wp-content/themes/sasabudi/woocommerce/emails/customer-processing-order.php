<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<!-- Container Content -->
<table id="template_content" style="padding:0px 40px;" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top" style="padding-bottom: 40px;">
			<p style="margin:0px;padding:0;text-align:center;font-family:'Helvetica',Arial,Verdana,sans-serif;color:#202020;font-size:18px;line-height:1.5;"><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
			<p style="margin:0px;padding:0;text-align:center;font-family:'Helvetica',Arial,Verdana,sans-serif;color:#202020;font-size:18px;line-height:1.5;"><?php printf( esc_html__( 'Just to let you know &mdash; we\'ve received your order #%s, and it is now being processed:', 'woocommerce' ), esc_html( $order->get_order_number() ) ); ?></p>
		</td>
	</tr>
	<tr>
		<td valign="top">
		
			<?php
			/*
			 * @hooked WC_Emails::order_details() Shows the order details table.
			 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
			 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
			 * @since 2.5.0
			 */
			do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

			/*
			 * @hooked WC_Emails::order_meta() Shows order meta data.
			 */
			do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

			/*
			 * @hooked WC_Emails::customer_details() Shows customer details
			 * @hooked WC_Emails::email_address() Shows email address
			 */
			do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email ); ?>

		</td>
	</tr>
</table>
<!-- End Container Content -->

<?php
/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
