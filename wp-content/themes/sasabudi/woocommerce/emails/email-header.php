<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1, user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<style type="text/css">
			h2 {
				text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
			}
			h3 {
				text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
			}
			table.td {
				border: 1px solid #e5e5e5 !important;
			}
			table.td thead tr th.tracking-provider,
			table.td thead tr th.tracking-number,
			table.td thead tr th.date-shipped,
			table.td thead tr th.order-actions {
				color: #202020 !important 
				font-family: 'Helvetica',Arial,Verdana,sans-serif !important;
				border: 1px solid #e5e5e5 !important
			}
			table.td tbody tr td {
				color: #202020 !important 
				font-family: 'Helvetica',Arial,Verdana,sans-serif !important; 
				border: 1px solid #e5e5e5 !important;
			}
			@media only screen and (max-width: 600px) {
				img {
					margin:0;padding:0;
				}
				table {
					width:100% !important;
				}
				#template_content {
					padding:0 20px !important;
				}
			}
		</style>
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" style="margin:0;padding:0;" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						<table id="template_container" style="padding-top:24px;" border="0" cellpadding="0" cellspacing="0" width="600px">
							<tr>
								<td align="center" valign="top">
									<!-- Container Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td>
												<h1 style="color:transparent;font-size:0;text-align:center;"><a href="<?php echo esc_url(home_url('/')) ?>"><img src="<?php echo esc_url(site_url('/wp-data/icons/sasabudi.jpg')) ?>" width="92px" height="92px" /></a></h1>
											</td>
										</tr>
										<tr>
											<td>
												<h2 style="padding:0 30px;margin:50px 0 30px 0;font-family:'Helvetica',Arial,Verdana,sans-serif;color:#202020;font-size:24px;line-height:1.25;text-align:center;"><?php echo $email_heading; ?></h2>
											</td>
										</tr>
									</table>
									<!-- End Container Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Container Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600px">
										<tr>
											<td valign="top">