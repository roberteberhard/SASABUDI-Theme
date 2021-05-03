<?php
/**
 * WP filters
 *
 * Wrap oembed html
 * Change WordPress Sender Amail Address
 *
 * @package sasabudi
 */

// -----------------------------------------------------------------------------
// Wrap oembed html
// -----------------------------------------------------------------------------
function sasabudi_embed_oembed_html($html, $url, $attr, $post_id) {
	if ( strstr( $html,'youtube.com/embed/' ) || strstr( $html,'player.vimeo.com' ) ) {
		return '<div class="video-container responsive-embed widescreen">' . $html . '</div>';
	}

	return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'sasabudi_embed_oembed_html', 99, 4 );

// -----------------------------------------------------------------------------
// Change WordPress Sender Email Addresss
// -----------------------------------------------------------------------------
function wp_sasabudi_sender_email( $original_email_address ) {
	// email from dashboard settings
	$sender_email = get_field('sender_email_address', 'option');
	return $sender_email;
}
function wp_sasabudi_sender_name( $original_email_from ) {
	// name from dashboard settings
	$sender_name = get_field('sender_email_name', 'option');
	return $sender_name;
}
add_filter( 'wp_mail_from', 'wp_sasabudi_sender_email' );
add_filter( 'wp_mail_from_name', 'wp_sasabudi_sender_name' );