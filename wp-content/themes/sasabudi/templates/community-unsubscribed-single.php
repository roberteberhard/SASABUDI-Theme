<?php
/**
 * The template part for the 'community' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<div class="community">';
  echo '<aside class="community-figure">';
    the_post_thumbnail();
  echo '</aside>';
  echo '<aside class="community-message">';
    echo '<p class="community-heading">' . esc_html__('You have successfully unsubscribed from our newsletter.', 'sasabudi') . '</p>';
  echo '</aside>';
echo '</div>';