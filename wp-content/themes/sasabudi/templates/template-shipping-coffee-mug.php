<?php
/**
 * The template part for the product single page 'coffe mugs'
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

$quality_url  = ent2ncr('<img src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-printed-just-fo-you.png" alt="Printed Just for You" />');

echo '<aside class="wc-tab-description">';

  echo '<h3>' . esc_html__( 'Product Shipping', 'sasabudi' ) . '</h3>';

  echo '<p>';
    printf(__('%s - just for you! Please allow %s business days for the manufacture time of your item.', 'sasabudi' ), '<strong>Every SASABUDI product is printed to order</strong>', '<strong>2-5</strong>' );
  echo '</p>';

  echo '<div class="shipping-details">';
    echo '<p>';
      printf(__('Usually, it takes %s days to fulfill an order, after which it’s shipped out. The shipping time depends on your location, but can be estimated as follows:', 'sasabudi' ), '<strong>3–7</strong>' );
    echo '</p>';
    echo '<ul>';
      echo '<li>' . esc_html__('USA: 3–4 business days', 'sasabudi') . '</li>';
      echo '<li>' . esc_html__('Europe: 6–8 business days', 'sasabudi') . '</li>';
      echo '<li>' . esc_html__('Australia: 2–14 business days', 'sasabudi') . '</li>';
      echo '<li>' . esc_html__('Japan: 4–8 business days', 'sasabudi') . '</li>';
      echo '<li>' . esc_html__('International: 10–20 business days', 'sasabudi') . '</li>';
    echo '</ul>';
    echo '<p class="shipping-alert">';
      printf(__('%s Our fulfillment times may be longer than usual and may continue to lengthen until things return to normal. We are seeing delays in our supply chain, including distributors and carriers, as the entire industry struggles with challenges.', 'sasabudi' ), '<strong class="alert">[Covid-19]​</strong>' );
    echo '</p>';
  echo '</div>';

  echo '<div class="shipping-partners">';
    echo '<p>' . esc_html__( 'We deliver to you with the following partners:', 'sasabudi' ) . '</p>';
    echo '<ul>';
      echo '<li><img src="' . get_theme_file_uri("/images/shipping-fedex.png") . '" width="100%" height="100%" alt="fedex" title="Fedex" /></li>';
      echo '<li><img src="' . get_theme_file_uri("/images/shipping-usps.svg") . '" width="100%" height="100%" alt="usp" title="USP" /></li>';
      echo '<li><img src="' . get_theme_file_uri("/images/shipping-dhl.svg") . '" width="100%" height="100%" alt="dhp" title="DHP" /></li>';
      echo '<li><img src="' . get_theme_file_uri("/images/shipping-dpd.svg") . '" width="100%" height="100%" alt="dpd" title="DPD" /></li>';
    echo '</ul>';
  echo '</div>';

  echo '<div class="made-to-order">';
    echo '<div class="made-to-order__left">' . $quality_url . '</div>';
    echo '<div class="made-to-order__right">' . __( 'Every SASABUDI product is printed to order - just for you!<br/>Printed in the USA, Europe, Japan and Australia at the highest quality standards.', 'sasabudi' ) . '</div>';
  echo '</div>';

echo '</aside>';

echo '<aside class="wc-tab-shipping">';
  echo '<div class="tab-shipping lazy-bg" style="background-image: url(https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png)" width="100%" heigth="100%" alt="" data-src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-shipping-banner.jpg"></div>';
echo '</aside>';
