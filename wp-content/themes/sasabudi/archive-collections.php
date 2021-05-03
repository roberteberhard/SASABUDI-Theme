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

  echo '<main class="main" role="main">';

    /**   
     * @hooked sasabudi_page_collections_archive - 10
     */
    do_action( 'sasabudi_render_collections_archive' );	

  echo '</main>';

get_footer();
