<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

echo '<section class="woocommerce-order-downloads">';

	if ( isset( $show_title ) ) :
		echo '<h2 class="woocommerce-order-downloads__title">' . esc_html__( 'Downloads', 'sasabudi' ) . '</h2>';
	endif;

	echo '<table class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details">';
		
		echo '<thead>';
			echo '<tr>';
				foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) :
					echo '<th class="' . esc_attr( $column_id ) . '"><span class="nobr">' . esc_html( $column_name ) . '</span></th>';
				endforeach;
			echo '</tr>';
		echo '</thead>';
		
		foreach ( $downloads as $download ) :
			echo '<tr>';
				foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) :
					echo '<td class="' . esc_attr( $column_id ) . '" data-title="' . esc_attr( $column_name ) . '">';
						if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
							do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
						} else {
							switch ( $column_id ) {
								case 'download-product':
									if ( $download['product_url'] ) {
										echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
									} else {
										echo esc_html( $download['product_name'] );
									}
									break;
								case 'download-file':
									// download link class changed
									echo '<a href="' . esc_url( $download['download_url'] ) . '" class="link-download">' . esc_html( $download['download_name'] ) . '</a>';
									break;
								case 'download-remaining':
									echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'sasabudi' );
									break;
								case 'download-expires':
									if ( ! empty( $download['access_expires'] ) ) {
										echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
									} else {
										esc_html_e( 'Never', 'sasabudi' );
									}
									break;
							}
						}
					echo '</td>';
				endforeach;
			echo '</tr>';
		endforeach;

	echo '</table>';

echo '</section>';

