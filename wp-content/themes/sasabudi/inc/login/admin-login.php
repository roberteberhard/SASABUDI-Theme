<?php

/**
 * Register Login Script
 */
function sasabudi_personal_login() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/css/login/login.css" />';
}
add_action('login_head', 'sasabudi_personal_login');

/**
 * Register Login Page.
 */
function sasabudi_login_page() {

	// add login url
	function sasabudi_login_logo_url() {
		return get_bloginfo( 'url' );
	}
	add_filter( 'login_headerurl', 'sasabudi_login_logo_url' );

	// add login title
	function sasabudi_login_logo_url_title() {
    return __( 'SASABUDI', 'sasabudi' );
	}
  add_filter( 'login_headertext', 'sasabudi_login_logo_url_title' );
  
}
add_action('after_setup_theme', 'sasabudi_login_page');