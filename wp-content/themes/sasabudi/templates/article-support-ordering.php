<?php
/**
 * The template part for the 'ordering' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

/**
 * Support Ordering
 */
echo '<h1 class="support-content__title">';
  echo esc_html__( 'Ordering', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( 'Product Ordering', 'sasabudi' ) . '</h2>';

  echo '<div id="tab-faq" class="support-faq" role="tablist">';
  
    /**
     * Question 01
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How to place an order on our website?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'To place your order, simply select the items you want, choose the model of your choice, color and size, then add them to the cart.', 'sasabudi');
          echo '</p>';
          echo '<p>';
            echo esc_html__( 'You can access and edit your shopping cart at any time. The validity of your shopping cart is 14   days. When you have finished shopping, go back to your shopping cart and click „Proceed to Checkout".', 'sasabudi' ); 
          echo '</p>';
          echo '<p>';
            echo esc_html__( 'On the checkout page, please fill in the required fields and choose between PayPal and Credit Card as your preferred payment method. Then click either „Proceed to PayPal" or "Pay and place order".', 'sasabudi' ); 
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'Once your order is completed, you will receive a confirmation email. However, if you do not receive the confirmation email, please check your inbox and spam folder.', 'sasabudi' ); 
          echo '</p>';  
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 02
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'I have not received an order confirmation!', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'If you placed an order with us but did not receive an order confirmation email, please check your inbox and spam folder. However, it is also possible that your email address was entered incorrectly.', 'sasabudi' ); 
          echo '</p>';  
          echo '<p class="ending">';
            printf(esc_html__( '%s us to find out if we received an order on your behalf. We will be happy to change the email address for you and send you the order confirmation.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/contact/')) . '">Contact</a>');
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 03
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Can I edit/cancel my order after I placed it?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'Unfortunately, you can\'t. Once your order is placed and imported into our system, we have no way to edit it or make changes for you.', 'sasabudi' ); 
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'We are very quick with fulfilling and processing your order and therefore cannot cancel it before it is shipped. However, you are always welcome to return your order to us if you do not wish to keep it.', 'sasabudi' ); 
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 04
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How can I see the status of my order?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            printf(esc_html__( 'If you were logged in to your account when you placed your order, you can go to %s at any time to check the status of your orders. There you will find the history of your orders and the current status of each order.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('my-account/orders/')) . '">My Account</a>');
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';


    /**
     * Question 05
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Where can I find the invoice for my order?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'After the completion of your transaction, you will automatically receive an invoice by email. For international orders, a copy of the invoice for customs is also included in the package.', 'sasabudi' ); 
          echo '</p>';
          echo '<p class="starting ending">';
            printf(esc_html__( 'If you were logged into your account when you placed your order, you can also %s and download the invoice under your orders.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('my-account/orders/')) . '">view</a>');
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 06
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How can I track my order?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'Once your order has been shipped, you will receive a shipping confirmation. In this you will find a link to the delivery company\'s website where you can track your order. Note that our delivery times are based on business days, so do not include weekends.', 'sasabudi' ); 
          echo '</p>';
          echo '<p class="ending">';
            printf(esc_html__( 'Keep in mind that it can take up to %s hours after receiving the shipping confirmation for the tracking to be updated.', 'sasabudi' ), '<strong>24-48</strong>'); 
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

  echo '</div>';
echo '</section>';