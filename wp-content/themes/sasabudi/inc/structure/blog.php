<?php
/**
 * The template functions used for displaying the 'blog' definitions.
 * 
 * - sasabudi_blog_post_section
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

if ( ! function_exists( 'sasabudi_blog_post_section' ) ) {
  /**
   * Simply lists 3 random 'blog' post items and exclude current post.
   */
  function sasabudi_blog_post_section() {

    $counter = 0;

    $args = array(
	    'post_type'       => 'post',
	    'orderby'         => 'rand',
	    'posts_per_page'  => 3,
			'post__not_in'    => array(get_the_id()) // Exclude the current post
    );
    
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
	 
      echo '<div class="blog is-random">';

        echo '<div class="blog-articles">';
        
          while ( $the_query->have_posts() ) :

            $the_query->the_post();

            $counter ++;

            $leftmargin       = $counter % 3 == 1 ? ' is-start' : '';
            $middlemargin     = $counter % 3 == 2 ? ' is-middle' : '';
            $rightmargin      = $counter % 3 == 0 ? ' is-end' : '';
            
            // Get the image object returned by ACF
            $image_object = get_field('wp_excerpt_image'); 
            $image_size   = 'medium';
            $image_id     = $image_object['ID'];
            $image_alt    = get_post_meta($image_id, '_wp_attachment_image_alt', true);
            $image_url    = $image_object['sizes'][$image_size];

            echo '<article class="article randomly' . $leftmargin . '' . $middlemargin . '' . $rightmargin . '">';
              
              // Thumbnail
              echo '<a href="' . get_permalink() . '" class="article-thumbnail">';
                echo '<div class="article-thumbnail__white"></div>';
                echo '<div class="article-thumbnail__image lazy-bg" style="background-image:url(https://sasabudi.com/wp-content/uploads/2021/05/sasabudi-template.png)" width="100%" heigth="100%" alt="' . $image_alt . '" data-src="' . $image_url . '"></div>';
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

          endwhile;

        echo '</div>';

      echo '</div>';
  
      wp_reset_postdata();
  
    }
  }
}