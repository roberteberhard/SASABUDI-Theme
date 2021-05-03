<?php

define( 'SASABUDI_WOOCOMMERCE_IS_ACTIVE',                 class_exists( 'WooCommerce' ) );

// -----------------------------------------------------------------------------
// String to Slug
// -----------------------------------------------------------------------------
function sasabudi_string_to_slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '_', $str);
	$str = preg_replace('/-+/', "_", $str);
	return $str;
}

// -----------------------------------------------------------------------------
// Theme Name
// -----------------------------------------------------------------------------
function sasabudi_theme_name() {
	$sasabudi_theme = wp_get_theme();
	return $sasabudi_theme->get('Name');
}

// -----------------------------------------------------------------------------
// Theme Name
// -----------------------------------------------------------------------------
function sasabudi_parent_theme_name() {
	$theme = wp_get_theme();
	if ($theme->parent()):
		$theme_name = $theme->parent()->get('Name');
	else:
		$theme_name = $theme->get('Name');
	endif;

	return $theme_name;
}

// -----------------------------------------------------------------------------
// Theme Slug
// -----------------------------------------------------------------------------
function sasabudi_theme_slug() {
	$sasabudi_theme = wp_get_theme();
	return sasabudi_string_to_slug( $sasabudi_theme->get('Name') );
}

// -----------------------------------------------------------------------------
// Theme Author
// -----------------------------------------------------------------------------
function sasabudi_theme_author() {
	$sasabudi_theme = wp_get_theme();
	return $sasabudi_theme->get('Author');
}

// -----------------------------------------------------------------------------
// Theme Description
// -----------------------------------------------------------------------------
function sasabudi_theme_description() {
	$sasabudi_theme = wp_get_theme();
	return $sasabudi_theme->get('Description');
}

// -----------------------------------------------------------------------------
// Theme Version
// -----------------------------------------------------------------------------
function sasabudi_theme_version() {
	$sasabudi_theme = wp_get_theme(get_template());
	return $sasabudi_theme->get('Version');
}

// -----------------------------------------------------------------------------
// Page ID
// -----------------------------------------------------------------------------
function sasabudi_page_id() {
  $page_id = "";
  if ( is_single() || is_page() ) {
    $page_id = get_the_ID();
  } else if ( is_home() ) {
    $page_id = get_option('page_for_posts');
  }
  return $page_id;
}

// -----------------------------------------------------------------------------
// Checks if current page is post archive
// -----------------------------------------------------------------------------
function sasabudi_is_blog () {
	return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

// -----------------------------------------------------------------------------
// Get maintenance user role (Member plugin)
// -----------------------------------------------------------------------------
 function sasabudi_maintanance_mode() {
  $role = "false";
  $user = wp_get_current_user();
  if (count($user->roles) > 0) {
    $user_roles = $user->roles;
    if ( in_array( 'maintenance-mode', $user_roles, true ) ) {
      $role = "true";
    }
  } 
  return $role;
}

// -----------------------------------------------------------------------------
// Get User IP Address (WooCommerce)
// -----------------------------------------------------------------------------
function get_user_ip_address() {
  if( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
    $ip = $_SERVER['HTTP_CLIENT_IP']; // ip from share internet
  } elseif( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {	
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; // ip pass from proxy
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];	
  }
  return $ip;
}

// -----------------------------------------------------------------------------
// Get User Geo Country (WooCommerce)
// -----------------------------------------------------------------------------
function get_user_geo_country() {
  $geo      = new WC_Geolocation(); // Get WC_Geolocation instance object
  $user_ip  = $geo->get_ip_address(); // Get user IP
  $user_geo = $geo->geolocate_ip( $user_ip ); // Get geolocated user data.
  $country  = $user_geo['country']; // Get the country code
  return WC()->countries->countries[ $country ]; // return the country name
}

// -----------------------------------------------------------------------------
// Converts HEX to RGB
// -----------------------------------------------------------------------------
function sasabudi_hex2rgb($hex) {

	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);

	return implode(",", $rgb); // returns the rgb values separated by commas
}

// -----------------------------------------------------------------------------
// Converts string to bool
// -----------------------------------------------------------------------------
function sasabudi_string_to_bool( $string ) {
  return is_bool( $string ) ? $string : ( 'yes' === $string || 1 === $string || 'true' === $string || '1' === $string );
}

// -----------------------------------------------------------------------------
// Converts bool to string
// -----------------------------------------------------------------------------
function sasabudi_bool_to_string( $bool ) {
	$bool = is_bool( $bool ) ? $bool : ( 'yes' === $bool || 1 === $bool || 'true' === $bool || '1' === $bool );
	return true === $bool ? 'yes' : 'no';
}

// -----------------------------------------------------------------------------
// Sanitizes select controls
// -----------------------------------------------------------------------------
function sasabudi_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = isset($setting->manager->get_control( $setting->id )->choices) ? $setting->manager->get_control( $setting->id )->choices : '';
	return ( $choices && array_key_exists( $input, $choices ) ) ? $input : $setting->default;
}

// -----------------------------------------------------------------------------
// Sanitizes checkbox controls
// -----------------------------------------------------------------------------
function sasabudi_sanitize_checkbox( $input ){
	return sasabudi_string_to_bool($input);
}

// -----------------------------------------------------------------------------
// Sanitizes image upload
// -----------------------------------------------------------------------------
function sasabudi_sanitize_image( $input ) {
	$filetype = wp_check_filetype( $input );
	if ( $filetype['ext'] && ( wp_ext2type( $filetype['ext'] ) === 'image' || $filetype['ext'] === 'svg' ) ) {
		return esc_url( $input );
	}
	return '';
}