<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
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
     * Hook :: woocommerce_before_reset_password_form
     */
    do_action( 'woocommerce_before_reset_password_form' );

      echo '<h2>' . apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below', 'sasabudi' ) ) . '</h2>';

      echo '<form method="post" class="woocommerce-form reset">';

        echo '<p class="form-row">';
          echo '<label for="password_1">' . esc_html__( 'New password', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
          echo '<input type="password" class="woocommerce-Input woocommerce-Input--text input-text input-pw" name="password_1" id="password_1" autocomplete="new-password" maxlength="64" />';
        echo '</p>';

        echo '<p class="form-row">';
          echo '<label for="password_2">' . esc_html__( 'Re-enter new password', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
          echo '<input type="password" class="woocommerce-Input woocommerce-Input--text input-text input-pw" name="password_2" id="password_2" autocomplete="new-password" maxlength="64" />';
        echo '</p>';

        echo '<input type="hidden" name="reset_key" value="' . esc_attr( $args['key'] ) , '" />';
        echo '<input type="hidden" name="reset_login" value="' . esc_attr( $args['login'] ) . '" />';
      
        /**
         * Hook :: woocommerce_resetpassword_form
         */
        do_action( 'woocommerce_resetpassword_form' );

        echo '<p class="form-row reset">';
          echo '<input type="hidden" name="wc_reset_password" value="true" />';
          echo '<button type="submit" class="button" value="' . esc_attr__( 'Save', 'sasabudi' ) . '">' . esc_html__( 'Save', 'sasabudi' ) . '</button>';
        echo '</p>';

        /**
         * Nonce :: reset-password-nonce
         */
        wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' );

      echo '</form>';
    
    /**
     * Hook :: woocommerce_after_reset_password_form
     */
    do_action( 'woocommerce_after_reset_password_form' );

  echo '</div>';
echo '</aside>';