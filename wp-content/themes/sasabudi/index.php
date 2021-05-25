<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) exit;

// Settings
$page_id = get_the_ID();
$image_header_id = get_post_thumbnail_id( $page_id );
$image_header_alt = null;
$image_header_src = null;
$counter = 0;

// Categories
$is_homepage = is_home() == 1 ? ' class="menu-item active"' : ' class="menu-item"';
$is_lifestyle = is_category( 'lifestyle' )  == 1 ? ' class="menu-item active"' : ' class="menu-item"';
$is_community = is_category( 'community' )  == 1 ? ' class="menu-item active"' : ' class="menu-item"';
$is_homedecor = is_category( 'homedecor' )  == 1 ? ' class="menu-item active"' : ' class="menu-item"';
$is_features = is_category( 'features' )  == 1 ? ' class="menu-item active"' : ' class="menu-item"';
$is_art = is_category( 'art' )  == 1 ? ' class="menu-item active"' : ' class="menu-item"';

if( !is_front_page() ) :
  $image_header_src = wp_get_attachment_url($image_header_id);
  $image_header_alt = get_post_meta($image_header_id, '_wp_attachment_image_alt', true);
endif;

get_header();

  echo '<main class="main">';
    echo '<div class="blog">';

      if ( have_posts() ) :

        // Blog hero image
        echo '<header class="blog-hero">';
          echo '<figure class="blog-hero__figure">';
            echo '<div class="blog-hero__figure--white"></div>';
            echo '<div class="blog-hero__figure--image lazy-bg" style="background-image: url(' . esc_url($image_header_src) . ')" width="100%" heigth="100%" alt="' . $image_header_alt . '">';
              echo '<div class="blog-hero__container">';
                $categories = get_the_category();
                if ( $categories ) {
                  echo '<h3>' . esc_html__( $categories[0]->name ) . '</h3>';
                }
                echo '<h2>' . get_the_title() . '</h2>';
                echo '<h4>' . esc_html__('We All Love Mugs - SASABUDI', 'sasabudi') . '</h4>';
                echo '<a href="' . get_permalink() . '" class="button read-more">' . esc_html__('Read More', 'sasabudi') . '</a>';
              echo '</div>';
            echo '</div>';
          echo '</figure>';
        echo '</header>';

        // Blog nav
        echo '<div class="blog-header">';
          echo '<div class="is-wrapper">';
            echo '<div class="blog-header__menu">';
              echo '<nav class="nav">';
                echo '<ul>';
                  echo '<li' . $is_homepage . '><a href="' . esc_url(home_url('/blog/')) . '">' . esc_html__( 'Homepage', 'sasabudi' ) . '</a></li>';
                  echo '<li' . $is_lifestyle . '><a href="' . esc_url(home_url('/category/lifestyle/')) . '">' . esc_html__( 'Lifestyle', 'sasabudi' ) . '</a></li>';
                  echo '<li' . $is_community . '><a href="' . esc_url(home_url('/category/community/')) . '">' . esc_html__( 'Community', 'sasabudi' ) . '</a></li>';
                  echo '<li' . $is_homedecor . '><a href="' . esc_url(home_url('/category/homedecor/')) . '">' . esc_html__( 'Home Decor', 'sasabudi' ) . '</a></li>';
                  echo '<li' . $is_features . '><a href="' . esc_url(home_url('/category/features/')) . '">' . esc_html__( 'Features', 'sasabudi' ) . '</a></li>';
                  echo '<li' . $is_art . '><a href="' . esc_url(home_url('/category/art/')) . '">' . esc_html__( 'Art', 'sasabudi' ) . '</a></li>';
                echo '</ul>';
              echo '</nav>';
            echo '</div>';
            echo '<div class="blog-header__search">';
              echo '<div class="search-bar">';
                echo '<a href="#" class="search-bar__toggle">';
                  echo '<i class="icon is-search"></i>';
                echo '</a>';
                echo '<form class="search-bar__form" role="search" method="get" action="/">';
                  echo '<input class="search-bar__input" placeholder="Search Blog..." id="s" name="s">';
                echo '</form>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';

        // Blog content
        echo '<div class="blog-articles">';

          while ( have_posts() ) : the_post();

            if ( $counter > 0 ) { // Show all except first one!

              // Margin settings
              $leftmargin = $counter % 3 == 1 ? ' is-start' : '';
              $middlemargin = $counter % 3 == 2 ? ' is-middle' : '';
              $rightmargin = $counter % 3 == 0 ? ' is-end' : '';

              // Get the image object returned by ACF
              $image_object = get_field('wp_excerpt_image'); 
              $image_size   = 'medium';
              $image_id     = $image_object['ID'];
              $image_alt    = get_post_meta($image_id, '_wp_attachment_image_alt', true);
              $image_url    = $image_object['sizes'][$image_size];

              echo '<article class="article' . $leftmargin . '' . $middlemargin . '' . $rightmargin . '">';
                
                // Thumbnail
                echo '<a href="' . get_permalink() . '">';
                  echo '<figure class="article-thumbnail">';
                    echo '<div class="article-thumbnail__white"></div>';
                    echo '<div class="article-thumbnail__image lazy-bg" style="background-image:url(https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png)" width="100%" heigth="100%" alt="' . $image_alt . '" data-src="' . $image_url . '"></div>';
                  echo '</figure>';
                echo '</a>';
                
                // Category
                the_category();
                
                // Title
                the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                
                // Excerpt
                echo '<p>' . wp_trim_words(get_the_excerpt(), 15) . ' </p>';
                
                // More
                echo '<p><a class="read_more primary-link" href="' . get_permalink() . '">' . esc_html__('Read More', 'sasabudi') . '</a> <span class="post-date">' . get_the_time('m/j/y') . '</span></p>';

              echo '</article>';
            }

            $counter ++;

          endwhile;
          
        echo '</div>';

      else :

        // Empty blog content
        echo '<div class="is-wrapper is-empty">';
          echo '<h2 >' . esc_html__('Oops! Nothing to see here.', 'sasabudi') . '</h2>';
          echo '<p>' . esc_html__("Unfortunately we can't find the page you've requested. This could be because it has been moved, taken down or the address has been entered incorrectly.", 'sasabudi') . '</p>';
          echo '<div class="empty-back">';
            echo '<a href="' . esc_url(home_url()) . '" class="button btn-short">' . esc_html__( 'Go back to Home', 'sasabudi' ) . '</a>';
          echo '</div>';
        echo '</div>';

      endif;

    echo '</div>';
  echo '</main>';

get_footer();