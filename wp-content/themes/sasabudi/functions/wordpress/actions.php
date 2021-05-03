<?php
/**
 * WP actions
 * 
 * Whitelist style for wp_kses_post
 * Disable generated image sizes
 * Disable other image sizes
 * Disable scaled image size
 * Woocommerce thumnail size
 * Send WordPress Email through SMTP Server
 * 
 * @package sasabudi
 */


// -----------------------------------------------------------------------------
// Whitelist style for wp_kses_post()
// -----------------------------------------------------------------------------
function sasabudi_html_tags_code() {
  global $allowedposttags;
    $allowedposttags["style"] = array();
}
add_action( 'init', 'sasabudi_html_tags_code', 10 );


// -----------------------------------------------------------------------------
// Disable generated image sizes
// -----------------------------------------------------------------------------
function sasabudi_disable_image_sizes($sizes) {
	unset($sizes['large']);        // disable large size
	unset($sizes['medium_large']); // disable medium-large size
	unset($sizes['1536x1536']);    // disable 2x medium-large size
	unset($sizes['2048x2048']);    // disable 2x large size
	return $sizes;
}
add_action('intermediate_image_sizes_advanced', 'sasabudi_disable_image_sizes');


// -----------------------------------------------------------------------------
// Disable other image sizes
// -----------------------------------------------------------------------------
function sasabudi_disable_other_image_sizes() {	
	remove_image_size('post-thumbnail'); // disable images added via set_post_thumbnail_size() 
	remove_image_size('another-size');   // disable any other added image sizes
}
add_action('init', 'sasabudi_disable_other_image_sizes');


// -----------------------------------------------------------------------------
// Disable scaled image size
// -----------------------------------------------------------------------------
add_filter('big_image_size_threshold', '__return_false');


// -----------------------------------------------------------------------------
// Woocommerce thumnail size
// -----------------------------------------------------------------------------
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
	return array(
    'width' => 180,
    'height' => 180,
    'crop' => 0,
  );
});


// -----------------------------------------------------------------------------
// Send WordPress Email through SMTP Server
// -----------------------------------------------------------------------------
function set_phpmailer_details( $phpmailer ) {

	// email and password from dashboard settings
	$mailer_host 			= get_field('mailer_host', 'option');
	$mailer_port 			= get_field('mailer_port', 'option');
	$mailer_username 	= get_field('mailer_username', 'option');
	$mailer_password 	= get_field('mailer_password', 'option');

	// mailer settings details
	$phpmailer->isSMTP();     
	$phpmailer->Host = $mailer_host;
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = $mailer_port;
	$phpmailer->Username = $mailer_username;
	$phpmailer->Password = $mailer_password;
	$phpmailer->SMTPSecure = 'ssl';
}
add_action( 'phpmailer_init', 'set_phpmailer_details' );