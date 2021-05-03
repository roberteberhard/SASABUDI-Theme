<?php
/**
 * The template part for the 'return' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="support-content__title">';
  echo esc_html__( 'Returns', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( 'Product Returns / Claims', 'sasabudi' ) . '</h2>';
  
  echo '<div class="support-faq" role="tablist">';

    /**
     * Question 01
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How can I return my order?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ">';
            echo esc_html__( 'If you receive an item that you are not completely satisfied with, let us know! We accept unused products purchased from sasabudi.com for a refund within 30 days of purchase.', 'sasabudi' );
          echo '</p>';
          echo '<p>';
            printf(esc_html__( 'Write to us at %s with your order number and all other details and tell us what you are unhappy with. You will then receive an email with instructions and address information. You are responsible for postage and shipping costs and your return package must be well protected.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url('mailto:support@sasabudi.com') . '">support@sasabudi.com</a>');
          echo '</p>';
          echo '<p>';
            echo esc_html__( 'The product must be sent via a postal system that allows tracking. Once we receive and approve your returned items, your refund will be returned to the original form of payment.', 'sasabudi' );
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'Please note all items marked as final sale are not eligible for a refund or exchange.', 'sasabudi' );
          echo '</p>'; 
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 02
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How do I Exhange a product?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'Unfortunately, we currently do not offer exchanges at the moment, so you will need to return your items and place a new order.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 03
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'What should I do if a product is damaged or incorrect?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            printf( esc_html__( 'We are very sorry if the product you ordered arrived damaged or incorrect. So that we can quickly fix this for you, please email us at %s within a week with photos of the damaged product, your order number and any other details you have about your order.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url('mailto:support@sasabudi.com') . '">support@sasabudi.com</a>');
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'After that, we will be happy to send you a replacement free of charge.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 04
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Do I need to return the damaged product I received?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'You do not need to return a damaged or incorrect product to us. Read more about how you do a claim under the question “What should I do if a product is damaged or incorrect?”.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 05
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Do I have to pay for the return?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'Unfortunately, yes. Unless your order was damaged during processing or was incorrect, you are responsible for postage and shipping costs and your return package must be well protected.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 06
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'When will I receive my refund?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            printf(esc_html__( 'You can expect to receive a refund to your original form of payment within %1s days of delivery. Once you have received your refund notification, please allow an additional %2s days for your bank provider to post the amount to your account.', 'sasabudi' ), '<strong>5-10</strong>', '<strong>3-5  </strong>');
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'Please note that we must have received the return of your order or a shipping receipt before we can issue a refund.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';
    
  echo '</div>';  
echo '</section>';