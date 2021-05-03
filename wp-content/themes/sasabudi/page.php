<?php
/**
 * The template for displaying the page section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main" role="main">';
    echo '<div class="container">';
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    echo '</div>';
  echo '</main>';

get_footer();