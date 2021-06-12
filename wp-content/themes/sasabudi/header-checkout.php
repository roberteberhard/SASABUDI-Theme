       <?php
/**
 * Header file for the SASABUDI WordPress default theme.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

  if( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="google" content="notranslate">
<meta name="viewport" content="width=device-width, initial-scale=1.0" ></script>
<?php wp_head(); ?>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/barlow-semi-condensed/barlow-semi-condensed-v6-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/barlow-semi-condensed/barlow-semi-condensed-v6-latin-500.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/barlow-condensed/barlow-condensed-v5-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/barlow-condensed/barlow-condensed-v5-latin-700.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/serif/pt-serif-v12-latin-italic.woff2" as="font" type="font/woff2" crossorigin>
<link rel="logo" type="image/png" href="<?php echo esc_url(site_url('/wp-data/icons/sasabudi.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-57x57.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-114x114.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-72x72.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-144x144.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-60x60.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-120x120.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-76x76.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-152x152.png')); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo esc_url(site_url('/wp-data/icons/apple-touch-icon-180x180.png')); ?>" />
<link rel="icon" type="image/png" href="<?php echo esc_url(site_url('/wp-data/icons/favicon-196x196.png')); ?>" sizes="196x196" />
<link rel="icon" type="image/png" href="<?php echo esc_url(site_url('/wp-data/icons/favicon-96x96.png')); ?>" sizes="96x96" />
<link rel="icon" type="image/png" href="<?php echo esc_url(site_url('/wp-data/icons/favicon-32x32.png')); ?>" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo esc_url(site_url('/wp-data/icons/favicon-16x16.png')); ?>" sizes="16x16" />
<link rel="icon" type="image/png" href="<?php echo esc_url(site_url('/wp-data/icons/favicon-128x128.png')); ?>" sizes="128x128" />
<link rel="shortcut icon" href="<?php echo esc_url(site_url('/wp-data/icons/favicon.ico')); ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo esc_url(site_url('/wp-data/icons/favicon.ico')); ?>" />
<link rel="mask-icon" href="<?php echo esc_url(site_url('/wp-data/icons/safari-pinned-tab.svg')); ?>" color="#ff5b2d" />
<link rel="manifest" href="<?php echo esc_url(site_url('/site.webmanifest')); ?>" />
<meta name="theme-color" content="#FF5B2D">
<meta name="application-name" content="SASABUDI" />
<meta name="msapplication-TileColor" content="#FF5B2D" />
<meta name="msapplication-TileImage" content="<?php echo esc_url(site_url('/wp-data/icons/mstile-144x144.pn')); ?>" />
<meta name="msapplication-square70x70logo" content="<?php echo esc_url(site_url('/wp-data/icons/mstile-70x70.png')); ?>" />
<meta name="msapplication-square150x150logo" content="<?php echo esc_url(site_url('/wp-data/icons/mstile-150x150.png')); ?>" />
<meta name="msapplication-wide310x150logo" content="<?php echo esc_url(site_url('/wp-data/icons/mstile-310x150.png')); ?>" />
<meta name="msapplication-square310x310logo" content="<?php echo esc_url(site_url('/wp-data/icons/mstile-310x310.png')); ?>" />
<meta name="msapplication-tooltip" content="Visit sasabudi.com" />
<meta name="msapplication-starturl" content="/" />
<meta name="msapplication-window" content="width=1024;height=768" />
<meta name="msapplication-config" content="<?php echo esc_url(site_url('/browserconfig.xml')); ?>" />
<?php $useremail = is_user_logged_in() ? get_userdata(get_current_user_id())->user_email : ''; ?>
<script>
window.dataLayer = window.dataLayer || [];
dataLayer.push({
  'email' : '<?php echo $useremail; ?>'
});
</script>
</head>
<body <?php body_class(); ?>>
<noscript><strong>We're sorry but spa doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript>
<?php

/* Apply maintenance modality */
sasabudi_maintenance_mode();

/* Add a promo class when Promotion is turned on */
$promotion_state = (get_field('ws_promotion_bar', 'option') == '1') ? ' promo-on' : '';

echo '<div id="app" class="app' . $promotion_state . ' modal-off">';

  /**
   * @hooked :: sasabudi_header_desktop_note - 10
   */
  do_action( 'sasabudi_header_desktop_note' );

  /** Device **/
  echo '<header class="header-device">';
    echo '<div class="header-device__wrapper">';

      /**
       * @hooked :: sasabudi_header_device_toggle - 10
       * @hooked :: sasabudi_header_device_logo - 20
       * @hooked :: sasabudi_header_device_search - 30
       * @hooked :: sasabudi_header_device_wishlist - 40
       * @hooked :: sasabudi_header_device_cart - 50
       */
      do_action( 'sasabudi_header_device_navigation' );

    echo '</div>';
  echo '</header>';

  /** Desktop **/
  echo '<header class="header-desktop">';
    echo '<div class="header-desktop__wrapper">';

     /**
      * @hooked :: sasabudi_header_desktop_logo - 10
      * @hooked :: sasabudi_header_desktop_menu - 20
      * @hooked :: sasabudi_header_desktop_search - 30
      * @hooked :: sasabudi_header_desktop_support - 40
      * @hooked :: sasabudi_header_desktop_wishlist - 50
      * @hooked :: sasabudi_header_desktop_account - 60
      * @hooked :: sasabudi_header_desktop_cart - 70
      */
    do_action( 'sasabudi_checkout_header_desktop_navigation' );

   echo '</div>';			
 echo '</header>';

  /**
   * @hooked :: sasabudi_header_device_note - 10
   */
  do_action( 'sasabudi_checkout_header_device_note' );
