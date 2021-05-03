<?php
/**
 * The template for displaying the single collections page.
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main" role="main">';

    /**
     * @hooked :: sasabudi_page_collection_single - 10
     */
    do_action( 'sasabudi_render_collections_single' );

  echo '</main>';

get_footer();
