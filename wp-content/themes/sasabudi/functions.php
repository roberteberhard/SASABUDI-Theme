<?php

if( ! defined( 'ABSPATH' ) ) exit;

// Theme setup
include_once( get_template_directory() . '/functions/theme/theme-helpers.php' );
include_once( get_template_directory() . '/functions/theme/theme-setup.php' );
include_once( get_template_directory() . '/functions/theme/theme-styles.php' );
include_once( get_template_directory() . '/functions/theme/theme-scripts.php' );

// Admin login
include_once( get_template_directory() . '/inc/login/admin-login.php' );

// WordPress
include_once( get_template_directory() . '/functions/wordpress/actions.php' );
include_once( get_template_directory() . '/functions/wordpress/filters.php' );
include_once( get_template_directory() . '/functions/wordpress/contact-form.php' );
include_once( get_template_directory() . '/functions/wordpress/sendy-form.php' );
include_once( get_template_directory() . '/functions/wordpress/post-types.php' );
include_once( get_template_directory() . '/functions/wordpress/walker.php' );
include_once( get_template_directory() . '/functions/wordpress/maintenance.php' );
include_once( get_template_directory() . '/functions/wordpress/pinterest.php' );

// WooCommerce
if( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/woocommerce/actions.php' );
	include_once( get_template_directory() . '/functions/plugins/woocommerce/filters.php' );
	include_once( get_template_directory() . '/functions/plugins/woocommerce/custom.php' );
	include_once( get_template_directory() . '/functions/plugins/woocommerce/search.php' );
	include_once( get_template_directory() . '/functions/plugins/woocommerce/wishlist.php' );
	include_once( get_template_directory() . '/functions/plugins/woocommerce/account_wishlist.php' );
	include_once( get_template_directory() . '/inc/woocommerce/woocommerce.php' );
}

// Metaboxes
include_once( get_template_directory() . '/inc/metaboxes/product.php' );
include_once( get_template_directory() . '/inc/metaboxes/collections.php' );

// Hooks
include_once( get_template_directory() . '/inc/structure/hooks.php' );
include_once( get_template_directory() . '/inc/structure/header.php' );
include_once( get_template_directory() . '/inc/structure/home.php' );
include_once( get_template_directory() . '/inc/structure/footer.php' );
include_once( get_template_directory() . '/inc/structure/offset.php' );
include_once( get_template_directory() . '/inc/structure/blog.php' );
include_once( get_template_directory() . '/inc/structure/catalog.php' );
include_once( get_template_directory() . '/inc/structure/collections.php' );
include_once( get_template_directory() . '/inc/structure/instagram.php' );

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woothemes/theme-customisations
 */
