<?php
/**
 * The template part for the 'cookies' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="policy-content__title">' . esc_html__( 'Cookie Policy', 'sasabudi' ) . '</h1>';

echo '<section class="policy-section">';

  echo '<h2 class="policy-section__title">' . esc_html__( 'Cookie Policy', 'sasabudi' ) . '</h2>';

  echo do_shortcode('[cmplz-document type="cookie-statement" region="ca"]');

echo '</section>';
