<?php
/**
 * WC custom functions
 *
 * Shows the correct hreflang Tags in the header (not used yet)
 * Share Link Functionallity
 *
 * @package sasabudi
 */

// -----------------------------------------------------------------------------
// Shows the correct hreflang Tags in the header
// -----------------------------------------------------------------------------
if ( ! function_exists( 'sasabudi_hreflang' ) ) {

  function sasabudi_hreflang() {

    /** Get translation amount */
    $page_id = sasabudi_page_id();
    $num_translations = get_field('shop_website_translation', $page_id);

    /** Instagram */
    if ( is_post_type_archive( 'instagram' ) ) {
      echo '<link rel="alternate" href="https://sasabudi.com/instashop" hreflang="x-default" />';
      echo '<link rel="alternate" href="https://sasabudi.com/instashop" hreflang="en" />';
      echo '<link rel="alternate" href="https://sasabudi.com/de/instashop" hreflang="de" />';
    }

    /** Collections */
    elseif ( is_post_type_archive( 'collections' ) ) {
      echo '<link rel="alternate" href="https://sasabudi.com/collections" hreflang="x-default" />';
      echo '<link rel="alternate" href="https://sasabudi.com/collections" hreflang="en" />';
      echo '<link rel="alternate" href="https://sasabudi.com/de/kollektionen" hreflang="de" />';
    }

    /** Product Categories & Product Tags */
    elseif ( is_product_category() || is_product_tag() ) {
      // Retrieve saved values
      $queried_object = get_queried_object();
      $taxonomy = $queried_object->taxonomy;
      $term_id = $queried_object->term_id;
      // ACF repeater field on a taxonomy template
      while(the_repeater_field('shop_website_translation', $taxonomy . '_' . $term_id)): 
        if(get_sub_field('shop_translation_url', $taxonomy . '_' . $term_id)):
          $shop_iso = get_sub_field('shop_hreflang', $queried_object);
          $translation_url = get_sub_field('shop_translation_url', $queried_object);
          if($shop_iso == 'en') {
            echo '<link rel="alternate" href="' . $translation_url . '" hreflang="x-default" />';
          }
          echo '<link rel="alternate" href="' . $translation_url . '" hreflang="' . $shop_iso . '" />';
        endif;
      endwhile;
    }

    /** Übersicht Seiten & co. */
    elseif ( $num_translations > 0 ) {
      while ( have_rows('shop_website_translation') ) : the_row();
        $shop_iso = get_sub_field('shop_hreflang');
        $translation_url = get_sub_field('shop_translation_url');
        if($shop_iso == 'en') {
          echo '<link rel="alternate" href="' . $translation_url . '" hreflang="x-default" />';
        }
        echo '<link rel="alternate" href="' . $translation_url . '" hreflang="' . $shop_iso . '" />';
      endwhile;
    }
    
    else {
      // Show default values when no translation data
      echo '<link rel="alternate" href="https://sasabudi.com" hreflang="x-default" />';
      echo '<link rel="alternate" href="https://sasabudi.com" hreflang="en" />';
      echo '<link rel="alternate" href="https://sasabudi.com/de/" hreflang="de" />';
    }
  }
}


// -----------------------------------------------------------------------------
// Share Link Functionallity
// -----------------------------------------------------------------------------
if ( ! function_exists( 'sasabudi_share_link' ) ) {
  function sasabudi_share_link( $social, $posttitle, $postcontent, $media, $shortlink, $hashtag1, $hashtag2 ) {
    
    $socialUrl 		      = '';
    $sasabudiUrl 	      = rawurlencode( $shortlink );
    $twitterTitle 	    = rawurlencode( $posttitle . ' | SASABUDI');
    $twitterAccount 	  = rawurlencode( 'sasabudi' );
    $pinterestSubject   = rawurlencode( '"' . $posttitle . '" - ' . $postcontent );
    $bufferTitle 	      = rawurlencode( $posttitle . ' | SASABUDI');
    $emailSubject 	    = rawurlencode( 'Look at this ... 👀' );
    $emailBody          = $sasabudiUrl;

    switch ( $social ) {
      case 'facebook':
        $socialUrl = add_query_arg( 
          array(
            'u' => $sasabudiUrl,
            'hashtag' => rawurlencode( $hashtag1 )
          ),
          'https://www.facebook.com/sharer/sharer.php'
        );
      break;
      case 'twitter':
        $socialUrl = add_query_arg( 
          array(
            'text' => $twitterTitle,
            'url' => $sasabudiUrl,
            'via' => $twitterAccount
          ),
          'https://twitter.com/intent/tweet'
        );
      break;
      case 'pinterest':
        $socialUrl = add_query_arg( 
          array(
            'url' => $sasabudiUrl,
            'media' => $media,
            'description' => $pinterestSubject
          ),
          'https://www.pinterest.com/pin/create/button/'
        );
      break;
      case 'buffer':
        $socialUrl = add_query_arg( 
          array(
            'url' => $sasabudiUrl,
            'text' => $bufferTitle
          ),
          ' https://buffer.com/add'
        );
      break;
      case 'tumblr':
        $socialUrl = add_query_arg( 
          array(
            'url' => $sasabudiUrl
          ),
          'https://plus.google.com/share'
        );
      break;
      case 'messenger':
        $socialUrl = add_query_arg( 
          array(
            'link' => $sasabudiUrl . '#step=design'
          ),
          'fb-messenger://share'
        );
      break;
      case 'whatsapp':
        $socialUrl = add_query_arg( 
          array(
            'text' => $sasabudiUrl . '#step=design'
          ),
          'whatsapp://send'
        );
      break;	
      case 'email':
        $socialUrl = add_query_arg( 
        array(
          'subject' => $emailSubject,
          'body' => $emailBody
        ),
        'mailto:'
      );
      break;
      default:
      break;
    }
    return $socialUrl;
    die();
  }
}