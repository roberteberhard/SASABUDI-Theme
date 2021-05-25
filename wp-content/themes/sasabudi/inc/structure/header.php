<?php
/**
 * The template functions used for displaying the 'header' definitions.
 * 
 * DEVICE:
 * - sasabudi_header_device_toggle
 * - sasabudi_header_device_logo
 * - sasabudi_header_device_search
 * - sasabudi_header_device_wishlist
 * - sasabudi_header_device_cart
 * - sasabudi_header_device_note
 * - sasabudi_header_device_promotion
 * 
 * DESKTOP:
 * - sasabudi_header_desktop_note
 * - sasabudi_header_desktop_logo
 * - sasabudi_header_desktop_menu
 * - sasabudi_header_desktop_search
 * - sasabudi_header_desktop_support
 * - sasabudi_header_desktop_wishlist
 * - sasabudi_header_desktop_account
 * - sasabudi_header_desktop_cart
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

/**
 * Header Device Actions.
 */
if ( ! function_exists( 'sasabudi_header_device_toggle' ) ) {

  /**
   * Shows the header 'device' toggle button.
   */
  function sasabudi_header_device_toggle() {

    // Build device toggle
    echo '<div class="header-device__toggle">';
      echo '<a href="#" title="' . esc_html__('View Menu', 'sasabudi') . '">';
        echo '<div class="header-device__toggle--button"></div>';
      echo '</a>';
    echo '</div>';  
  }
}

if ( ! function_exists( 'sasabudi_header_device_logo' ) ) {

  /**
   * Shows the header 'device' brand logo.
   */
  function sasabudi_header_device_logo() {

    // Build device logo
    echo '<div class="header-device__logo">';
      echo '<div class="header-device__title">';
        echo '<a href="#" rel="home" class="header-device__title--link">' . bloginfo( 'name' ) . '</a>';
      echo '</div>';
    echo '</div>';     
  }
}

