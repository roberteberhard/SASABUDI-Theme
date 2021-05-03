
<?php
/**
 * The template part for the 'promotions' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="support-content__title">';
  echo esc_html__( 'Promotions', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( 'Product Promotions', 'sasabudi' ) . '</h2>';

  echo '<div class="support-faq" role="tablist">';

    /**
     * Question 01
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Where do I enter my promo code?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'You can enter your promo code either in our shopping cart or on the checkout page. There you will see a discount code field. Enter your code there and click "Apply" to see the price reduction.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 02
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'What can I do if the promo code does not work?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            printf(esc_html__( 'First, check that the code does not contain any typos. Then, check the terms of the discount code to make sure that this offer is still valid and applies to the items in your cart. If the code still doesn\'t work, please %s us for assistance.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">contact</a>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 03
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Can I use more than one promo code for an order?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'Unfortunately not, only one promotional code can be applied per order.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 04
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'I placed an order but forgot to enter the promo code, what should I do?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            printf(esc_html__( 'If you placed an order during a promotional period and forgot to apply the code, please %s us and we will adjust the price of your order if it meets the terms of the promotion.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">contact</a>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 05
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'I signed up for the newsletter but I did not receive my 15% code. What can I do?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            printf(esc_html__( 'First, please check if the email address was entered correctly. Then check your spam and promotions folder to see if it landed there. If you still haven\'t received it, please %s us with the email address you entered and we will help you.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">contact</a>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 06
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Do you offer gift ordering options?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'Unfortunately, we do not offer gift options (including gift receipts, gift wrapping, or gift messages) at the moment.', 'sasabudi');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

  echo '</div>';
echo '</section>';
