<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? __( 'Billing address', 'sasabudi' ) : __( 'Shipping address', 'sasabudi' );

/**
 * Hook :: before edit account address form
 */
do_action( 'woocommerce_before_edit_account_address_form' );

/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo esc_html__( 'Account Addresses', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper floated">';
  wc_print_notices();
echo '</div>';


if ( ! $load_address ) :

    /**
     * Show my address section
     */
    wc_get_template( 'myaccount/my-address.php' );

else :

  echo '<div class="account-address">';
    echo '<div class="edit">';
      
      echo '<h3>' . apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ) . '</h3>';

      echo '<form class="woocommerce__form edit-adresses" method="post">';

        /**
         * Hook :: before edit address form
         */
        do_action( "woocommerce_before_edit_address_form_{$load_address}" );

        foreach ( $address as $key => $field ) {
          woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
        }

        /**
         * Hook :: after edit address form
         */
        do_action( "woocommerce_after_edit_address_form_{$load_address}" );

        echo '<p class="privacy-protection">';
          printf( __( 'Here at SASABUDI we take your privacy very seriously and are committed to the protection of your personal data. Read more about how we care for and use your data in our <a class="primary-link" href="%1$s">Privacy Policy</a>.', 'sasabudi' ), esc_url( get_home_url() ) . '/privacy-policy' );
        echo '</p>';

        echo '<input type="submit" class="button btn-auto" name="save_address" value="' . esc_attr__( 'Save address', 'sasabudi' ) . '" />';
        wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' );
        echo '<input type="hidden" name="action" value="edit_address" />';

      echo '</form>';

    echo '</div>';
  echo '</div>';

endif;

/**
 * Hook :: after edit account address from
 */
do_action( 'woocommerce_after_edit_account_address_form' );
