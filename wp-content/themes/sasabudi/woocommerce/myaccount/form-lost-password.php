<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Customer Account
 */
echo '<aside class="account-aside">';
  echo '<div class="account-aside__menu">';
    echo '<h3>' . esc_html__('My Account', 'sasabudi') . '</h3>';
    echo '<p>';
      printf( __('Already have an account?<br /><a class="primary-link" href="' . get_permalink( wc_get_page_id('myaccount') ) . '">%1$s</a>', 'sasabudi'), esc_html__('Sign In!', 'sasabudi') );
    echo '</p>';
    echo '<p class="is-required"><abbr class="required">* </abbr>' . esc_html__( 'All fields required', 'sasabudi' ) . '</p>';
  echo '</div>';	
echo '</aside>';


/**
 * Customer Content
 */
echo '<aside class="account-content">';

  echo '<h1 class="account-content__title">' . esc_html__( 'Password Reset', 'sasabudi' ) . '</h1>';  
  
  echo '<div class="woocommerce-login">';

    /**
     * Hook :: Before Customer Login Form -> shows the error messages
     */
    do_action( 'woocommerce_before_lost_password_form' );

    echo '<h2>' . esc_html__( 'Request to reset your password', 'sasabudi' ) . '</h2>';
    
    echo '<p class="form-row">' . apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'sasabudi' ) ) . '</p>';

    echo '<form method="post" class="woocommerce-form lost">';

      /** Robert **/
      echo '<p class="form-row">';
        echo '<label for="user_login">' . esc_html__( 'Username or email', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
        echo '<input type="text" class="input-text" name="user_login" id="user_login" autocomplete="username" />';
      echo '</p>';
  
      /**
       * Hook :: lostpassword_form
       */
      do_action( 'woocommerce_lostpassword_form' );

      echo '<p class="form-row lost">';
        echo '<input type="hidden" name="wc_reset_password" value="true" />';
        echo '<button type="submit" class="button btn-auto" value="' . esc_attr__( 'Reset password', 'sasabudi' ) . '">' . esc_html__( 'Send', 'sasabudi' ) . '</button>';
      echo '</p>';

      /**
       * Nonce :: lost-password-nonce
       */
      wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' );

    echo '</form>';

    /**
     * Hook :: after_lost_password_form
     */
    do_action( 'woocommerce_after_lost_password_form' );
    
  echo '</div>';

echo '</aside>';