if ( ! function_exists( 'sasabudi_header_device_search' ) ) {

  /**
   * Shows the header 'device' search button.
   */
  function sasabudi_header_device_search() {

    // Build device search
    echo '<div class="header-device__search">';
      echo '<a href="#" title="' . esc_html__('Search Products','sasabudi') . '">';
        echo '<div class="header-device__search--button"></div>';
      echo '</a>';
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_device_wishlist' ) ) {

  /**
   * Shows the header 'device' wishlist button.
   */
  function sasabudi_header_device_wishlist() {

    // Build device wishlist
    echo '<div class="header-device__wishlist">';

      if (is_user_logged_in()) {

        $deviceModus = new WP_Query(array(
          'author' => get_current_user_id(),
          'post_type' => 'wishlist',
          'posts_per_page' => -1
        ));

        $modus = $deviceModus->have_posts() ? ' icon-on' : '';

        echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . 'saved-items" title="' . esc_html__('View Wishlist','sasabudi') . '">';
          echo '<div class="header-device__wishlist--button"></div>';
          echo '<div class="header-device__wishlist--flag' . $modus . '"></div>';
        echo '</a>';

      } else {
        echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . '" title="' . esc_html__('View Wishlist','sasabudi') . '">';
          echo '<div class="header-device__wishlist--button"></div>';
        echo '</a>';
        }
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_device_cart' ) ) {

  /**
   * Shows the header 'device' cart button.
   */
  function sasabudi_header_device_cart() {
    echo '<div class="header-device__cart">';
    if( is_cart() || is_checkout() ) {
      echo '<a href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'cart' ) ) ) . '" title="' . esc_html__('View Cart', 'sasabudi') . '">';
        echo '<div class="header-device__cart--btn"></div>';
        echo '<div class="header-device__cart--count">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
      echo '</a>';
    } else {
      echo '<a href="#" title="' . esc_html__('View Cart', 'sasabudi') . '">';
        echo '<div class="header-device__cart--button"></div>';
        echo '<div class="header-device__cart--amount">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
      echo '</a>';
    }
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_device_note' ) ) {

  /**
   * Shows the 'header' device note message.
   */
  function sasabudi_header_device_note() {

    if ( ! is_page( 'checkout' ) ) {

      // Settings
      $shipping_amount  = '';	
      $shipping_method  = '';	
      $cookie_country   = '';
      $cookie_name      = 'wp_store_selector_UgNz4K';
      $cookie_value     = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name]: null; 
      $note_bar         = get_field('ws_announcement_bar', 'option') ? get_field('ws_announcement_bar', 'option') : '';
      $note_style       = get_field('ws_announcement_style', 'option') ? get_field('ws_announcement_style', 'option') : '';
      $note_desc        = get_field('ws_announcement_desc', 'option') ? get_field('ws_announcement_desc', 'option') : '';
      $note_target      = get_field('ws_announcement_target', 'option') ? get_field('ws_announcement_target', 'option') : '';
      $note_state       = ($note_bar == '1') ? 'active' : 'inactive';

      if( $note_state == 'active' ) {

        echo '<div class="note-device ' . $note_style . '">';

          if ($cookie_value) {

            // United States
            if ($cookie_value == "ejuksw") {
              $cookie_country  = ' us-section';
              $shipping_amount = '60';	
              $shipping_method = 'U.S. Free shipping';
            }
            // Canada
            else if ($cookie_value == "gewokx") { 
              $cookie_country  = ' ca-section';
              $shipping_amount = '60';	
              $shipping_method = 'Canadian Free Shipping';
            }
            // Europe
            else if ($cookie_value == "jeuzew") {
              $cookie_country  = ' eu-section';
              $shipping_amount = '60';	
              $shipping_method = 'EU Free Shipping';
            }
            // United Kingdom
            else if ($cookie_value == "awqoir") {
              $cookie_country  = ' uk-section';
              $shipping_amount = '60';	
              $shipping_method = 'UK Free shipping';
            }
            // Japan
            else if ($cookie_value == "mpneys") {
              $cookie_country  = ' jp-section';
              $shipping_amount = '60';	
              $shipping_method = 'Japan Free Shipping';
            }
            // Australia / New Zeeland
            else if ($cookie_value == "komrfu") {
              $cookie_country  = ' au-section';
              $shipping_amount = '60';	
              $shipping_method = 'Australian Free Shipping';
            } 
            // World
            else if ($cookie_value == "jkdwan") { // EFTA Free shipping
              $cookie_country  = ' world-section';
              $shipping_amount = '70';	
              $shipping_method = 'International Free Shipping';
            }
          }
          // Set country cookie if none exists!
          else {
            $packages   = WC()->cart->get_shipping_packages();
            $package    = reset( $packages );
            $zone       = wc_get_shipping_zone( $package );

            foreach ( $zone->get_shipping_methods( true ) as $k => $method ) {
              $shipping_amount = $method->get_option( 'min_amount' );
              $shipping_method = $method->get_option( 'title' );
            }

            switch ($shipping_method) {
              case 'U.S. Shipping':
              case 'U.S. Free shipping':
                $cookie_country = ' us-section';
                break;
              case 'Canadian Shipping':
              case 'Canadian Free Shipping':
                $cookie_country = ' ca-section';
                break;
              case 'EFTA Shipping':
              case 'EFTA Free shipping':
              case 'EU Shipping':
              case 'EU Free Shipping':
                $cookie_country = ' eu-section';
                break;
              case 'UK Shipping':
              case 'UK Free shipping':
                $cookie_country = ' uk-section';
                break;
              case 'Japan Shipping':
              case 'Japan Free Shipping':
                $cookie_country = ' jp-section';
                break;
              case 'Australian Shipping':
              case 'Australian Free Shipping':
                $cookie_country = ' au-section';
                break;
              default:
                $cookie_country = ' world-section';
            }
          }

          if ( $note_target ) {
            // Free shipping and amount display + url shipping faqs
            echo '<div class="note-device__prompt is-wrapper"><a href="' . $note_target . '">' . sprintf(esc_html__('Get %s %1s %2s %3s', 'sasabudi'), $shipping_method, $note_desc, '<span class="min-amount">' . wc_price($shipping_amount) . '</span>', 'or more') . '</a></div>';
          } else {
            // Free shipping and amount display
            echo '<div class="note-device__prompt is-wrapper">' . sprintf(esc_html__('Get %s %1s %2s %3s', 'sasabudi'), $shipping_method, $note_desc, '<span class="min-amount">' . wc_price($shipping_amount) . '</span>', 'or more') . '</div>';
          }

        echo '</div>';
      }
    } else {

      echo '<div class="note-device">';
        echo '<div class="note-device__prompt is-wrapper"><span class="is-secure"></span>' . esc_html__('Your information is secure', 'sasabudi') . '</div>';
      echo '</div>';
      
    }
  }
}

if ( ! function_exists( 'sasabudi_header_device_promotion' ) ) {

  /**
   * Shows the header 'device' shipping information.
   */
  function sasabudi_header_device_promotion() {

    // Settings
    $promo_bar = '';
    $promo_style = '';
    $promo_msg = '';					

    // Arguments
    if (get_field('ws_promotion_bar', 'option' )) $promo_bar = get_field('ws_promotion_bar', 'option');
    if (get_field('ws_promotion_style', 'option' )) $promo_style = get_field('ws_promotion_style', 'option');	
    if (get_field('ws_promotion_desc', 'option' )) $promo_msg = get_field('ws_promotion_desc', 'option');

    // Note state
    $promo_state = ($promo_bar == '1') ? 'active' : 'inactive';
    
    // Exclude promo bar on account pages
    if( $promo_state == 'active' && !is_account_page() ) {
      echo '<div class="header-promo ' . $promo_style . '">';
        echo '<div class="header-promo__prompt is-wrapper">' . $promo_msg . '</div>';
      echo '</div>';
    }
    
  }
}

/**
 * Header Desktop Actions.
 */
if ( ! function_exists( 'sasabudi_header_desktop_note' ) ) {

  /**
   * Shows the 'desktop' header note message.
   */
  function sasabudi_header_desktop_note() {

    // Settings
    $note_bar         = get_field('ws_announcement_bar', 'option') ? get_field('ws_announcement_bar', 'option') : '';
    $note_state       = ($note_bar == '1') ? 'active' : 'inactive';

    if ($note_state == 'active') {

      /**
       * This works together with store-selection.js component!!
       */

      // Settings
      $shipping_amount  = '';	
      $shipping_method  = '';	
      $cookie_country   = '';
      $cookie_name      = 'wp_store_selector_UgNz4K';
      $cookie_value     = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name]: null; 
      $note_style       = get_field('ws_announcement_style', 'option') ? get_field('ws_announcement_style', 'option') : '';
      $note_desc        = get_field('ws_announcement_desc', 'option') ? get_field('ws_announcement_desc', 'option') : '';
      $note_target      = get_field('ws_announcement_target', 'option') ? get_field('ws_announcement_target', 'option') : '';  

      if ($cookie_value) {

        // United States
        if ($cookie_value == "ejuksw") {
          $cookie_country  = ' us-section';
          $shipping_amount = '60';	
          $shipping_method = 'U.S. Free shipping';
        }
        // Canada
        else if ($cookie_value == "gewokx") { 
          $cookie_country  = ' ca-section';
          $shipping_amount = '60';	
          $shipping_method = 'Canadian Free Shipping';
        }
        // Europe
        else if ($cookie_value == "jeuzew") {
          $cookie_country  = ' eu-section';
          $shipping_amount = '60';	
          $shipping_method = 'EU Free Shipping';
        }
        // United Kingdom
        else if ($cookie_value == "awqoir") {
          $cookie_country  = ' uk-section';
          $shipping_amount = '60';	
          $shipping_method = 'UK Free shipping';
        }
        // Japan
        else if ($cookie_value == "mpneys") {
          $cookie_country  = ' jp-section';
          $shipping_amount = '60';	
          $shipping_method = 'Japan Free Shipping';
        }
        // Australia / New Zeeland
        else if ($cookie_value == "komrfu") {
          $cookie_country  = ' au-section';
          $shipping_amount = '60';	
          $shipping_method = 'Australian Free Shipping';
        } 
        // World
        else if ($cookie_value == "jkdwan") { // EFTA Free shipping
          $cookie_country  = ' world-section';
          $shipping_amount = '70';	
          $shipping_method = 'International Free Shipping';
        }
      }
      // Set country cookie if none exists!
      else {
        $packages   = WC()->cart->get_shipping_packages();
        $package    = reset( $packages );
        $zone       = wc_get_shipping_zone( $package );

        foreach ( $zone->get_shipping_methods( true ) as $k => $method ) {
          $shipping_amount = $method->get_option( 'min_amount' );
					$shipping_method = $method->get_option( 'title' );
				}

        switch ($shipping_method) {
          case 'U.S. Shipping':
          case 'U.S. Free shipping':
            $cookie_country = ' us-section';
            break;
          case 'Canadian Shipping':
          case 'Canadian Free Shipping':
            $cookie_country = ' ca-section';
            break;
          case 'EFTA Shipping':
          case 'EFTA Free shipping':
          case 'EU Shipping':
          case 'EU Free Shipping':
            $cookie_country = ' eu-section';
            break;
          case 'UK Shipping':
          case 'UK Free shipping':
            $cookie_country = ' uk-section';
            break;
          case 'Japan Shipping':
          case 'Japan Free Shipping':
            $cookie_country = ' jp-section';
            break;
          case 'Australian Shipping':
          case 'Australian Free Shipping':
            $cookie_country = ' au-section';
            break;
          default:
            $cookie_country = ' world-section';
        }
      }
      
      if ( ! is_page( 'checkout' ) ) {

        echo '<div class="note-desktop ' . $note_style . '">';

          if ( $note_target ) {
            // Free shipping and amount display + url shipping faqs
            echo '<div class="note-desktop__prompt is-wrapper"><a href="' . $note_target . '">' . sprintf(esc_html__('Get %s %1s %2s %3s', 'sasabudi'), $shipping_method, $note_desc, '<span class="min-amount">' . wc_price($shipping_amount) . '</span>', 'or more') . '</a></div>';
          } else {
            // Free shipping and amount display
            echo '<div class="note-desktop__prompt is-wrapper">' . sprintf(esc_html__('Get %s %1s %2s %3s', 'sasabudi'), $shipping_method, $note_desc, '<span class="min-amount">' . wc_price($shipping_amount) . '</span>', 'or more') . '</div>';
          }

          // Store selector
          echo '<a href="#" class="note-desktop__selector' . $cookie_country . '">'; 
            echo '<div class="location-flag">' . esc_html__('Your Location', 'sasabudi') . '</div>';
          echo '</a>';

        echo '</div>';
      }

      else {

        echo '<div class="note-desktop">';
          echo '<div class="note-desktop__prompt is-wrapper"><span class="is-secure"></span>' . esc_html__('Your information is secure', 'sasabudi') . '</div>';
        echo '</div>';

        // Store selector
        echo '<a href="#" class="note-desktop__selector' . $cookie_country . '">';
          echo '<div class="location-flag">' . esc_html__('Your Location', 'sasabudi') . '</div>';
        echo '</a>';
      }
    }
  }
}

if ( ! function_exists( 'sasabudi_header_desktop_logo' ) ) {

  /**
   * Shows the header 'desktop' brand logo.
   */
  function sasabudi_header_desktop_logo() {

    // Build desktop logo
    echo '<div class="header-desktop__logo">';
      echo '<div class="header-desktop__title">';
        echo '<a href="#" rel="home" class="header-desktop__title--link">' . esc_html__( 'sasabudi', 'sasabudi' ) . '</a>';
      echo '</div>';
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_desktop_menu' ) ) {

  /**
   * Shows the header 'desktop' primary menu.
   */
  function sasabudi_header_desktop_menu() {

    // Set navigation classes
    $is_home = is_front_page() ? ' is-home' : '';
    $is_archive_catalog = is_product_taxonomy() ? ' is-catalog' : '';
    $is_single_catalog = is_product() ? ' is-catalog' : '';
    $is_archive_collection = is_post_type_archive( 'collections' ) ? ' is-collection' : '';
    $is_single_collection = is_singular( 'collections' ) ? ' is-collection' : '';
    $is_archive_instagram = is_post_type_archive( 'instagram' ) ? ' is-instagram' : '';
    $is_home_blog = is_home() ? ' is-blog' : '';
    $is_category_blog = is_category() ? ' is-blog' : '';
    $is_single_blog = is_singular( 'post' ) ? ' is-blog' : '';
   
    // Build desktop menu
    echo '<nav class="header-desktop__menu' . $is_home . '' . $is_archive_catalog . '' . $is_single_catalog . '' . $is_archive_collection . '' . $is_single_collection . '' . $is_archive_instagram . '' . $is_home_blog . '' . $is_category_blog . '' . $is_single_blog . '" id="site-navigation">';
      if ( has_nav_menu( 'primary' ) ) :
        wp_nav_menu(
          array(
            'theme_location'  => 'primary',
            'menu_id'         => 'primary-menu',
            'menu_class'      => 'navbar-nav',
            'walker'          => new Walker_Nav_Primary()
          )
        );
      endif;
    echo '</nav>';
  }
}

if ( ! function_exists( 'sasabudi_header_desktop_search' ) ) {

  /**
   * Shows the header 'desktop' search button.
   */
  function sasabudi_header_desktop_search() {

    // Build desktop search
    echo '<div class="header-desktop__search">';
      echo '<a href="#" title="' . esc_html__('Search Products','sasabudi') . '">';
        echo '<div class="header-desktop__search--button"></div>';
      echo '</a>';   
      echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_desktop_support' ) ) {

  /**
   * Shows the header 'desktop' support button.
   */
  function sasabudi_header_desktop_support() {

    // Build desktop support
    echo '<div class="header-desktop__support">';
      echo '<a href="' . esc_url(home_url('/help/faqs/')) . '" title="' . esc_html__('Get Help','sasabudi') . '">';
        echo '<div class="header-desktop__support--button"></div>';
      echo '</a>'; 
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_desktop_wishlist' ) ) {

  /**
   * Shows the header 'desktop' wishlist button.
   */
  function sasabudi_header_desktop_wishlist() {

    // Build desktop wishlist
    echo '<div class="header-desktop__wishlist">';

      if (is_user_logged_in()) {

        $desktopModus = new WP_Query(array(
          'author' => get_current_user_id(),
          'post_type' => 'wishlist',
          'posts_per_page' => -1
        ));
        
        $modus = $desktopModus->have_posts() ? ' icon-on' : '';

        echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . 'saved-items" title="' . esc_html__('View Wishlist','sasabudi') . '">';
          echo '<div class="header-desktop__wishlist--button"></div>';
          echo '<div class="header-desktop__wishlist--flag' . $modus . '"></div>';
        echo '</a>';

      } else {
        echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . '" title="' . esc_html__('View Wishlist','sasabudi') . '">';
          echo '<div class="header-desktop__wishlist--button"></div>';
        echo '</a>';
      }
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_desktop_account' ) ) {

  /**
   * Shows the header 'desktop' account button.
   */
  function sasabudi_header_desktop_account() {

    // Build desktop account
    echo '<div class="header-desktop__account">';
      if (is_user_logged_in()) {
        // Show first name as display name
        $user = get_userdata(get_current_user_id());
        $display_name = $user->first_name;
        echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . '" title="">' . esc_html( $display_name );
          echo '<div class="header-desktop__account--button"></div>';
        echo '</a>'; 
      } else {
        echo '<a href="' . get_permalink( wc_get_page_id('myaccount') ) . '" title="' . esc_html__('View Account','sasabudi') . '">';
          echo '<div class="header-desktop__account--button"></div>';
        echo '</a>'; 
      }
    echo '</div>';
  }
}

if ( ! function_exists( 'sasabudi_header_desktop_cart' ) ) {

  /**
   * Shows the header 'desktop' cart button.
   */
  function sasabudi_header_desktop_cart() {

    // Build desktop cart
    echo '<div class="header-desktop__cart">';
      if( is_cart() || is_checkout() ) {
        echo '<a href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'cart' ) ) ) . '" title="' . esc_html__('View Cart', 'sasabudi') . '">';
          echo '<div class="header-desktop__cart--btn"></div>';
          echo '<div class="header-desktop__cart--count">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
        echo '</a>';
      } else {
        echo '<a href="#" title="' . esc_html__('View Cart', 'sasabudi') . '">';
          echo '<div class="header-desktop__cart--button"></div>';
          echo '<div class="header-desktop__cart--amount">' . esc_html(WC()->cart->get_cart_contents_count()) . '</div>';
        echo '</a>';
      }
    echo '</div>';
  }
}
