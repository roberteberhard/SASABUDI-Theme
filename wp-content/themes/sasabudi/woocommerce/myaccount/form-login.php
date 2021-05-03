<?php
/**
 * Login Form
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if( isset($_GET['action']) == 'register' ) {

    wc_get_template( 'myaccount/form-register-single.php' );

} else {

    wc_get_template( 'myaccount/form-login-single.php' );
    
}