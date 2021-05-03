<?php
/**
 * The template functions used for displaying the 'footer' definitions.
 *
 * CONTENT:
 * - sasabudi_footer_section_scrolltop
 * - sasabudi_footer_section_widgets
 * - sasabudi_footer_section_newsletter
 * MIDDLE:
 * - sasabudi_footer_section_social
 * - sasabudi_footer_section_payment
 * BOTTOM:
 * - sasabudi_footer_section_disclaimer
 * MODULES:
 * - sasabudi_footer_app_search
 * - sasabudi_footer_app_notice
 * - sasabudi_footer_app_wishlist
 * - sasabudi_footer_app_storeselection
 * - sasabudi_footer_app_subscription
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

/**
 * Footer Content Actions.
 */
if ( ! function_exists( 'sasabudi_footer_section_scrolltop' ) ) {
  /**
   * Shows the footer 'scrolltop' section.
   */
  function sasabudi_footer_section_scrolltop() {

    echo '<div class="footer-scroll">';
      echo '<div class="footer-scroll__btn">';
        echo '<a class="footer-scroll__btn--link" href="#">' . esc_html__( 'Scroll to Top', 'sasabudi' ) . '</a>';
      echo '</div>';
    echo '</div>';

  }
}

if ( ! function_exists( 'sasabudi_footer_section_widgets' ) ) {
  /**
   * Shows the footer menu 'widget' section.
   */
  function sasabudi_footer_section_widgets() {

    echo '<div class="footer-menu">';

      // Menu one
      echo '<div class="footer-menu__one">';
        dynamic_sidebar('footer-1');
      echo '</div>';

      // Menu Two
      echo '<div class="footer-menu__two">';
        dynamic_sidebar('footer-2');
      echo '</div>';

      // Menu Three
      echo '<div class="footer-menu__three">';
        dynamic_sidebar('footer-3');
      echo '</div>';
      
    echo '</div>';

  }
}

if ( ! function_exists( 'sasabudi_footer_section_newsletter' ) ) {
  /**
   * Simply shows the site 'newsletter' section.
   */
  function sasabudi_footer_section_newsletter() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      echo '<div class="newsletter">';

        echo '<h2 class="newsletter-title">' . esc_html__( 'Save 15% on your order', 'sasabudi' ) . '</h2>';

        // Footer Newsletter Form
        echo '<form action="#" method="post" id="app-newsletter">';

          echo '<div class="signup-group">';
            
            echo '<p class="signup-group__prompt">' . esc_html__( 'Sign up to our newsletter to get the latest offers direct to your inbox, plus 15% off on your first order!', 'sasabudi' ) . '</p>';
            
            echo '<div class="form-group">';
              echo '<input type="text" maxlength="64" name="subscriber_name" id="subscriber_name" class="input-name" placeholder="' . esc_html__('Enter your name, please', 'sasabudi') . '">';
            echo '</div>';

            echo '<div class="form-group">';
              echo '<input type="text" maxlength="64" name="subscriber_email" id="subscriber_email" class="input-email" placeholder="' . esc_html__('Enter your email, please', 'sasabudi') . '">';
            echo '</div>';

            echo '<div class="form-group submit-enabled" id="signup-submit">';
              echo '<input type="submit" value="' . esc_html__('Sign up now', 'sasabudi') . '" name="subscribe" class="button">';
              echo '<div class="submit-waiting"><span></span><span></span><span></span></div>';
            echo '</div>';

          echo '</div>';

          echo '<label class="label-for-checkbox" for="subscriber_gdpr">';
            echo '<input class="input-checkbox" type="checkbox" name="subscriber_gdpr" id="subscriber_gdpr">';
            echo '<span>';
              printf( 'Yes, send me regular email updates. I can unsubscribe from it at any time. For more information, please read our %1$s and %2$s.', '<a class="primary-link" href="' . esc_url(home_url('/policies/terms-of-service/')) . '">Terms of Service</a>', '<a class="primary-link" href="' . esc_url(home_url('/policies/privacy-policy/')) . '">Privacy Policy</a>');
            echo '</span>';
          echo '</label>';

        echo '</form>';

      echo '</div>';
    endif;
  }
}

/**
 * Footer Middle Actions.
 */
