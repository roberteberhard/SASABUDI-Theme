<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

$post_username = '';
$post_email = '';
$post_first_name = '';
$post_last_name = '';

// username
if ( ! empty( $_POST['username'] ) ) {
  $post_username = esc_attr( wp_unslash( $_POST['username'] ) );
} else {
  $post_username = '';
}

// email
if ( ! empty( $_POST['email'] ) ) {
  $post_email = esc_attr( wp_unslash( $_POST['email'] ) );
} else {
  $post_email = '';
}

// firstname
if ( ! empty( $_POST['billing_first_name'] ) ) {
  $post_first_name = esc_attr( wp_unslash( $_POST['billing_first_name'] ) );
} else {
  $post_first_name = '';
}

// lastname
if ( ! empty( $_POST['billing_last_name'] ) ) {
  $post_last_name = esc_attr( wp_unslash( $_POST['billing_last_name'] ) );
} else {
  $post_last_name = '';
}


/* Sidebar */
echo '<aside class="account-aside">';
  echo '<div class="account-aside__menu">';
    echo '<h3>' . esc_html__('My Account', 'sasabudi') . '</h3>';
    echo '<p>';
      printf( __('Already have an account?<br /><a class="primary-link" href="' . get_permalink( wc_get_page_id('myaccount') ) . '">%1$s</a>', 'sasabudi'), esc_html__('Sign In!', 'sasabudi') );
    echo '</p>';
    echo '<p class="is-required"><abbr class="required">* </abbr>' . esc_html__( 'All fields required', 'sasabudi' ) . '</p>';
  echo '</div>';	
echo '</aside>';


/* Content */
echo '<aside class="account-content">';

  /* Dashboard title */
  echo '<h1 class="account-content__title">' . esc_html__( 'Create Account', 'sasabudi' ) . '</h1>';
  
  echo '<div class="woocommerce-login">';

  	/**
		 * Hook :: Before Customer Login Form -> shows the error messages
		 */
    do_action( 'woocommerce_before_customer_login_form' );

    echo '<h2>' . esc_html__( 'New Customer Account', 'sasabudi' ) . '</h2>';

    if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) :
    
      echo '<form method="post" class="woocommerce-form register" ' . do_action( 'woocommerce_register_form_tag' ) . '>';
      
        /**
         * Hook :: Register Form Start
         */				
        do_action( 'woocommerce_register_form_start' );
  
          echo '<p class="form-row">';
            echo '<label for="reg_billing_first_name">' . esc_html__( 'First name', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
            echo '<input type="text" class="input-text"  name="billing_first_name" id="reg_billing_first_name" autocomplete="first-name" value="' . $post_first_name . '" maxlength="64" />';
          echo '</p>';
      
          echo '<p class="form-row">';
            echo '<label for="reg_billing_last_name">' . esc_html__( 'Last name', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
            echo '<input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" autocomplete="last-name" value="' . $post_last_name . '" maxlength="64" />';
          echo '</p>';
  
          if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) :
            echo '<p class="form-row">';
              echo '<label for="reg_username">' . esc_html__( 'Username', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
              echo '<input type="text" class="input-text" name="username" id="reg_username" autocomplete="username" value="' . $post_username . '" maxlength="64" />';
            echo '</p>';
          endif;
  
          echo '<p class="form-row">';
            echo '<label for="reg_email">' . esc_html__( 'Email address', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
            echo '<input type="email" class="input-text" name="email" id="reg_email" autocomplete="email" value="' . $post_email . '" maxlength="64" />';
          echo '</p>';
  
          if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) :
            echo '<p class="form-row is-password">';
              echo '<label for="reg_password">' . esc_html__( 'Password', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
              echo '<input type="password" class="woocommerce-Input woocommerce-Input--text input-text input-pw" name="password" id="reg_password" autocomplete="new-password" maxlength="64" />';
            echo '</p>';
          endif;

          /**
           * Hook :: Register Form
           */
          do_action( 'woocommerce_register_form' );
  
          echo '<p class="form-row signup">';
            wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' );
            echo '<button type="submit" class="button btn-auto" name="register" value="' . esc_attr__( 'Register', 'sasabudi' ) . '">' . esc_html__( 'Sign Up', 'sasabudi' ) . '</button>';
          echo '</p>';
  
        /**
         * Hook :: Before Register Form End
         */
        do_action( 'woocommerce_register_form_end' );
    
      echo '</form>';
  
    endif;
  
  echo '</div">';

  /**
   * Hook :: After Customer Login Form
   */
  do_action( 'woocommerce_after_customer_login_form' );

echo '</aside>';
