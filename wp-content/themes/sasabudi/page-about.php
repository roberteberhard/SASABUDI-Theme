<?php
/**
 * The template for displaying the 'about-us' page.
 *
 * Template name: Page-About
 * 
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

get_header();

  echo '<main class="main is-about" role="main">';

    // Settings
    $page_id    = get_the_ID();
    $image_id   = get_post_thumbnail_id($page_id); 
    $image_alt  = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    $image_url  = "";

    // Toggle between Thumbnai(l and Template image.
    if (has_post_thumbnail()) {
      $image_url = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) );
    } else {
      // $image_url = get_theme_file_uri("./images/sasabudi-header-about-template.png");
      $image_url = "https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-header-about-template.png";
    }

    // About Header
    echo '<header class="about-header">';
      echo '<figure class="about-header__figure">';
        echo '<div class="about-header__figure--banner" style="background-image: url(' . esc_url($image_url) . ')" width="100%" heigth="100%" alt="' . $image_alt . '">';
          echo '<div class="about-header__container">';
            echo '<h3>' . esc_html__('Welcome to SASABUDI', 'sasabudi') . '</h3>';
            echo '<h1>' . esc_html__('About Us', 'sasabudi') . '</h1>';
            echo '<h4>' . esc_html__('We All Love Mugs - SASABUDI', 'sasabudi') . '</h4>';
          echo '</div>';
        echo '</div>';
      echo '</figure>';
    echo '</header>';


    echo '<div class="about">';
      echo '<div class="is-wrapper">'; 

        // Primary
        echo '<article class="about-article primary">';

          echo '<div class="about-article__desc">';
            echo '<h2 class="sub-title">' . esc_html__('Our Story', 'sasabudi') . '</h2>';
            echo '<p class="sub-heading">' . esc_html__('I have always loved coffee mugs. So I always had my favorite mugs around me. Not only for drinking, but also as a holder for brushes, pens and all the little things an artist needs in a studio. And important to me, as with the T-shirts, were the motifs for them. For me this usually resulted in an extra portion of motivation. Years later I slowly started to create my own mug designs under my label SASABUDI.', 'sasabudi') . '</p>';
          echo '</div>';

          echo '<figure class="about-article__image">';
            echo '<div class="about-article__bkg">';
              echo '<img class="lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="SASABUDI - About Us" data-src="' . get_theme_file_uri("./images/sasabudi-about-us.jpg") . '">';
            echo '</div>';
          echo '</figure>';

        echo '</article>';

        // Quote
        echo '<article class="about-quote">';
          echo '<div class="about-quote__desc">' . esc_html__('It\' all about you. With our mugs we want to bring out the best in you. We want you to get an extra portion of motivation, a big smile or just go out and make it happen. This is SASABUDI\'s founding philosopy.', 'sasabudi') . '</div>';
          echo '<div class="about-quote__signature">' . esc_html__('Robert Eberhard, founder', 'sasabudi') . '</div>';
        echo '</article>';
                          
        // Secondary          
        echo '<article class="about-article secondary">';  

          echo '<figure class="about-article__image">';
            echo '<div class="about-article__bkg">';
              echo '<img class="lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="SASABUDI - Our Story" data-src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-about-our-story.jpg">';
            echo '</div>';
          echo '</figure>';

          echo '<div class="about-article__desc">';
            echo '<h2 class="sub-title">' . esc_html__('Founder\'s Note' , 'sasabudi') . '</h2>';
            echo '<p class="sub-heading">'. __('Many years ago, when I was traveling through Thailand with my backpack, I noticed an expression from the locals: Same Same But Different. For example, you could order a Coke and it was quite possible that a Sprite followed. And when you looked surprised, the answer was: „Same Same But Different". I found this slogan suitable for commercial art. Because nowadays it is hard to create something complitely new and unique. Out of this expression the label <strong>SASABUDI</strong> was born.', 'sasabudi') . '</p>';
            echo '</div>';

        echo '</article>'; 

        // Ternary
        echo '<article class="about-article ternary">';

          echo '<div class="about-article__desc">';
            echo '<h2 class="sub-title">' . esc_html__('Our Products', 'sasabudi') . '</h2>';
            echo '<p class="sub-heading">';
              echo esc_html__('SASABUDI works with selected production partners in the USA, Europe, Japan and Australia. Our products are authentic and inspiring works of art that are worthy of becoming your favorite pieces. We use the latest printing techniques, environmentally friendly inks and high-quality materials. The products are custom made and individually printed when you order them. ', 'sasabudi');
              echo '<br/><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '" class="link-explore">' . esc_html__('Explore now', 'sasabudi') . '</a>';
            echo '</p>';
          echo '</div>';

          echo '<figure class="about-article__image">';
            echo '<div class="about-article__bkg">';
              echo '<img class="lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="SASABUDI - Our Products" data-src="https://sasabudi.com/wp-content/uploads/2021/01/sasabudi-about-our-products.gif">';
            echo '</div>';
          echo '</figure>';

        echo '</article>';
        
      echo '</div>';

    echo '</div>';

    /**
     * @hooked :: sasabudi_products_catalog_featuring - 10
     * @hooked :: sasabudi_home_products_statement - 20
     */
    do_action( 'sasabudi_render_about_page' );       

  echo '</main>';

get_footer();