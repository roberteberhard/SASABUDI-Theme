<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook :: Before Edit Account Form
 */
do_action( 'woocommerce_before_edit_account_form' );

/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo esc_html__( 'Account Information', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper floated">';
  wc_print_notices();
echo '</div>';


echo '<div class="account-settings">';

  echo '<h3>' . esc_html__( 'Your account details', 'sasabudi' ) . '</h3>';

  echo '<form class="woocommerce__form edit-account" action="" method="post"' . do_action( "woocommerce_edit_account_form_tag" ) . '>';

    /**
     * Hook :: Edit Account Form Start
     */
    do_action( 'woocommerce_edit_account_form_start' );

    echo '<p class="form-row form-row--first">';
      echo '<label for="account_first_name">' . esc_html__( 'First name', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
      echo '<input type="text" class="input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="' . esc_attr( $user->first_name ) . '" maxlength="64" />';
    echo '</p>';

    echo '<p class="form-row form-row--last">';
      echo '<label for="account_last_name">' . esc_html__( 'Last name', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
      echo '<input type="text" class="input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="' . esc_attr( $user->last_name ) . '" maxlength="64" />';
    echo '</p>';

    echo '<p class="form-row">';
      echo '<label for="account_display_name">' . esc_html__( 'Display name', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
      echo '<input type="text" class="input-text" name="account_display_name" id="account_display_name" autocomplete="family-name" value="' . esc_attr( $user->display_name ) . '" maxlength="64" />';
      echo '<span class="small-txt">' . esc_html__( 'This will be how your name will be displayed in the account section and in reviews', 'sasabudi' ) . '</span>';
    echo '</p>';

    echo '<p class="form-row">';
      echo '<label for="account_email">' . esc_html__( 'Email address', 'sasabudi' ) . '&nbsp;<abbr class="required" title="required">*</abbr></label>';	
      echo '<input type="email" class="input-text" name="account_email" id="account_email" autocomplete="email" value="' . esc_attr( $user->user_email ) . '" maxlength="64" />';
    echo '</p>';

    echo '<h3>' . esc_html__( 'Password change', 'sasabudi' ) . '</h3>';
      
    echo '<p class="form-row">';
      echo '<label for="password_current">' . esc_html__( 'Current password', 'sasabudi' ) . '</label>';
      echo '<input type="password" class="woocommerce-Input woocommerce-Input--password input-text input-pw" name="password_current" placeholder="' . esc_html__( 'Leave blank to leave unchanged', 'sasabudi' ) . '" id="password_current" autocomplete="off" maxlength="64" />';
    echo '</p>';

    echo '<p class="form-row form-row-strength">';
    echo '<label for="password_1">' . esc_html__( 'New password', 'sasabudi' ) . '</label>';
      echo '<input type="password" class="woocommerce-Input woocommerce-Input--password input-text input-pw" name="password_1" placeholder="' . esc_html__( 'Leave blank to leave unchanged', 'sasabudi' ) . '" id="password_1" autocomplete="off" maxlength="64" />';
    echo '</p>';

    echo '<p class="form-row">';
      echo '<label for="password_2">' . esc_html__( 'Confirm new password', 'sasabudi' ) . '</label>';
      echo '<input type="password" class="woocommerce-Input woocommerce-Input--password input-text input-pw" name="password_2" id="password_2" autocomplete="off" maxlength="64" />';
    echo '</p>';
  
    /**
     * Hook :: Edit Account Form
     */
    do_action( 'woocommerce_edit_account_form' );
  
    echo '<p class="form-row save">';
      wp_nonce_field( 'save_account_details', 'save-account-details-nonce' );
      echo '<button type="submit" class="button btn-auto" name="save_account_details" value="' . esc_attr__( 'Save My Settings', 'sasabudi' ) . '">' . esc_html__( 'Save Changes', 'sasabudi' ) . '</button>';
      echo '<input type="hidden" name="action" value="save_account_details" />';
    echo '</p>';

      /**
       * Hook :: Edit Account Form Start
       */
      do_action( 'woocommerce_edit_account_form_end' );

    echo '</form>';





echo '</div>';

/**
 * Hook :: After Edit Account Form
 */
do_action( 'woocommerce_after_edit_account_form' );
