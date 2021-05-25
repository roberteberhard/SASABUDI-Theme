<?php
/**
 * The template functions used for displaying the 'offset' definitions.
 * 
 * - sasabudi_offset_menu
 * - sasabudi_offset_filters
 * - sasabudi_offset_cart
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_offset_menu' ) ) {

  /**
   * Shows the 'menu' in the left offset bar.
   */
  function sasabudi_offset_menu() {

    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Build left offset navigation
      echo '<nav class="offset-left__nav">';
      
        echo '<div class="offset-left__head">';
          
          // Close button
          echo '<div class="offset-left__close">';
            echo '<a href="#">';
              echo '<div class="offset-left__close--button">Close</div>';
            echo '</a>';
          echo '</div>';
          
          // User login
          echo '<div class="offset-left__login">';
            if ( is_user_logged_in() ) {
              $current_user = get_userdata(get_current_user_id());
              echo '<a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '">';
                echo '<div class="offset-left__login--link">' . esc_html__('Hi,', 'sasabudi') . ' ' . esc_html( $current_user->display_name ) . '</div>';
              echo '</a>';
            } else {
              echo '<a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '">';
                echo '<div class="offset-left__login--link">' . esc_html__('Sign In', 'sasabudi') . '</div>';
              echo '</a>';
            }
          echo '</div>';

          /**
           * This works together with store-selection.js component!!
           */

          // Settings
          $shipping_amount  = '';	
          $shipping_method  = '';	
          $cookie_country   = '';
          $cookie_name      = 'wp_store_selector_UgNz4K';
          $cookie_value     = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name]: null; 

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

          // Store selector
          echo '<a href="#" class="offset-left__selector' . $cookie_country . '">';
            echo '<div class="location-flag">' . esc_html__('Your Location', 'sasabudi') . '</div>';
          echo '</a>';

        echo '</div>';

        // Build left menus
        echo '<div class="offset-left__menu">';

          wp_nav_menu(array(
            'theme_location'  => 'mobile',
            'fallback_cb'     => false,
            'container'       => false,
            'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
          ));

            // Build support section
          echo '<ul id="menu-mobile-support">';
            echo '<li class="menu-item wishlist"><a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '/saved-items/">' . esc_html__('Wishlist', 'sasabudi') . '</a></li>';
            if ( is_user_logged_in() ) {
              echo '<li class="menu-item myaccount"><a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '">' . esc_html__('My Account', 'sasabudi') . '</a></li>';
            } else {
              echo '<li class="menu-item myaccount"><a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '">' . esc_html__('Sign In', 'sasabudi') . '</a></li>';
            }
            echo '<li class="menu-item helpcenter"><a href="' . esc_url(home_url('/help/faqs/')) . '">' . esc_html__('Help Center', 'sasabudi') . '</a></li>';
            echo '<li class="menu-item policies"><a href="' . esc_url(home_url('/policies/terms-of-service/')) . '">' . esc_html__('Policies', 'sasabudi') . '</a></li>';
          echo '</ul>';
          
        echo '</div>';

        // Build social section
        echo '<div class="offset-left__social">';
          echo '<ul class="offset-left__list">';
            echo '<li class="offset-left__list--brand"><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html__('Sasabudi', 'sasabudi') . '</a></li>';
            
            // Arguments
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
            if ( $facebook ) echo('<li><a href="' . $facebook . '" target="_blank"><span class="offset-left__list--link svg--facebook"></span>Facebook</a></li>' );
            if ( $twitter ) echo('<li><a href="' . $twitter . '" target="_blank"><span class="offset-left__list--link svg--twitter"></span>Twitter</a></li>' );
            if ( $tumblr ) echo('<li><a href="' . $tumblr . '" target="_blank"><span class="offset-left__list--link svg--tumblr"></span>Tumblr</a></li>' );
            if ( $pinterest ) echo('<li><a href="' . $pinterest . '" target="_blank"><span class="offset-left__list--link svg--pinterest"></span>Pinterest</a></li>' );
            if ( $instagram ) echo('<li><a href="' . $instagram . '" target="_blank"><span class="offset-left__list--link svg--instagram"></span>Instagram</a></li>' );
            if ( $snapchat ) echo('<li><a href="' . $snapchat . '" target="_blank"><span class="offset-left__list--link svg--snapchat"></span>Snapchat</a></li>' );
            if ( $youtube ) echo('<li><a href="' . $youtube . '" target="_blank"><span class="offset-left__list--link svg--youtube"></span>YouTube</a></li>' );			
          
          echo '</ul>';
        echo '</div>';

      echo '</nav>';

    endif;
  }
}

if ( ! function_exists( 'sasabudi_offset_filters' ) ) {
  /**
   * Shows the 'product filters' in the left offset bar.
   */
  function sasabudi_offset_filters() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

			$url = $_SERVER['REQUEST_URI'];
			$link = strtok($url, '?');
      $reset = strpos($url, '?');
      $shorten = $reset ? ' shorten' : '';
      
      echo '<nav class="offset-left__filter" id="filter-menu">';
        
        // Head
        echo '<div class="offset-left__head">';

            // Close button
          echo '<div class="offset-left__close">';
            echo '<a href="#" class="offset-left__close--button">Close</a>';
          echo '</div>';
          
          // Ordering
          echo '<div class="offset-left__ordering' . $shorten . '">';

            /**
             * sasabudi_offset_catalog_ordering hook.
             *
             * @hooked woocommerce_catalog_ordering - 10
             */
            do_action( 'sasabudi_offset_catalog_ordering' );

          echo '</div>';

          if ( $reset ) {
            echo '<div class="offset-left__clear">';
              echo '<a class="offset-left__clear--all" href="' . $link .'">' . esc_html__('Clear All', 'sasabudi') . '</a>';
            echo '</div>';
          }
                
        echo '</div>';
	 
				// Sidebar Filter Attributes
        dynamic_sidebar( 'sidebar-filters');
        
      echo '</nav>';
      
    endif;

  }
}

if ( ! function_exists( 'sasabudi_offset_cart' ) ) {

  /**
   * Shows the 'mini cart widget' in the right offset bar.
   */
  function sasabudi_offset_cart() {
    if ( SASABUDI_WOOCOMMERCE_IS_ACTIVE ) :

      // Build offset cart
      if ( is_active_sidebar( 'sidebar-cart' ) ) :
        dynamic_sidebar( 'sidebar-cart' );
      endif;
    endif;
  }
}