if ( ! function_exists( 'sasabudi_footer_section_social' ) ) {

  /**
   * Shows the footer 'social' section.
   */
  function sasabudi_footer_section_social() {

    echo '<div class="footer-social">';
      echo '<h2 class="footer-social__title">' . esc_html__('Let\'s be friends', 'sasabudi') . '</h2>';
      echo '<ul class="footer-social__list">';

        $facebook = '';
        $twitter = '';
        $tumblr = '';
        $pinterest = '';
        $instagram = '';
        $snapchat = '';
        $youtube = '';

        // Manage 'acf' dashboard settings
        if (get_field('facebook_username', 'option' ))  $facebook = get_field('facebook_username', 'option');
        if (get_field('twitter_username', 'option' ))  $twitter = get_field('twitter_username', 'option');
        if (get_field('tumblr_username', 'option' ))  $tumblr = get_field('tumblr_username', 'option');
        if (get_field('pinterest_username', 'option' ))  $pinterest = get_field('pinterest_username', 'option');
        if (get_field('instagram_username', 'option' ))  $instagram = get_field('instagram_username', 'option');
        if (get_field('snapchat_username', 'option' ))  $snapchat = get_field('snapchat_username', 'option');
        if (get_field('youtube_username', 'option' ))  $youtube = get_field('youtube_username', 'option');
        
        // Assign links when possible
        if ( $facebook ) echo('<li><a href="' . $facebook . '" target="_blank"><span class="footer-social__list--icon svg--facebook"></span>Facebook</a></li>' );
        if ( $twitter ) echo('<li><a href="' . $twitter . '" target="_blank"><span class="footer-social__list--icon svg--twitter"></span>Twitter</a></li>' );
        if ( $tumblr ) echo('<li><a href="' . $tumblr . '" target="_blank"><span class="footer-social__list--icon svg--tumblr"></span>Tumblr</a></li>' );
        if ( $pinterest ) echo('<li><a href="' . $pinterest . '" target="_blank"><span class="footer-social__list--icon svg--pinterest"></span>Pinterest</a></li>' );
        if ( $instagram ) echo('<li><a href="' . $instagram . '" target="_blank"><span class="footer-social__list--icon svg--instagram"></span>Instagram</a></li>' );
        if ( $snapchat ) echo('<li><a href="' . $snapchat . '" target="_blank"><span class="footer-social__list--icon svg--snapchat"></span>Snapchat</a></li>' );
        if ( $youtube ) echo('<li><a href="' . $youtube . '" target="_blank"><span class="footer-social__list--icon svg--youtube"></span>YouTube</a></li>' );

      echo '</ul>';
    echo '</div>';

  }
}

if ( ! function_exists( 'sasabudi_footer_section_payment' ) ) {

  /**
   * Shows the footer 'payment' section.
   */
  function sasabudi_footer_section_payment() {

    echo '<div class="footer-payment">';
      echo '<h2 class="footer-payment__title">' . esc_html__('Payment', 'sasabudi') . '<span class="footer-payment__prices">' . esc_html__('Prices are shown in USD', 'sasabudi') . '</span></h2>';
      echo '<ul>';
        echo '<li><div class="footer-payment__paypal">PayPal</div></li>';
        echo '<li><div class="footer-payment__visa">Visa</div></li>';
        echo '<li><div class="footer-payment__mastercard">Mastercard</div></li>';
        echo '<li><div class="footer-payment__amexco">American Express</div></li>';
        echo '<li><div class="footer-payment__discover">Discover</div></li>';   
        echo '<li><div class="footer-payment__diners">Diners</div></li>';
        echo '<li><div class="footer-payment__jcb">JCB</div></li>';
      echo '</ul>';
    echo '</div>';

  }
}

/**
 * Footer Bottom Actions.
 */
