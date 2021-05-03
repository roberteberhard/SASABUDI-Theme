<?php
/**
 * The template part for the 'shipping' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

/**
 * Support Shipping
 */
echo '<h1 class="support-content__title">';
  echo esc_html__( 'Shipping', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( 'Product Shipping / Delivery', 'sasabudi' ) . '</h2>';

  echo '<div id="tab-faq" class="support-faq" role="tablist">';

    /**
     * Question 01
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How long will it take to manufacture?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            printf(esc_html__( 'Our products are custom made and individually printed at the time of order. Please allow %s business days for the manufacture time of your item.', 'sasabudi' ), '<strong>2-5</strong>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';
    
    /**
     * Question 02
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Where do you ship to?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'We ship all our products worldwide except Cuba, Iran, Crimea, Syria and North Korea. This list may change periodically.', 'sasabudi' );
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'There are also some countries that we do not ship to at the moment due to courier service restrictions during the panedemic.', 'sasabudi' );
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 03
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Where will my order ship from?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            printf(esc_html__( 'We work with selected manufacturing partners in the  %1s, %2s, %3s and %4s. Depending on where you are located, your orders will be printed and shipped from the facility that can do it most efficiently!', 'sasabudi' ), '<strong>USA</strong>', '<strong>Europe</strong>', '<strong>Japan</strong>', '<strong>Australia</strong>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 04
     */  
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How long does shipping take?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'Your estimated order arrival date = order fulfilment time + shipping time.', 'sasabudi' );
          echo '</p>';
          echo '<p>';
            printf(esc_html__( '%1s Once you place your order, we will immediately send it to our production team who will have your order ready to ship within %2s business days.', 'sasabudi' ), '<strong>1. Fulfilment:</strong>', '<strong>2-5</strong>');
          echo '</p>';
          echo '<p>';
            printf(esc_html__( '%1s Usually, it takes %2s days to fulfill an order, after which it\'s shipped out. The shipping time depends on your location, but can be estimated as follows:', 'sasabudi' ), '<strong>2. Shipping:</strong>', '<strong>3–7</strong>');
          echo '</p>';
          echo '<ol>';
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
          echo '<p>';
            printf(esc_html__('%s Our fulfillment times may be longer than usual and may continue to lengthen until things return to normal. We are seeing delays in our supply chain, including distributors and carriers, as the entire industry struggles with challenges.', 'sasabudi' ), '<strong class="alert">[Covid-19]​</strong>' );
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'Once your order has been processed, you will receive a shipping confirmation email with a tracking number.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 05
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How much does shipping cost?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'When purchasing on sasabudi.com, a shipping fee will be added to all orders that are under the free shipping limit. Below you will find our shipping costs divided according to our shipping zones and quantities:', 'sasabudi' );
          echo '</p>';
          echo '<table class="ending">';
            echo '<body>';
              // USA
              echo '<tr>';
                echo '<td class="title" colspan="5">U.S. Shipping Zone</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="firstrow a">' . esc_html__( 'Product', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow b">' . esc_html__( '1 Item', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow c">' . esc_html__( '2 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow d">' . esc_html__( '3 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow e">' . esc_html__( 'Free Shipping', 'sasabudi' ) . '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="lastrow">' . esc_html__( 'Coffee Mug', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$4.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$6.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$8.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$60.00 and more', 'sasabudi' ) . '</td>';
              echo '</tr>';
              // Canada
              echo '<tr>';
                echo '<td class="title" colspan="5">Canadian Shipping Zone</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="firstrow">' . esc_html__( 'Product', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '1 Item', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '2 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '3 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( 'Free Shipping', 'sasabudi' ) . '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="lastrow">' . esc_html__( 'Coffee Mug', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$6.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$8.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$10.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$60.00 and more', 'sasabudi' ) . '</td>';
              echo '</tr>';
              // EU
              echo '<tr>';
                echo '<td class="title" colspan="5">EU Shipping Zone</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="firstrow">' . esc_html__( 'Product', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '1 Item', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '2 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '3 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( 'Free Shipping', 'sasabudi' ) . '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="lastrow">' . esc_html__( 'Coffee Mug', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$4.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$6.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$8.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$60.00 and more', 'sasabudi' ) . '</td>';
              echo '</tr>';
              // EFTA
              echo '<tr>';
                echo '<td class="title" colspan="5">EFTA Shipping Zone</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="firstrow">' . esc_html__( 'Product', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '1 Item', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '2 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '3 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( 'Free Shipping', 'sasabudi' ) . '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="lastrow">' . esc_html__( 'Coffee Mug', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$10.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$12.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$14.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$70.00 and more', 'sasabudi' ) . '</td>';
              echo '</tr>';
              // Japan
              echo '<tr>';
                echo '<td class="title" colspan="5">Japan Shipping Zone</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="firstrow">' . esc_html__( 'Product', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '1 Item', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '2 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '3 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( 'Free Shipping', 'sasabudi' ) . '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="lastrow">' . esc_html__( 'Coffee Mug', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$6.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$8.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$10.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$60.00 and more', 'sasabudi' ) . '</td>';
              echo '</tr>';
              // Australia
              echo '<tr>';
                echo '<td class="title" colspan="5">Australian Shipping Zone</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="firstrow">' . esc_html__( 'Product', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '1 Item', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '2 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '3 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( 'Free Shipping', 'sasabudi' ) . '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="lastrow">' . esc_html__( 'Coffee Mug', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$6.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$8.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$10.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$60.00 and more', 'sasabudi' ) . '</td>';
              echo '</tr>';
              // International
              echo '<tr>';
                echo '<td class="title" colspan="5">International Shipping Zone</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="firstrow">' . esc_html__( 'Product', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '1 Item', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '2 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( '3 Items', 'sasabudi' ) . '</td>';
                echo '<td class="firstrow">' . esc_html__( 'Free Shipping', 'sasabudi' ) . '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td class="lastrow">' . esc_html__( 'Coffee Mug', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$8.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$10.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$12.00', 'sasabudi' ) . '</td>';
                echo '<td class="lastrow">' . esc_html__( '$70.00 and more', 'sasabudi' ) . '</td>';
              echo '</tr>';
            echo '</body>';
          echo '</table>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 06
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
    
    /**
     * Question 07
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'Do you ship to PO Boxes?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'Typically, only national postal carriers, such as the US Postal Service or Canada Post, are able to deliver orders to PO Boxes. Many of our packages are too large to be accepted by national postal carriers, so we use commercial companies like FedEx to deliver these products that cannot deliver to PO Boxes.', 'sasabudi' );
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'We recommend that you use a physical address instead of a PO Box address to ensure smooth delivery.', 'sasabudi' );
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
    
    /**
     * Question 08
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

    /**
     * Question 09
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'My order should be arrived already, but I still don\'t have it. What should I do?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'Before contacting us, please help us by doing the following:', 'sasabudi' );
          echo '</p>';
          echo '<ol>';
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
          echo '<p>';
           printf( esc_html__( 'If the delivery address was correct and the package was not left at the post office or with a neighbor, %s us with your order number.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('help/contact/')) . '">contact</a>');
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'If you have found an error in your shipping address, we can send you a replacement order, but shipping will be at your own expense.', 'sasabudi' );
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 10 
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'My order was delivered with only some of my items, what should I do?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'We may have shipped your order in separate packages. Please check your email to see if any of your items are arriving separately. You will receive a separate shipping confirmation for each package shipped.', 'sasabudi' ); 
          echo '</p>';
          echo '<p class="ending">';
            printf( esc_html__( 'If any item is missing, please keep the original shipping package and %s us for further assistance.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('help/contact/')) . '">contact</a>');
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

    /**
     * Question 11  
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'I received a wrong/damaged product, what should I do?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            printf( esc_html__( 'We are very sorry if the product you ordered arrived damaged. So that we can quickly fix this for you, please email us at %s within a week with photos of the damaged product, your order number and any other details you have about your order.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url('mailto:support@sasabudi.com') . '">support@sasabudi.com</a>');
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'After that, we will be happy to send you a replacement free of charge.', 'sasabudi' );
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';

  echo '</div>';
echo '</section>';