<?php
/**
 * The template part for the 'size' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

$image_small      = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/mug-sizing-11oz.png" alt="Coffee Mug Sizing Template 11oz" title="Coffee Mug Sizing Template" />');
$image_large      = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/mug-sizing-15oz.png" alt="Coffee Mug Sizing Template 15oz" title="Coffee Mug Sizing Template" />');
$template_small   = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-coffee-mug-sizing-small.png" alt="Coffee Mug Sizing 11oz" title="Coffee Mug Sizing 11oz" />');
$template_large   = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-coffee-mug-sizing-large.png" alt="Coffee Mug Sizing 15oz" title="Coffee Mug Sizing 15oz" />');
$quality_url      = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-printed-just-fo-you.png" alt="Printed Just for You" title="" />');
 
echo '<h1 class="support-content__title">';
  echo esc_html__( 'Size Guide', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section size-style">';

  echo '<h2 class="support-section__title">' . esc_html__( 'Product Sizing', 'sasabudi' ) . '</h2>';

  echo '<p class="size-style">';
    printf(__( '%s and handle. Delivered in protective packaging. Dishwasher and microwave safe.', 'sasabudi' ), '<strong>Ceramic Coffee Mug with a printed design</strong>' );
  echo '</p>';

  /**
   * Product Mug 11oz
   */
  echo '<div class="sizing-details">';

    echo '<div class="sizing-detail">';
      echo '<table>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title sizing-detail__text">' . esc_html__( 'Product', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Coffee Mug 11oz', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Dimensions', 'sasabudi' ) . '</span></td>';
          echo '<td>' . esc_html__( '(h) 3.85" / 9.8cm', 'sasabudi' ) . '</td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td></td>';
          echo '<td><span class="sizing-detail__text">' . esc_html__( '(Ø) 3.35" / 8.5cm', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Capacity', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sizing-detail__text">' . esc_html__( '300ml', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Material', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sizing-detail__text">' . esc_html__( 'Ceramic', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Care', 'sasabudi' ) . '</span></td>';
          echo '<td>' . esc_html__( 'Dishwasher and microwave safe', 'sasabudi' ) . '</td>';
        echo '</tr>';
      echo '</table>'; 
    echo '</div>';  

    echo '<div class="sizing-detail">';
      echo '<div class="size-image">' . $template_small . '</div>';
      echo '<div class="mug-image">' . $image_small . '</div>';
    echo '</div>';

  echo '</div>';

  /**
   * Product Mug 15oz
   */
  echo '<div class="sizing-details">';

    echo '<div class="sizing-detail">';
      echo '<table>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title sizing-detail__text">' . esc_html__( 'Product', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Coffee Mug 15oz', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Dimensions', 'sasabudi' ) . '</span></td>';
          echo '<td>' . esc_html__( '(h) 4.7" / 12cm', 'sasabudi' ) . '</td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td></td>';
          echo '<td><span class="sizing-detail__text">' . esc_html__( '(Ø) 3.35" / 8.5cm', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Capacity', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sizing-detail__text">' . esc_html__( '420ml', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Material', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sizing-detail__text">' . esc_html__( 'Ceramic', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sizing-detail__title">' . esc_html__( 'Care', 'sasabudi' ) . '</span></td>';
          echo '<td>' . esc_html__( 'Dishwasher and microwave safe', 'sasabudi' ) . '</td>';
        echo '</tr>';
      echo '</table>';
    echo '</div>';

    echo '<div class="sizing-detail">';
      echo '<div class="size-image">' . $template_large . '</div>';
      echo '<div class="mug-image">' . $image_large . '</div>';
    echo '</div>';

  echo '</div>';

  echo '<div class="made-to-order">';
    echo '<div class="made-to-order__left">' . $quality_url . '</div>';
    echo '<div class="made-to-order__right">' . __( 'Every SASABUDI product is printed to order - just for you!<br/>Printed in the USA, Europe, Japan and Australia at the highest quality standards.', 'sasabudi' ) . '</div>';
  echo '</div>';

echo '</section>';
