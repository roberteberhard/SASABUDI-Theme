<?php
/**
 * Customer Reset Password email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<!-- Container Content -->
<table id="template_content" style="padding:0 40px;" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top" style="padding-bottom: 40px;">
			<p style="padding:0;margin:0;color:#202020;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:18px;line-height:1.5;text-align:center;"><?php printf( esc_html__( 'Hey %s,', 'sasabudi' ), esc_html( $user_login ) ); ?></p>
			<p style="padding:0;margin:0;color:#202020;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:18px;line-height:1.5;text-align:center;"><?php esc_html_e( 'We got your request to reset your password! Just click below:', 'sasabudi' ); ?></p>
			<p style="margin:30px 0 40px 0;text-align:center;">
				<a style="display:inline-block;width:auto;padding:13px 30px 13px;font-family:Helvetica,Arial,Verdana,sans-serif;color:#ffffff;font-size:14px;font-weight:300;text-align:center;letter-spacing:1px;text-transform: uppercase;text-decoration:none;border-radius:2px;background-color:#2a2a2a;" href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'id' => $user_id ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) ); ?>">
					<?php esc_html_e( 'Reset Password', 'sasabudi' ); ?>
				</a>
			</p>
			<p style="padding:0;margin:0;color:#aaaaaa;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:15px;line-height:1.5;text-align:center;"><?php esc_html_e( 'If you received this email in error, you can safely ignore this email.', 'sasabudi' ); ?></p>
			<hr style="padding:0;margin:40px 0 45px 0;height:1px;border:none;background-color:#e5e5e5;"></hr>
			<p style="padding:0;margin:20px 0 60px 0;text-align:center;font-family:'Helvetica',Arial,Verdana,sans-serif;color:#202020;font-size:15px;line-height:1.5;"><?php printf( esc_html__( 'As a quick reminder, your username is %s.', 'sasabudi' ), '<strong>' . esc_html( $user_login ) . '</strong>' ); ?> <?php printf( esc_html__( 'Please send an email to %s if you have any questions at all.', 'sasabudi' ), '<a href="mailto:team@sasabudi.com">team@sasabudi.com</a>' ); ?></p>
		</td>
	</tr>
</table>
<!-- End Container Content -->

<?php
do_action( 'woocommerce_email_footer', $email );
