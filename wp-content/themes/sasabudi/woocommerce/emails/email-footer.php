<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
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

defined( 'ABSPATH' ) || exit;

$facebook = '';
$twitter = '';
$instagram = '';
$pinterest = '';

if (get_field('facebook_username', 'option' ))  $facebook = get_field('facebook_username', 'option');
if (get_field('twitter_username', 'option' ))  $twitter = get_field('twitter_username', 'option');
if (get_field('instagram_username', 'option' ))  $instagram = get_field('instagram_username', 'option');
if (get_field('pinterest_username', 'option' ))  $pinterest = get_field('pinterest_username', 'option');

?>
												<!-- Navigation -->
												<table style="margin:15px 0 15px;padding:0" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td style="padding:2px;" align="center" width="33.333333%">
															<a style="font-family:'Helvetica',Arial,Verdana,sans-serif;font-size:15px;color:#202020;font-weight:700;line-height:150%;text-align:center;letter-spacing:0.5px;text-transform:uppercase;border:none;outline:none;text-decoration:none;" href="<?php echo esc_url(home_url('/about-us/')) ?>">About</a>
														</td>
														<td style="padding:2px;border-left:1px solid #e5e5e5;border-right:1px solid #e5e5e5;" align="center" width="33.333333%">
															<a style="font-family:'Helvetica',Arial,Verdana,sans-serif;font-size:15px;color:#202020;font-weight:700;line-height:150%;text-align:center;letter-spacing:0.5px;text-transform:uppercase;border:none;outline:none;text-decoration:none;" href="<?php echo esc_url(home_url('/catalog/')) ?>">Catalog</a>
														</td>														
														<td style="padding:2px;" align="center" width="33.333333%">
															<a style="font-family:'Helvetica',Arial,Verdana,sans-serif;font-size:15px;color:#202020;font-weight:700;line-height:150%;text-align:center;letter-spacing:0.5px;text-transform:uppercase;border:none;outline:none;text-decoration:none;" href="<?php echo esc_url(home_url('/help/faqs/')) ?>">Help</a>
														</td>
													</tr>
												</table>
												<!-- End Navigation -->	
											</td>
										</tr>
									</table>
									<!-- End Container Body -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" valign="top">
						<!-- Footer -->
						<table border="0" cellpadding="0" cellspacing="0" width="600">
							<tr>
								<td valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td border="0" align="center" valign="middle" style="padding-top: 70px">
												<table border="0" cellpadding="0" cellspacing="0" width="200px">
													<tr>
														<td border="0" valign="middle" width="50px">
															<a style="margin-left:5px;margin-right:5px;" href="<?php echo $facebook ?>"><img src="<?php echo esc_url(site_url('/wp-data/icons/sasabudi-email-facebook.png')) ?>" width="40px" height="40px"></a>
														</td>
														<td border="0" valign="middle" width="50px">
															<a style="margin-left:5px;margin-right:5px;" href="<?php echo $twitter ?>"><img src="<?php echo esc_url(site_url('/wp-data/icons/sasabudi-email-twitter.png')) ?>" width="40px" height="40px"></a>
														</td>
														<td border="0" valign="middle" width="50px">
															<a style="margin-left:5px;margin-right:5px;" href="<?php echo $instagram ?>"><img src="<?php echo esc_url(site_url('/wp-data/icons/sasabudi-email-instagram.png')) ?>" width="40px" height="40px"></a>
														</td>
														<td border="0" valign="middle" width="50px">
															<a style="margin-left:5px;margin-right:8px;" href="<?php echo $pinterest ?>"><img src="<?php echo esc_url(site_url('/wp-data/icons/sasabudi-email-pinterest.png')) ?>" width="40px" height="40px"></a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td border="0" align="center" valign="middle" id="credit" style="padding-top: 50px">
												<p style="margin:0 0 4px;font-family:'Helvetica',Arial,Verdana,sans-serif;color:#333333;font-size:14px;line-height:1.25;">© 2020-<?php echo date( 'Y' ) ?> SASABUDI • All Rights Reserved</p>			
												<p style="margin:0 0 40px;font-family:'Helvetica',Arial,Verdana,sans-serif;color:#333333;font-size:14px;line-height:1.25;"><?php esc_html_e( 'Schaffhauserstrasse 42 • 8400 Winterthur • Switzerland', 'sasabudi' ); ?></p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<!-- End Footer -->
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>