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

  echo '<main class="main">';

    /**
     * @hooked :: sasabudi_page_collection_single - 10
     */
    do_action( 'sasabudi_render_collections_single' );

    /**
     * DataLayer - Custom :: Collection
     */
    $collection_name = get_field('ws_collection_title');
    ?>

    <script>
     dataLayer.push({
      'custom' : 'Collection',
      'collection_name' : '<?php echo $collection_name ?>'
     });
    </script>

  <?php
  
  echo '</main>';

get_footer();
