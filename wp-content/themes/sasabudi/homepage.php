<?php
/**
* The 'homepage' template file
*
* Template name: Homepage
*
* @package WordPress
* @subpackage SASABUDI
* @since 1.0.0
*/

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main">';
  
    /**
     * @hooked :: sasabudi_home_products_banner     - 10
     * @hooked :: sasabudi_home_products_statement  - 20
     * @hooked :: sasabudi_home_products_categories - 30
     * @hooked :: sasabudi_home_products_collection - 40
     * @hooked :: sasabudi_home_products_trending   - 50
     * @hooked :: sasabudi_home_artist_blog         - 60
     * @hooked :: sasabudi_home_instagram_feed      - 70
     */
    do_action( 'sasabudi_render_homepage_sections' ); 

  echo '</main>';

get_footer();
