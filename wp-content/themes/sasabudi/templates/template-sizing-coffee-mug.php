<?php
/**
 * The template part for the product single page 'coffe mugs'
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */


global $product;


$image_id     = $product->get_image_id();
$image_url    = '';
$sizing_url   = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-coffee-mug-small-size.png" alt="Coffee Mug Sizing Template" title="Coffee Mug Sizing Template" />');
$quality_url  = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-printed-just-fo-you.png" alt="Printed Just for You" title="" />');

if ( $image_id ) {
  $image_url = ent2ncr('<img src="' . wp_get_attachment_image_src( $image_id, 'medium' )[0] . '" />');
}

echo '<aside class="wc-tab-description">';

  echo '<h3>' . esc_html__( 'Product Sizing', 'sasabudi' ) . '</h3>';

  echo '<p>';
    printf(__( '%s and handle. Delivered in protective packaging. Dishwasher and microwave safe.', 'sasabudi' ), '<strong>Ceramic Coffee Mug with a printed design</strong>' );
  echo '</p>';

  echo '<div class="sizing-details">';

    echo '<div class="sizing-details__left">';
      echo '<div class="sizing-box">';
        echo '<table>';
          echo '<tr>';
            echo '<td><span class="sixing-box__title">' . esc_html__( 'Product', 'sasabudi' ) . '</span></td>';
            echo '<td><span class="sixing-box__title  sixing-box__text"">' . esc_html__( 'Coffee Mug 11oz', 'sasabudi' ) . '</span></td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td><span class="sixing-box__title">' . esc_html__( 'Dimensions', 'sasabudi' ) . '</span></td>';
            echo '<td>' . esc_html__( '(h) 3.85" / 9.8cm', 'sasabudi' ) . '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td></td>';
            echo '<td><span class="sixing-box__text">' . esc_html__( '(Ø) 3.35" / 8.5cm', 'sasabudi' ) . '</span></td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td><span class="sixing-box__title">' . esc_html__( 'Capacity', 'sasabudi' ) . '</span></td>';
            echo '<td><span class="sixing-box__text">' . esc_html__( '300ml', 'sasabudi' ) . '</span></td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td><span class="sixing-box__title">' . esc_html__( 'Material', 'sasabudi' ) . '</span></td>';
            echo '<td><span class="sixing-box__text">' . esc_html__( 'Ceramic', 'sasabudi' ) . '</span></td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td><span class="sixing-box__title">' . esc_html__( 'Care', 'sasabudi' ) . '</span></td>';
            echo '<td>' . esc_html__( 'Dishwasher and microwave safe', 'sasabudi' ) . '</td>';
          echo '</tr>';
        echo '</table>';
      echo '</div>'; 
    echo '</div>'; 

    echo '<div class="sizing-details__right">';
      echo '<div class="sizing-box">';

      echo '<table>';
        echo '<tr>';
          echo '<td><span class="sixing-box__title">' . esc_html__( 'Product', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sixing-box__title sixing-box__text">' . esc_html__( 'Coffee Mug 15oz', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sixing-box__title">' . esc_html__( 'Dimensions', 'sasabudi' ) . '</span></td>';
          echo '<td>' . esc_html__( '(h) 4.7" / 12cm', 'sasabudi' ) . '</td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td></td>';
          echo '<td><span class="sixing-box__text">' . esc_html__( '(Ø) 3.35" / 8.5cm', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sixing-box__title">' . esc_html__( 'Capacity', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sixing-box__text">' . esc_html__( '420ml', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
          echo '<td><span class="sixing-box__title">' . esc_html__( 'Material', 'sasabudi' ) . '</span></td>';
          echo '<td><span class="sixing-box__text">' . esc_html__( 'Ceramic', 'sasabudi' ) . '</span></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><span class="sixing-box__title">' . esc_html__( 'Care', 'sasabudi' ) . '</span></td>';
        echo '<td>' . esc_html__( 'Dishwasher and microwave safe', 'sasabudi' ) . '</td>';
      echo '</tr>';
      echo '</table>';

      echo '</div>'; 
    echo '</div>'; 

  echo '</div>'; 

  echo '<div class="made-to-order">';
    echo '<div class="made-to-order__left">' . $quality_url . '</div>';
    echo '<div class="made-to-order__right">' . __( 'Every SASABUDI product is printed to order - just for you!<br/>Printed in the USA, Europe, Japan and Australia at the highest quality standards.', 'sasabudi' ) . '</div>';
  echo '</div>';

echo '</aside>';

echo '<aside class="wc-tab-sizing">';
  echo '<div class="tab-sizing">';
    echo '<div class="tab-sizing__smallsize">' . $sizing_url . '</div>';
    echo '<div class="tab-sizing__smallmug">' . $image_url . '</div>';
  echo '</div>';
echo '</aside>';
