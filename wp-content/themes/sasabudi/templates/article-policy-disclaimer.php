<?php
/**
 * The template part for the 'policy' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="policy-content__title">';
  echo esc_html__( 'Disclaimer', 'sasabudi' );
echo '</h1>';

echo '<section class="policy-section">';

  echo '<h2 class="policy-section__title">' . esc_html__( 'Disclaimer', 'sasabudi' ) . '</h2>';

  echo do_shortcode('[cmplz-document type="disclaimer" region="all"]');

echo '</section>';
