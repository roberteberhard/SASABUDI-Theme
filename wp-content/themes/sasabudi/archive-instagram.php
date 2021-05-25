<?php
/**
 * The template for displaying the archive collection page.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main">';

    /**
     * @hooked sasabudi_page_instagram_archive - 10
     */
    do_action( 'sasabudi_render_instagram_archive' );

  echo '</main>';

get_footer();