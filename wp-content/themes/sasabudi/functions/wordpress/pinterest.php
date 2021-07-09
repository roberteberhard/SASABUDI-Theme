<?php
/**
 * WP Pinterest
 *
 * function to create sitemap_pinterest.xml file in root directory of site 
 *
 * @package sasabudi
 */
 
function sasabudi_create_pinterest_sitemap() {
  $productsForSitemap = get_posts( array(
    'numberposts' => -1,
    'orderby'     => 'modified',
    'post_status' => 'publish',
    'post_type'   => array( 'product' ),
    'orderby'     => 'date',
    'order'       => 'DESC'
  ));

  $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
  $sitemap .= "\n" . '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
  $sitemap .= "\n" . '<channel>' . "\n";

  foreach( $productsForSitemap as $item ) {

    $product_id = $item->ID;
    $product_title = $item->post_title;
    $product_description = $item->post_excerpt;
    $product_link = get_permalink($product_id);
    $product = wc_get_product( $product_id );

    // product category
    $product_terms = get_the_terms( $product_id, 'product_cat' );
    $product_cat = array();
    foreach ( $product_terms as $term ) { $product_cat[] = $term->name; }
    $categroy = array_merge(array_diff($product_cat, array('New Arrivals', 'On Our Radar'))); // Exclude categories
    $product_category = $categroy[0];

    // product attribute
    $product_attribute = '';
    if ($product_category == 'Mugs') {
      $attribute = $product->get_attribute( 'pa_model' );
      $product_attribute = $attribute == 'Coffee Mug' ? ' &gt; Coffee Mug' : '';
    }

    // product image
    $image_id  = $product->get_image_id();
    $product_imagelink = wp_get_attachment_image_url( $image_id, 'full' );

    $product_price = $product->get_price();
    $product_currency = get_woocommerce_currency();
    $product_condition = 'New';
    $product_availability = $product->is_in_stock() ? 'In Stock' : 'Out of Stock';
    $product_brand = 'SASABUDI';

    // sitemap
    $sitemap .= "\n" . '<item>';
    $sitemap .= "\n" . '<g:id>' . $product_id . '</g:id>';
    $sitemap .= "\n" . '<title>' . $product_title . '</title>';
    $sitemap .= "\n" . '<description>' . strip_tags_content($product_description) . '</description>';
    $sitemap .= "\n" . '<g:product_type>' . $product_category . '</g:product_type>';
    $sitemap .= "\n" . '<g:google_product_category>' . $product_category . $product_attribute . '</g:google_product_category>';
    $sitemap .= "\n" . '<link>' . $product_link . '</link>';
    $sitemap .= "\n" . '<g:image_link>' . $product_imagelink . '</g:image_link>';
    $sitemap .= "\n" . '<g:price>' . $product_price . ' ' . $product_currency . '</g:price>';
    $sitemap .= "\n" . '<g:condition>' . $product_condition . '</g:condition>';
    $sitemap .= "\n" . '<g:availability>' . $product_availability . '</g:availability>';
    $sitemap .= "\n" . '<g:brand>' . $product_brand . '</g:brand>';
    $sitemap .= "\n" . '</item>';
  }     

  $sitemap .= "\n" . '</channel>';
  $sitemap .= "\n" . '</rss>';
  $fp = fopen( ABSPATH . "sitemap_pinterest.xml", 'w' );
  fwrite( $fp, $sitemap );
  fclose( $fp );
}
add_action( "save_post", "sasabudi_create_pinterest_sitemap" );

function strip_tags_content($string) { 
  // ----- remove HTML TAGs ----- 
  $string = preg_replace ('/<[^>]*>/', ' ', $string); 
  // ----- remove control characters ----- 
  $string = str_replace("\r", '', $string);
  $string = str_replace("\n", ' ', $string);
  $string = str_replace("\t", ' ', $string);
  // ----- remove multiple spaces ----- 
  $string = trim(preg_replace('/ {2,}/', ' ', $string));
  // ----- remove emojis -----
  $string = preg_replace('~\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]~', '', $string);
  return $string; 
}