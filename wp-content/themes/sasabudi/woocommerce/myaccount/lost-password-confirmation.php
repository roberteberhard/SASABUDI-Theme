<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook :: Before Lost Password Confirmation Message
 */
do_action( 'woocommerce_before_lost_password_confirmation_message' );

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
    
    echo '<div class="woocommerce-login is-larger">';

      /* Updated syntax by Robert */
      echo '<div class="woocommerce-notices-wrapper">';
        wc_print_notice( esc_html__( 'Password reset email has been sent.', 'sasabudi' ) );
      echo '</div>';
      
      echo '<p>';
        echo esc_html( apply_filters( 'woocommerce_lost_password_confirmation_message', esc_html__( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'sasabudi' ) ) );
      echo '</p>';

    echo '</div>';

  echo '</aside>';

/**
 * Hook :: Before After Password Confirmation Message
 */
do_action( 'woocommerce_after_lost_password_confirmation_message' );
