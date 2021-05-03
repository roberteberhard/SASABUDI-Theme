<?php
/**
 * WP maintenance mode
 *
 * @package sasabudi
 */

// -----------------------------------------------------------------------------
// Change WordPress Sender Amail Addresss
// -----------------------------------------------------------------------------
function sasabudi_maintenance_mode() {

  // Page mode settings
  $mode = get_field('start_up_mode', 'option');

  if ($mode !== 'live_mode') {
    if (!current_user_can('edit_themes') || !is_user_logged_in()) {

      echo '<div class="maintenance">';
        echo '<section class="maintenance-section">';
          echo '<div class="maintenance-section__header">';
            if ($mode === 'coming_soon_mode') {
              echo '<h1><a href="' . esc_url(home_url()) . '" rel="home">' . get_bloginfo('name') . '</a></h1>';
              echo '<h2>' . esc_html__('Welcome to sasabudi.com', 'sasabudi') . '</h2>';
              echo '<p>' . esc_html__('Our new site is coming soon. Stay tuned!', 'sasabudi') . '</p>';
            }
            if ($mode === 'maintenance_mode') {
              echo '<h1><a href="' . esc_url(home_url()) . '" rel="home">' . get_bloginfo('name') . '</a></h1>';
              echo '<h2>' . esc_html__('Welcome to sasabudi.com', 'sasabudi') . '</h2>';
              echo '<p>' . esc_html__('Sorry, we\'re down for planned maintenance. Please check back later and thanks for your patience!', 'sasabudi') . '</p>';
            }
          echo '</div>';
          echo '<div class="maintenance-section__footer">';
            echo '<p>' . esc_html( apply_filters( 'sasabudi_copyright_text', $content = '© ' . date( 'Y' ) . ' sasabudi.com'  ) ) . '</p>';
          echo '</div>';
        echo '</section>';
      echo '</div>';

      // extras for closing the body
      wp_footer();
      echo '</body>';
      echo '</html>';

      die();
    }
  }
}