<?php
/**
 * The template part for the 'policy' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="policy-content__title">';
  echo esc_html__( 'Legal Notice', 'sasabudi' );
echo '</h1>';

echo '<section class="policy-section">';

  echo '<h2 class="policy-section__title">' . esc_html__( 'Impressum', 'sasabudi' ) . '</h2>';

  echo do_shortcode('[cmplz-document type="impressum" region="eu"]');

echo '</section>';
