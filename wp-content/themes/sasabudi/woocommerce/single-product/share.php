<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

// Set Title & Description
$product_id 	= $post->ID;
$posttitle 		= get_the_title();
$postcontent 	= get_the_excerpt();
$media 				= '';
$hashtag1 		= '#sasabudi';
$hashtag2 		= '#wealllovemugs';
$shortlink 		= get_permalink();

if (has_post_thumbnail( $product_id )) {
	$post_thumbnail_id = get_post_thumbnail_id( $product_id );
	$first_image = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );
	if (isset( $first_image )) {
		$media = $first_image[0];
	}   
}

do_action( 'woocommerce_share' ); // Sharing plugins can hook into here

echo '<div class="product-share">';
	echo '<div class="product-share__social">';
		echo '<ul>';
			?>
			<li class="is-share"><?php echo esc_html_e('Share: ', 'sasabudi'); ?></li>
			<li><a href="<?php echo sasabudi_share_link('facebook', $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2) ?>" target="_blank" class="share-btn facebook" title="Share on Facebook" rel="nofollow noreferrer"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg></a></li>
			<li><a href="<?php echo sasabudi_share_link('twitter', $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2) ?>" target="_blank" class="share-btn twitter" title="Share on Twitter" rel="nofollow noreferrer"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg></a></li>
			<li><a href="<?php echo sasabudi_share_link('pinterest', $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2) ?>" target="_blank" class="share-btn pinterest" title="Share on Pinterest" rel="nofollow noreferrer" data-pin-do="none"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"></path></svg></a></li>
			<li><a href="<?php echo sasabudi_share_link('buffer', $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2) ?>" target="_blank" class="share-btn buffer" title="Share on Buffer" rel="nofollow noreferrer"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M427.84 380.67l-196.5 97.82a18.6 18.6 0 0 1-14.67 0L20.16 380.67c-4-2-4-5.28 0-7.29L67.22 350a18.65 18.65 0 0 1 14.69 0l134.76 67a18.51 18.51 0 0 0 14.67 0l134.76-67a18.62 18.62 0 0 1 14.68 0l47.06 23.43c4.05 1.96 4.05 5.24 0 7.24zm0-136.53l-47.06-23.43a18.62 18.62 0 0 0-14.68 0l-134.76 67.08a18.68 18.68 0 0 1-14.67 0L81.91 220.71a18.65 18.65 0 0 0-14.69 0l-47.06 23.43c-4 2-4 5.29 0 7.31l196.51 97.8a18.6 18.6 0 0 0 14.67 0l196.5-97.8c4.05-2.02 4.05-5.3 0-7.31zM20.16 130.42l196.5 90.29a20.08 20.08 0 0 0 14.67 0l196.51-90.29c4-1.86 4-4.89 0-6.74L231.33 33.4a19.88 19.88 0 0 0-14.67 0l-196.5 90.28c-4.05 1.85-4.05 4.88 0 6.74z"></path></svg></a></li>
			<li><a href="<?php echo sasabudi_share_link('messenger', $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2) ?>" target="_blank" class="share-btn messenger" title="Share on FB Messenger" rel="nofollow noreferrer"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12,0C5.4,0,0,5,0,11.1c0,3.5,1.7,6.6,4.5,8.7V24l4.1-2.2c1.1,0.3,2.2,0.5,3.4,0.5c6.6,0,12-5,12-11.1C24,5,18.6,0,12,0z M13.2,15l-3.1-3.3l-6,3.3l6.6-7l3.1,3.3L19.8,8C19.8,8,13.2,15,13.2,15z"></path></svg></a></li>
			<li><a href="<?php echo sasabudi_share_link('whatsapp', $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2) ?>" target="_blank" class="share-btn whatsapp" title="Share on Whatsapp" rel="nofollow noreferrer"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M0.1,24l1.7-6.2c-1-1.8-1.6-3.8-1.6-5.9C0.2,5.3,5.5,0,12,0c3.2,0,6.2,1.2,8.4,3.5c2.2,2.2,3.5,5.2,3.5,8.4c0,6.6-5.3,11.9-11.9,11.9c-2,0-4-0.5-5.7-1.4C6.4,22.3,0.1,24,0.1,24z M6.7,20.2c1.7,1,3.3,1.6,5.4,1.6c5.4,0,9.9-4.4,9.9-9.9c0-5.5-4.4-9.9-9.9-9.9c-5.5,0-9.9,4.4-9.9,9.9c0,2.2,0.7,3.9,1.7,5.6l-1,3.6C2.9,21.2,6.7,20.2,6.7,20.2zM18,14.7c-0.1-0.1-0.3-0.2-0.6-0.3c-0.3-0.1-1.8-0.9-2-1c-0.3-0.1-0.5-0.1-0.7,0.1c-0.2,0.3-0.8,1-0.9,1.2s-0.3,0.2-0.6,0.1c-0.3-0.1-1.3-0.5-2.4-1.5c-0.9-0.8-1.5-1.8-1.7-2.1c-0.2-0.3,0-0.5,0.1-0.6c0.1-0.1,0.3-0.3,0.4-0.5C9.9,10,9.9,9.8,10,9.6c0.1-0.2,0.1-0.4,0-0.5C9.9,9,9.3,7.5,9.1,6.9C8.8,6.3,8.6,6.4,8.4,6.4l-0.6,0C7.6,6.4,7.3,6.5,7,6.8s-1,1-1,2.5s1.1,2.9,1.2,3.1c0.1,0.2,2.1,3.2,5.1,4.5c0.7,0.3,1.3,0.5,1.7,0.6c0.7,0.2,1.4,0.2,1.9,0.1c0.6-0.1,1.8-0.7,2-1.4C18.1,15.4,18.1,14.9,18,14.7z"></path></svg></a></li>	
			<li><a href="<?php echo sasabudi_share_link('email', $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2) ?>" target="_self" class="share-btn email" title="Share with Email" rel="nofollow noreferrer"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentcolor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg></a></li>
			<?php
		echo '</ul>';
	echo '</div>';
echo '</div>';





/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
