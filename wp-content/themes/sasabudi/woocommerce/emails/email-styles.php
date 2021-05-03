<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
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
	exit;
}

// Custom Colors
$bg        	= get_option( 'woocommerce_email_background_color' );
$body      	= get_option( 'woocommerce_email_body_background_color' );
$base      	= get_option( 'woocommerce_email_base_color' );
$base_text 	= wc_light_or_dark( $base, '#202020', '#ffffff' );
$text      	= get_option( 'woocommerce_email_text_color' );

// Pick a contrasting color for links.
$link_color = wc_hex_is_light( $base ) ? $base : $base_text;

// Manage 'acf' dashboard settings
$facebook 	= '';
$twitter 		= '';
$pinterest 	= '';
$instagram 	= '';
if (get_field('facebook_username', 'option' ))  $facebook = get_field('facebook_username', 'option');
if (get_field('twitter_username', 'option' ))  $twitter = get_field('twitter_username', 'option');
if (get_field('pinterest_username', 'option' ))  $pinterest = get_field('pinterest_username', 'option');
if (get_field('instagram_username', 'option' ))  $instagram = get_field('instagram_username', 'option');

// Assign links when possible
$facebook = strlen($facebook) > 1 ? $facebook : 'https://www.facebook.com/';
$twitter = strlen($facebook) > 1 ? $twitter : 'https://www.twitter.com/';
$pinterest = strlen($facebook) > 1 ? $pinterest : 'https://www.pinterest.com/';
$instagram = strlen($facebook) > 1 ? $instagram : 'https://www.instagram.com/';
?>
#wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
	-webkit-text-size-adjust: none !important;
}
#template_container {
	background-color: <?php echo esc_attr( $body ); ?>;
}
