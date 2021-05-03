<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Username
if ( ! empty( $_POST['username'] ) ) {
  $post_username = esc_attr( wp_unslash( $_POST['username'] ) );
} else {
  $post_username = '';
}

/* Sidebar */
echo '<aside class="account-aside">';
	echo '<div class="account-aside__menu">';
		echo '<h3>' . esc_html__('My Account', 'sasabudi') . '</h3>';
		echo '<p>';
			printf( __('Don\'t have an account yet?<br /><a class="primary-link" href="' . get_permalink( wc_get_page_id('myaccount') ) . '?action=register">%1$s</a>', 'sasabudi'), esc_html__('Create one!', 'sasabudi') );
		echo '</p>';
		echo '<p class="is-required"><abbr class="required">* </abbr>' . esc_html__( 'All fields required', 'sasabudi' ) . '</p>';
	echo '</div>';	
echo '</aside>';

/* Content */
echo '<aside class="account-content">';

  /* Dashboard title */
	echo '<h1 class="account-content__title">' . esc_html__( 'Customer Login', 'sasabudi' ) . '</h1>';

	echo '<div class="woocommerce-login">';

		/**
		 * Hook :: Before Customer Login Form -> shows the error messages
		 */
		do_action( 'woocommerce_before_customer_login_form' );

		echo '<h2>' . esc_html__( 'Sign In', 'sasabudi' ) . '</h2>';
 
		echo '<p>' . esc_html__( 'If you are a registered user, please enter your email and password.', 'sasabudi' ) . '</p>';

		echo '<form class="woocommerce-form woocommerce-form-login login" method="post">';

			/**
			 * Hook :: Login Form Start
			 */		
			do_action( 'woocommerce_login_form_start' );

			echo '<p class="form-row">';
				echo '<label for="username">'. esc_html__( 'Username or Email address', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
				echo '<input type="text" class="input-text" name="username" id="username" autocomplete="username" value="' . $post_username . '" maxlength="64" />';
			echo '</p>';
		
			echo '<p class="form-row">';
				echo '<label for="password">' . esc_html__( 'Password', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
				echo '<input type="password" class="woocommerce-Input woocommerce-Input--text input-text input-pw" name="password" id="password" autocomplete="current-password" maxlength="64" />';
			echo '</p>';

      /**
       * Hook :: Login Form
       */		
			do_action( 'woocommerce_login_form' );

			echo '<p class="form-row remember">';
				echo '<label class="label-for-checkbox" for="rememberme">';
					echo '<input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>' . esc_html__( 'Remember', 'sasabudi' ) . '</span>';
				echo '</label>';
			echo '</p>';

			echo '<p class="form-row password">';
				echo '<a href="' . esc_url( wp_lostpassword_url() ) . '" class="primary-link">' . esc_html__( 'Lost your password?', 'sasabudi' ) . '</a>';
			echo '</p>';

			echo '<p class="form-row submit">';
				wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' );
				echo '<button type="submit" class="button btn-auto" name="login" value="' . esc_attr__( 'Sign In', 'sasabudi' ) . '">' . esc_html__( 'Sign In', 'sasabudi' ) . '</button>';
			echo '</p>';

			/**
			 * Hook :: Login Form End
			 */	
			do_action( 'woocommerce_login_form_end' );

		echo '</form>';
	 
	echo '</div>';

	/**
   * Hook :: After Customer Login Form
   */
	do_action( 'woocommerce_after_customer_login_form' );

	echo '<div class="woocommerce-login">';
		echo '<h2>' . esc_html__( 'New to SASABUDI?', 'sasabudi' ) . '</h2>';
		echo '<p>' . esc_html__( 'Create your personalized SASABUDI account! You can take advantage of order tracking and history, as well as edit billing/shipping info and more.', 'sasabudi' ) . '</p>';
		echo '<p class="register"><a class="button btn-auto" href="' . get_permalink( wc_get_page_id('myaccount') ) . '?action=register">' . esc_html__( 'Create Account', 'sasabudi' ) . '</a></p>';
	echo '</div>';

echo '</aside>';
