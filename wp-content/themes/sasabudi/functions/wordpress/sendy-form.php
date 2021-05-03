<?php
/**
 * WP Sendy Form
 *
 * @package sasabudi
 */

if ( ! function_exists( 'sasabudi_footer_newsletter_subscribe' ) ) {
  
  /**
   * Saves the 'signup form' data and returns a message.
   */
  function sasabudi_footer_newsletter_subscribe() {

    // header("Access-Control-Allow-Origin: *");

    /* Query data from ajax and strip all tags */
    $name 		= wp_strip_all_tags($_POST['sname']);
    $email 		= wp_strip_all_tags($_POST['semail']);
    $terms 		= wp_strip_all_tags($_POST['sterms']);

    // Set form return messages
    $invalid_name         = __("Your name cannot be blank.", "sasabudi");
    $invalid_email        = __("Your email address is invalid", "sasabudi");
    $invalid_terms        = __("Please read and accept the Privacy Policy to proceed with your message.", "sasabudi");
    $invalid_list_id      = __("Your list ID is invalid.", "sasabudi");
    $invalid_subscribed   = __("You're already subscribed!", "sasabudi");
    $network_error        = __("Sorry, unable to subscribe. Please try again later!", "sasabudi");
    $success_message      = __("Thanks. You're subscribed!", "sasabudi");
    
    // Evaluate name
    if(empty($name)) {
      $response = ['form_error', 'error_name', $invalid_name];
      wp_send_json_success($response);
    }

    // Evaluate email
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $response = ['form_error', 'error_email', $invalid_email];
      wp_send_json_success($response);
    }

    // Evaluate terms
    if($terms !== '1') {
      $response = ['form_error', 'error_terms', $invalid_terms];
      wp_send_json_success($response);
    }

    /**
     * Sendy settings:
     */
    $sendy_url 	= 'https://sendy.sasabudi.com';
    $api_key 	  = get_field('sendy_api_key', 'option');
    $list 		  = get_field('sendy_list_key', 'option');
    $domain		  = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "";
    $date		    = strftime('%b %d, %G', time());
    $referrer 	= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
    $country	  = get_user_geo_country();
    $language	  = get_locale();
    $ipaddress	= get_user_ip_address();
      
    // Subscribe
    $postdata = http_build_query(
      array(
        'name' => $name,
        'email' => $email,
        'Domain' => $domain,
        'Date' => $date,
        'Referrer' => $referrer,
        'Country' => $country,
        'IPAddress' => $ipaddress,
        'Language' => $language,
        'list' => $list,
        'api_key' => $api_key,
        'gdpr' => 'true',
        'boolean' => 'true'
      )
    );

    $opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
    $context  = stream_context_create($opts);
    $result = file_get_contents($sendy_url.'/subscribe', false, $context);

    if($result)
    {
      if($result == "Some fields are missing.")
      {
        $response = ['form_error', 'error_name', $invalid_name];
        wp_send_json_success($response);
      }
      else if($result == "Invalid email address.")
      {
        $response = ['form_error', 'error_email', $invalid_email];
        wp_send_json_success($response);
      }
      else if($result == "Invalid list ID.")
      {
        $response = ['form_error', 'error_listid', $invalid_list_id];
        wp_send_json_success($response);
      }
      else if($result == "Already subscribed.")
      {
        $response = ['form_error', 'error_subscribed', $invalid_subscribed];
        wp_send_json_success($response);
      }
      else
      {
        /** 
         * Success action.
         * Send back argument and show a 'confirm email' overlay!
         */
        $response = ['form_success', 'success', $success_message];
        wp_send_json_success($response);
      }
    }
    else
    {
      $response = ['form_error', 'error_network', $network_error];
      wp_send_json_success($response);
    }

    die();
   }
}

?>
