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
global $post;
$author_id        = $post->post_author;
$page_id          = get_the_ID();
$image_header_id  = get_post_thumbnail_id( $page_id );
$image_header_alt = null;
$image_header_src = null;
$cat_slug         = '';

if( !is_front_page() ) :
  $image_header_src = wp_get_attachment_url($image_header_id);
  $image_header_alt = get_post_meta($image_header_id, '_wp_attachment_image_alt', true);
endif;

get_header();

  echo '<main class="main" role="main">';
    echo '<div class="post">';

      if ( have_posts() ) :

        // Blog hero banner
        echo '<header class="post-hero">';
          echo '<figure class="post-hero__figure">';
            echo '<div class="post-hero__figure--white"></div>';
            echo '<div class="post-hero__figure--image" style="background-image: url(' . esc_url($image_header_src) . ')" width="100%" heigth="100%" alt="' . $image_header_alt . '">';
              echo '<div class="post-hero__container">';
                
                $categories = get_the_category();
                if ( $categories ) {
                  $cat_slug = esc_html__( $categories[0]->slug );
                  echo '<h3>' . esc_html__( $categories[0]->name ) . '</h3>';
                }
                echo '<h2>' . get_the_title() . '</h2>';
                
                echo '<h4>' . esc_html__('We All Love Mugs - SASABUDI', 'sasabudi') . '</h4>';
                
                echo '<p class="post-update">by <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="author-link" rel="author">' . get_the_author_meta('display_name', $author_id) . '</a> on ' . get_the_time('F jS, Y');
                  if ( current_user_can( 'edit_posts' ) ) { 
                    echo '<span> - <a class="edit-post" href="' . get_edit_post_link( $page_id ) .' " target="_blank">Edit</a></span>';
                  }
                echo '</p>';

              echo '</div>';
            echo '</div>';
          echo '</figure>';
        echo '</header>';


        // Categories
        $is_homepage = ' class="menu-item"';
        $is_lifestyle = $cat_slug == 'lifestyle' ? ' class="menu-item active"' : ' class="menu-item"';
        $is_community = $cat_slug == 'community' ? ' class="menu-item active"' : ' class="menu-item"';
        $is_homedecor = $cat_slug == 'homedecor' ? ' class="menu-item active"' : ' class="menu-item"';
        $is_features = $cat_slug == 'features' ? ' class="menu-item active"' : ' class="menu-item"';
        $is_art = $cat_slug == 'art' ? ' class="menu-item active"' : ' class="menu-item"';

        // Post nav
        echo '<div class="post-header">';
          echo '<div class="is-wrapper">';
            echo '<div class="post-header__menu">';
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
            echo '<div class="post-header__search">';
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

      endif;


      echo '<div class="wp-block">';
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      echo '</div>';

    echo '</div>';

    /**
     * @hooked :: sasabudi_home_products_banner     - 10
     */
    do_action( 'sasabudi_render_posts_sections' ); 

  echo '</main>';

get_footer();
