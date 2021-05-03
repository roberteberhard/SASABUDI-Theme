<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) :

	echo '<div class="woocommerce-tabs wc-tabs-wrapper">';
	
		// Tabs Content
		echo '<div class="tabs-content">';
			echo '<ul class="tabs wc-tabs" role="tablist">';
				foreach ( $product_tabs as $key => $product_tab ) :
					echo '<li class="' . esc_attr( $key ) . '_tab" id="tab-title-' . esc_attr( $key ) .'" role="tab" aria-controls="tab-' . esc_attr( $key ) . '">';
						echo '<a href="#tab-' . esc_attr( $key ) . '">' . wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ) ) . '</a>';
					echo '</li>';
				endforeach; 
			echo '</ul>';
		echo '</div>';

		// Tabs Content
		echo '<div class="tabs-panel-wrapper">';
			echo '<div class="tabs-panel-content">';
				foreach ( $product_tabs as $key => $product_tab ) :
					echo '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--' . esc_attr( $key ) . ' panel entry-content wc-tab" id="tab-' . esc_attr( $key ) . '" role="tabpanel" aria-labelledby="tab-title-' . esc_attr( $key ) . '">';
						if ( isset( $product_tab['callback'] ) ) { 
							call_user_func( $product_tab['callback'], $key, $product_tab );
						}
					echo '</div>';
				endforeach;
			echo '</div>';
		echo '</div>';

		/*
		 * Hook :: Product after tabs
		 */	
		do_action( 'woocommerce_product_after_tabs' );
		
	echo '</div>';

endif;