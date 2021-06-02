<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

$current_user = wp_get_current_user();
$message 			= esc_html( "Hi", "sasabudi" );
$welcome 			= esc_html__( 'welcome to your SASABUDI account.', 'sasabudi' );
if ( wc_shipping_enabled() ) {
	$welcome = esc_html__( 'welcome to your SASABUDI account.', 'sasabudi' );
}

// $first_name 	= esc_attr( $current_user->first_name );
// $last_name 		= esc_attr( $current_user->last_name );
// echo $message . ' , ' . $first_name . ' ' . $last_name . ' | <a href="' . esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) . '">' . __( 'Sign Out', 'sasabudi' ) . '</a>'; 


/* Dashboard title */
echo '<h1 class="account-content__title">';
  echo __( 'Dashboard', 'sasabudi' );
echo '</h1>';

/* Print notice here */
echo '<div class="woocommerce-notices-wrapper">';
  wc_print_notices();
echo '</div>';

echo '<div class="dashboard-welcome">';
	echo '<p class="dashboard-username">' . $message . ' <strong>' . esc_html( $current_user->display_name ) . '</strong>, ' . $welcome . '</p>';
	echo '<p>' . esc_html('Here you can view your recent orders, manage your billing address, and edit your password and account details.', 'sasabudi') . '</p>';
echo '</div>';

echo '<div class="dashboard-links">';
	echo '<div class="col">';
		echo '<a class="dashboard-link" href="' . esc_url( wc_get_endpoint_url( 'orders' ) ) . '">';
			echo '<h3>Orders</h3>';
			echo '<p>' . esc_html__('View your order history and access invoices.', 'sasabudi') . '</p>';
			echo '<span class="arrow-next"></span>';
		echo '</a>';
	echo '</div>';
	echo '<div class="col">';
		echo '<a class="dashboard-link" href="' . esc_url( wc_get_endpoint_url( 'edit-address' ) ) . '">';
			echo '<h3>Addresses</h3>';
			echo '<p>' . esc_html__('Manage your billing and shipping addresses.', 'sasabudi') . '</p>';
			echo '<span class="arrow-next"></span>';
		echo '</a>';
	echo '</div>';
	echo '<div class="col">';
		echo '<a class="dashboard-link" href="' . esc_url( wc_get_endpoint_url( 'edit-account' ) ) . '">';
			echo '<h3>Settings</h3>';
			echo '<p>' . esc_html__('Manage your account details and password.', 'sasabudi') . '</p>';
			echo '<span class="arrow-next"></span>';
		echo '</a>';
	echo '</div>';
echo '</div>';

/**
 * DataLayer - Dashboard
 */
?>

<script>
dataLayer.push({
 'lead' : 'Dashboard'
});
</script>

<?php

/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );



/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