if ( ! function_exists( 'sasabudi_footer_section_disclaimer' ) ) {
  
  /**
   * Shows the footer 'disclaimer' section.
   */
  function sasabudi_footer_section_disclaimer() {

    $cart_checkout_class = '';
    if( is_cart() || is_checkout() ) {
      $cart_checkout_class = ' payment-state';
    }

    // Payment
    echo '<div class="footer-payment' . $cart_checkout_class . '">';
      echo '<ul>';
        echo '<li><div class="footer-payment__paypal">PayPal</div></li>';
        echo '<li><div class="footer-payment__visa">Visa</div></li>';
        echo '<li><div class="footer-payment__mastercard">Mastercard</div></li>';
        echo '<li><div class="footer-payment__amexco">American Express</div></li>';
        echo '<li><div class="footer-payment__discover">Discover</div></li>';
        echo '<li><div class="footer-payment__diners">Diners</div></li>';
        echo '<li><div class="footer-payment__jcb">JCB</div></li>';
      echo '</ul>';
      echo '<p class="footer-payment__prices">' . esc_html__('Prices are shown in USD', 'sasabudi') . '</p>';
    echo '</div>';

    // Disclaimer
    echo '<div class="footer-disclaimer' . $cart_checkout_class . '">';
      echo '<span class="footer-disclaimer__terms"><a href="' . esc_url(home_url('/policies/terms-of-service/')) . '">' . esc_html__( 'Terms of Service', 'sasabudi' ) . '</a>';
      echo '<span class="footer-disclaimer__privacy"><span class="spc">|</span><a href="' . esc_url(home_url('/policies/privacy-policy/')) . '">' . esc_html__( 'Privacy Policy', 'sasabudi' ). '</a></span>';
      echo '<span class="footer-disclaimer__cookies"><span class="spc">|</span><a href="' . esc_url(home_url('/policies/cookie-policy/')) . '">' . esc_html__( 'Cookie Policy', 'sasabudi' ) . '</a></span>';
      echo '<span class="footer-disclaimer__notice"><span class="spc">|</span><a href="' . esc_url(home_url('/policies/legal-notice/')) . '">' . esc_html__( 'Legal Notice', 'sasabudi' ) . '</a></span>';
      echo '<span class="footer-disclaimer__notice"><span class="spc">|</span><a href="' . esc_url(home_url('/sitemap/')) . '">' . esc_html__( 'Sitemap', 'sasabudi' ) . '</a></span>';
    echo '</div>';
    
    // Copyright
    echo '<div class="footer-credit' . $cart_checkout_class . '">';
      echo '<span class="footer-credit__copy">© 2020-' . date( 'Y' ) . ' ' . '<a class="strong-link" href="' . esc_url(home_url('/')) . '">SASABUDI</a></span>';
    echo '</div>';

  }
}


/**
 * Footer Modules Actions.
 */

if ( ! function_exists( 'sasabudi_footer_app_search' ) ) {
  /**
   * Includes the 'search' module.
   */
  function sasabudi_footer_app_search() {

    echo '<div class="app-search" id="search-modal">';

      echo '<div class="app-search__head">';
        echo '<i class="app-search__head--glass" aria-hidden="true"></i>';
        echo '<input type="text" maxlength="64" class="app-search__head--term" placeholder="' . esc_html__('What are you looking for?', 'sasabudi') .'" id="search-term">';
        echo '<i class="app-search__head--close" aria-hidden="true"></i>';
      echo '</div>';

      echo '<div class="app-search__main">';
      
        echo '<div class="app-search__loader" id="search-loader">';
          echo '<span class="loader--icon"></span>';
        echo '</div>';
        
        echo '<div class="app-search__results" id="search-results">';
          /* Dynamic Results in here!! */
        echo '</div>';
        
        echo '<div class="app-search__overview" id="search-overview">';
          get_template_part( 'templates/search-results', 'overview' );
        echo '</div>';

      echo '</div>';

    echo '</div>';
    
  }
}

