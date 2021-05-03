
<?php
/**
 * The template part for the 'hashtag' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="support-content__title">';
  echo esc_html__( 'Hashtag', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( '#SASABUDI', 'sasabudi' ) . '</h2>';

  echo '<div class="support-faq" role="tablist">';

    /**
     * Question 01
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Send us your selfies', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            printf(__( ' Send us your selfies or tag us on Instagram with our product in your photos for a chance to be featured in our gallery %1$s.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url('https://www.instagram.com/sasabudi/') . '" target="_blank">@sasabudi</a>');
            echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 02
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Use of the hashtag #SASABUDI on social media', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p>';
            printf(__( 'If you use the hashtag %1$s on your social media in the form of a static post or story, we reserve the right to eventually repost those images on our own social media accounts. We will always clearly state that the image is a repost and does not belong to us.', 'sasabudi' ), '<strong>#SASABUDI</strong>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
   echo '</div>';

  echo '</div>';
echo '</section>';
