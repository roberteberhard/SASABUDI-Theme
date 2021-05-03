
<?php
/**
 * The template part for the 'payment' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="support-content__title">';
  echo esc_html__( 'Payment', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( 'Product Payment', 'sasabudi' ) . '</h2>';

  echo '<div class="support-faq" role="tablist">';


    /**
     * Question 01
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'In which currency are the products listed?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'All our products are listed in US Dollars.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 02
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Can I pay by invoice?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'No, unfortunately it is not possible to choose invoice as a payment method.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 03
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'What payment methods are accepted?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'Depending on which country you are from, you have the choice between one of the following payment methods:', 'sasabudi' );
          echo '</p>';
          echo '<p>';
            echo esc_html__( 'Pay Pal', 'sasabudi' );
          echo '</p>';
          echo '<p>';
            echo esc_html__( 'Credit card, in general:', 'sasabudi' );
          echo '</p>';
          echo '<ol class="ending">';
            echo '<li>' . esc_html__( 'VISA', 'sasabudi' ) . '</li>';
            echo '<li>' . esc_html__( 'VISA Debit', 'sasabudi' ) . '</li>';
            echo '<li>' . esc_html__( 'MasterCard', 'sasabudi' ) . '</li>';
            echo '<li>' . esc_html__( 'Discover', 'sasabudi' ) . '</li>';
            echo '<li>' . esc_html__( 'JCB', 'sasabudi' ) . '</li>';
            echo '<li class="ending">' . esc_html__( 'American Express', 'sasabudi' ) . '</li>';
          echo '</ol>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
    * Question 04
    */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Why was my credit card payment declined?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'There can be several reasons why a credit card payment is declined. For example, a typo, an invalid card, lack of verification or a technical error on our website.', 'sasabudi' );
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'Alternatively, you can try to make the payment using the following payment method: PayPal', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 05
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Will I receive a confirmation after the payment?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'If you have chosen PayPal or credit card as your payment method, the order will be completed only after you have successfully gone through the payment process. A payment confirmation will be displayed immediately in your browser when the whole process is completed.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';  
 
    /**
     * Question 06
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'When and how will I receive my invoice?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'You will receive an invoice by email once all ordered items have been shipped.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';   

    /**
     * Question 07
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'What are the customs fees for international orders?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
        echo esc_html__( 'Good question!  International orders may be subject to an additional customs and tax fee. This fee is out of our control and will be charged by your local customs office. Customs policies are very different for each country.', 'sasabudi' );
        echo '</p>';
        echo '<p>';
          echo esc_html__( 'Please check directly with your local customs office to see if they charge duties and taxes on your purchases.', 'sasabudi' );
        echo '</p>';
        echo '<p class="ending">';
          echo esc_html__( 'We are not responsible for any additional fees that may be applied after completing a purchase on sasabudi.com.', 'sasabudi' );
        echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

  echo '</div>';
echo '</section>';
