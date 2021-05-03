<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<!-- Container Content -->
<table id="template_content" style="padding:0px 40px;" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top">
			<p style="padding:0;margin:0;color:#202020;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:18px;line-height:1.5;text-align:center;"><?php printf( esc_html__( 'Hi there!', 'sasabudi' ), esc_html( $user_login ) ); ?></p>
			<p style="padding:0;margin:0;color:#202020;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:18px;line-height:1.5;text-align:center;"><?php printf( esc_html__( 'Thanks for creating an account on %1$s. Your username is %2$s.', 'sasabudi' ), esc_html( $blogname ), '<strong>' . esc_html( $user_login ) . '</strong>'); ?></p>
			<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>
				<p style="margin:20px 0 0 0;text-align:center;font-family:'Helvetica',Arial,Verdana,sans-serif;color:#202020;font-size:18px;line-height:1.5;"><?php printf( esc_html__( 'Your password has been automatically generated: %s', 'sasabudi' ), '<strong>' . esc_html( $user_pass ) . '</strong>' ); ?></p>
			<?php endif; ?>	
			<p style="padding:0;margin:20px 0 45px 0;color:#202020;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:16px;line-height:1.5;text-align:center;"><?php printf( esc_html__( 'You can access your account area to view orders, change your password, and more at: %1$s', 'sasabudi' ), make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); ?></p>
			<hr style="padding:0;margin:40px 0 45px 0;height:1px;border:none;background-color:#e5e5e5;"></hr>
			<p style="padding:0;margin:0;color:#202020;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:16px;line-height:1.5;text-align:center;"><?php printf( esc_html__( 'Please send an email to %s if you have any questions at all.', 'sasabudi' ), '<a href="mailto:team@sasabudi.com">team@sasabudi.com</a>' ); ?></p>
			<p style="padding:0;margin:20px 0 60px 0;color:#202020;font-family:Helvetica,Arial,Verdana,sans-serif;font-size:16px;line-height:1.5;text-align:center;"><?php esc_html_e( 'Welcome to the fam!', 'sasabudi' ); ?><br/><?php esc_html_e( 'Team SASABUDI', 'sasabudi' ); ?></p>
		</td>
	</tr>
</table>
<!-- End Container Content -->

<?php
do_action( 'woocommerce_email_footer', $email );