if ( ! function_exists( 'sasabudi_footer_app_notice' ) ) {
  /**
   * Simply shows the 'notice' module.
   */
  function sasabudi_footer_app_notice() {
    echo '<div class="notice" id="app-notice">';
      echo '<div class="notice-prompt">';
        echo '<p class="notice-prompt__message">Welcome</p>';
      echo '</div>';
      echo '<div class="notice-close">';
        echo '<a class="notice-close__btn" href="#">';
          echo '<span class="notice-close__btn--bar"></span>';
        echo '</a>';
      echo '</div>';
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_footer_app_wishlist' ) ) {
  /**
   * Simply shows the 'wihslist login' module.
   */
  function sasabudi_footer_app_wishlist() {
    echo '<div class="wishlist wishlist-modal">';
      echo '<div class="wishlist-prompt">';
        echo '<h3>' . esc_html__('Add to Wishlist', '$sasabudi') . '</h3>';
        echo '<p>' . esc_html__('You must have a SASABUDI account and signed in to save items to your wishlist', '$sasabudi') . '</p>';
        echo '<div class="wishlist-signup">';
          echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . '" class="button">' . esc_html__('Sign In', '$sasabudi') . '</a>';
          echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . '?action=register" class="button btn-light">' . esc_html__('Create an account', '$sasabudi') . '</a>';
        echo '</div>';
        echo '<div class="wishlist-close">';
          echo '<a href="#" class="wishlist-close__btn">Close</a>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_footer_app_storeselection' ) ) {

  /**
   * Simply shows the 'store selection' module.
   */
  function sasabudi_footer_app_storeselection() {

    echo '<div class="storeselection">';
      echo '<div class="storeselection-box">';

        echo '<h3>' . esc_html__('Are you in the right place?', 'sasabudi') . '</h3>';
        echo '<p>' . esc_html__('Please select your location so we can direct you to the correct store', 'sasabudi') . '</p>';

        echo '<div class="selection-boxes">';
          // United States
          echo '<a href="#" class="place-opt" id="store_us">';
            echo '<span class="flag" style="background-image: url(' . get_template_directory_uri() . '/images/us.png)"></span>';
            echo esc_html__('United States', 'sasabudi');
          echo '</a>';
          // Europe
          echo '<a href="#" class="place-opt" id="store_eu">';
            echo '<span class="flag" style="background-image: url(' . get_template_directory_uri() . '/images/eu.png)"></span>';
            echo esc_html__('Europe', 'sasabudi');
          echo '</a>';          
          // Canada
          echo '<a href="#" class="place-opt" id="store_ca">';
            echo '<span class="flag" style="background-image: url(' . get_template_directory_uri() . '/images/ca.png)"></span>';
            echo esc_html__('Canada', 'sasabudi');
          echo '</a>';
          // United Kingdom
          echo '<a href="#" class="place-opt" id="store_uk">';
            echo '<span class="flag" style="background-image: url(' . get_template_directory_uri() . '/images/uk.png)"></span>';
            echo esc_html__('United Kingdom', 'sasabudi');
          echo '</a>';
          // Australia / New Zealand
          echo '<a href="#" class="place-opt" id="store_au">';
            echo '<span class="flag" style="background-image: url(' . get_template_directory_uri() . '/images/au.png)"></span>';
            echo esc_html__('Australia/New Zealand', 'sasabudi');
          echo '</a>';
          // Japan
          echo '<a href="#" class="place-opt" id="store_jp">';
            echo '<span class="flag" style="background-image: url(' . get_template_directory_uri() . '/images/jp.png)"></span>';
            echo esc_html__('Japan', 'sasabudi');
          echo '</a>';
           // World
          echo '<a href="#" class="place-opt" id="store_world">';
            echo '<span class="flag" style="background-image: url(' . get_template_directory_uri() . '/images/world.png)"></span>';
            echo esc_html__('Rest of World', 'sasabudi');
          echo '</a>';
          
        echo '</div>';

      echo '</div>';
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_footer_app_subscription' ) ) {

  /**
   * Simply shows the 'subscription' module.
   */
  function sasabudi_footer_app_subscription() {

    echo '<div class="subscription">';
      echo '<div class="subscription-box">';

        echo '<h3>' . esc_html__('Almost there!', 'sasabudi') . '</h3>';
        echo '<p>' . esc_html__('You will now receive an Email in which you must confirm your registration.', 'sasabudi') . '</p>';
        echo '<p>' . esc_html__('Also check the Spam folder or Promotion Tab.', 'sasabudi') . '</p>';
        echo '<a class="subscription-box__close" aria-label="Close">×</a>';

        echo '<div class="subscription-box__continue">';
          echo '<a href="#" class="button btn-auto subscription-close">' . esc_html__('Continue shopping', 'sasabudi') . '</a>';
        echo '</div>';

      echo '</div>';
    echo '</div>';
  }
}

