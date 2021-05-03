<?php
/**
 * Email Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';
?>
<h2 class="woocommerce-order-downloads__title" style="font-family:'Helvetica',Arial,Verdana,sans-serif;color:#202020;font-size:20px;">
	<?php esc_html_e( 'Downloads', 'woocommerce' ); ?>
</h2>

<table class="td" cellspacing="0" cellpadding="6" style="padding:0px; width: 100%; font-family:'Helvetica',Arial,Verdana,sans-serif; color:#202020; font-size:14px; border: 1px solid #e5e5e5; vertical-align: middle;">
	<thead>
		<tr>
			<?php foreach ( $columns as $column_id => $column_name ) : ?>
				<th class="td" scope="col" style="padding: 10px; text-align:<?php echo esc_attr( $text_align ); ?>; font-family:'Helvetica',Arial,Verdana,sans-serif; color:#202020; font-size:14px; border: 1px solid #e5e5e5;"><?php echo esc_html( $column_name ); ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>

	<?php foreach ( $downloads as $download ) : ?>
		<tr>
			<?php foreach ( $columns as $column_id => $column_name ) : ?>
				<td class="td" style="padding: 10px; text-align:<?php echo esc_attr( $text_align ); ?>; font-family:'Helvetica',Arial,Verdana,sans-serif; color:#202020; font-size:14px; border: 1px solid #e5e5e5;">
					<?php
					if ( has_action( 'woocommerce_email_downloads_column_' . $column_id ) ) {
						do_action( 'woocommerce_email_downloads_column_' . $column_id, $download, $plain_text );
					} else {
						switch ( $column_id ) {
							case 'download-product':
								?>
								<a href="<?php echo esc_url( get_permalink( $download['product_id'] ) ); ?>"><?php echo wp_kses_post( $download['product_name'] ); ?></a>
								<?php
								break;
							case 'download-file':
								?>
								<a href="<?php echo esc_url( $download['download_url'] ); ?>" class="woocommerce-MyAccount-downloads-file button alt"><?php echo esc_html( $download['download_name'] ); ?></a>
								<?php
								break;
							case 'download-expires':
								if ( ! empty( $download['access_expires'] ) ) {
									?>
									<time datetime="<?php echo esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ); ?>" title="<?php echo esc_attr( strtotime( $download['access_expires'] ) ); ?>"><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ); ?></time>
									<?php
								} else {
									esc_html_e( 'Never', 'woocommerce' );
								}
								break;
						}
					}
					?>
				</td>
			<?php endforeach; ?>
		</tr>
	<?php endforeach; ?>
</table>
