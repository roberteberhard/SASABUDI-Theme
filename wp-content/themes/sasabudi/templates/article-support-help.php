<?php
/**
 * The template part for the 'help' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="support-content__title">';
  echo esc_html__( 'FAQs', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( 'How can we help you?', 'sasabudi' ) . '</h2>';

  /**
   * Support Links
   */
  echo '<div class="support-categories">';
    echo '<div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/contact')) . '">';
        echo '<h3>' . esc_html__( 'Contact', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';   
    echo ' <div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/ordering')) . '">';
        echo '<h3>' . esc_html__( 'Ordering', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';
    echo '<div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/shipping')) . '">';
        echo '<h3>' . esc_html__( 'Shipping / Delivery', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';
    echo '<div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/returns')) . '">';
        echo '<h3>' . esc_html__( 'Returns / Claim', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';
    echo ' <div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/payment')) . '">';
        echo '<h3>' . esc_html__( 'Payment', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';
    echo '<div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/promotions')) . '">';
        echo '<h3>' . esc_html__( 'Promotions', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';    
    echo '<div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/size-guide')) . '">';
        echo '<h3>' . esc_html__( 'Size Guide', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';
    echo '<div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/account')) . '">';
        echo '<h3>' . esc_html__( 'Account', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';
    echo '<div class="col">';
      echo '<a class="support-category" href="' . esc_url(home_url('/help/hashtag')) . '">';
        echo '<h3>' . esc_html__( '#SASABUDI', 'sasabudi' ) . '</h3>';
      echo '</a>';
    echo '</div>';   
  echo '</div>';

  echo '<p class="support-section__notice ending">';
    printf(esc_html__( 'Below you will find just a few of the %s we receive:', 'sasabudi' ), '<strong>frequently asked questions</strong>');
  echo '</p>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'In which currency are the products listed?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer ending">';
      echo esc_html__('All our products are listed in US Dollars.', 'sasabudi');
    echo '</p>';
  echo '</div>';
  
  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'How long will it take to manufacture?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer ending">';
      printf(esc_html__( 'Our products are custom made and individually printed at the time of order. Please allow %s business days for the manufacture time of your item.', 'sasabudi' ), '<strong>2-5</strong>');
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'Where will my order ship from?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer ending">';
      printf(esc_html__( 'We work with selected manufacturing partners in the  %1s, %2s, %3s and %4s. Depending on where you are located, your orders will be printed and shipped from the facility that can do it most efficiently!', 'sasabudi' ), '<strong>USA</strong>', '<strong>Europe</strong>', '<strong>Japan</strong>', '<strong>Australia</strong>');
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'How long does shipping take?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer">';
      echo esc_html__( 'Your estimated order arrival date = order fulfilment time + shipping time.', 'sasabudi' );
    echo '</p>';
    echo '<p class="support-notice__answer">';
      printf(esc_html__( '%1s Once you place your order, we will immediately send it to our production team who will have your order ready to ship within %2s business days.', 'sasabudi' ), '<strong>1. Fulfilment:</strong>', '<strong>2-5</strong>');
    echo '</p>';
    echo '<p class="support-notice__answer">';
      printf(esc_html__( '%1s Usually, it takes %2s days to fulfill an order, after which it\'s shipped out. The shipping time depends on your location, but can be estimated as follows:', 'sasabudi' ), '<strong>2. Shipping:</strong>', '<strong>3–7</strong>');
    echo '</p>';
    echo '<ol class="support-notice__answer">';
      echo '<li>';
        echo esc_html__( 'USA: 3–4 business days', 'sasabudi' );
      echo '</li>';
      echo '<li>';
        echo esc_html__( 'Europe: 6–8 business days', 'sasabudi' );
      echo '</li>';
      echo '<li>';
        echo esc_html__( 'Australia: 2–14 business days', 'sasabudi' );
      echo '</li>';
      echo '<li>';
        echo esc_html__( 'Japan: 4–8 business days', 'sasabudi' );
      echo '</li>';
      echo '<li class="ending">';
        echo esc_html__( 'International: 10–20 business days', 'sasabudi' );
      echo '</li>';
    echo '</ol>';
    echo '<p class="support-notice__answer">';
      printf(esc_html__('%s Our fulfillment times may be longer than usual and may continue to lengthen until things return to normal. We are seeing delays in our supply chain, including distributors and carriers, as the entire industry struggles with challenges.', 'sasabudi' ), '<strong class="alert">[Covid-19]​</strong>' );
    echo '</p>';
    echo '<p class="support-notice__answer ending">';
      echo esc_html__( 'Once your order has been processed, you will receive a shipping confirmation email with a tracking number.', 'sasabudi' );
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'What payment methods are accepted?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer">';
      echo esc_html__( 'Depending on which country you are from, you have the choice between one of the following payment methods:', 'sasabudi' );
    echo '</p>';
    echo '<ol class="support-notice__answer ending">';
      echo '<li>';
        echo esc_html__( 'Pay Pal', 'sasabudi' );
      echo '</li>';
      echo '<li>';
        echo esc_html__( 'Credit card', 'sasabudi' );
      echo '</li>';
    echo '</ol>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'How can I track my order?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer">';
      echo esc_html__( 'Once your order has been shipped, you will receive a shipping confirmation. In this you will find a link to the delivery company\'s website where you can track your order. Note that our delivery times are based on business days, so do not include weekends.', 'sasabudi' );
    echo '</p>';
    echo '<p class="support-notice__answer ending">';
      printf(esc_html__( 'Keep in mind that it can take up to %s hours after receiving the shipping confirmation for the tracking to be updated.', 'sasabudi' ), '<strong>24-48</strong>'); 
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'I have not received an order confirmation!', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer">';
      echo esc_html__( 'If you placed an order with us but did not receive an order confirmation email, please check your inbox and spam folder. However, it is also possible that your email address was entered incorrectly.', 'sasabudi' ); 
    echo '</p>';
    echo '<p class="support-notice__answer ending">';
      printf(esc_html__( '%s us to find out if we received an order on your behalf. We will be happy to change the email address for you and send you the order confirmation.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">Contact</a>');
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'Can I edit/cancel my order after I placed it?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer">';
      echo esc_html__( 'Unfortunately, you can\'t. Once your order is placed and imported into our system, we have no way to edit it or make changes for you.', 'sasabudi' );
    echo '</p>';
    echo '<p class="support-notice__answer ending">';
      echo esc_html__( 'We are very quick with fulfilling and processing your order and therefore cannot cancel it before it is shipped. However, you are always welcome to return your order to us if you do not wish to keep it.', 'sasabudi' );
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'My order should be arrived already, but I still don\'t have it. What should I do?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer ">';
      echo esc_html__( 'Before contacting us, please help us by doing the following:', 'sasabudi' ); 
    echo '</p>';
    echo '<ol class="support-notice__answer">';
      echo '<li>';
        echo esc_html__( 'Check your shipping confirmation email for any errors in the shipping address', 'sasabudi' );
      echo '</li>';
      echo '<li>';
        echo esc_html__( 'Ask your local post office if they have your package', 'sasabudi' );
      echo '</li>';
      echo '<li class="ending">';
        echo esc_html__( 'Check with your neighbors if the courier left the package with them', 'sasabudi' );
      echo '</li>';
    echo '</ol>';
    echo '<p class="support-notice__answer ">';
      printf( esc_html__( 'If the delivery address was correct and the package was not left at the post office or with a neighbor, %s us with your order number.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('help/contact/')) . '">contact</a>');
    echo '</p>';
    echo '<p class="support-notice__answer ending">';
      echo esc_html__( 'If you have found an error in your shipping address, we can send you a replacement order, but shipping will be at your own expense.', 'sasabudi' );
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'How can I return my order?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer">';
      echo esc_html__( 'If you receive an item that you are not completely satisfied with, let us know! We accept unused products purchased from sasabudi.com for a refund within 30 days of purchase.', 'sasabudi' );
    echo '</p>';
    echo '<p class="support-notice__answer">';
      printf(esc_html__( 'Write to us at %s with your order number and all other details and tell us what you are unhappy with. You will then receive an email with instructions and address information. You are responsible for postage and shipping costs and your return package must be well protected.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url('mailto:support@sasabudi.com') . '">support@sasabudi.com</a>');
    echo '</p>';
    echo '<p class="support-notice__answer">';
      echo esc_html__( 'The product must be sent via a postal system that allows tracking. Once we receive and approve your returned items, your refund will be returned to the original form of payment.', 'sasabudi' );
    echo '</p>';
    echo '<p class="support-notice__answer ending">';
      echo esc_html__( 'Please note all items marked as final sale are not eligible for a refund or exchange.', 'sasabudi' );
    echo '</p>';
  echo '</div>';

  echo '<div class="support-notice">';
    echo '<h3 class="support-notice__question">';
      echo esc_html__( 'What should I do if a product is damaged or incorrect?', 'sasabudi' );
    echo '</h3>';
    echo '<p class="support-notice__answer">';
      printf( esc_html__( 'We are very sorry if the product you ordered arrived damaged or incorrect. So that we can quickly fix this for you, please email us at %s within a week with photos of the damaged product, your order number and any other details you have about your order.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url('mailto:support@sasabudi.com') . '">support@sasabudi.com</a>');
    echo '</p>';
    echo '<p class="support-notice__answer ending">';
      echo esc_html__( 'After that, we will be happy to send you a replacement free of charge.', 'sasabudi' );
    echo '</p>';
  echo '</div>';

echo '</section>';
