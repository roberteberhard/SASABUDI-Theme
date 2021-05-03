<?php
/**
 * WP Contact From
 *
 * @package sasabudi
 */

if ( ! function_exists( 'sasabudi_execute_contact_form_message' ) ) {

  /**
   * Saves and sends the 'contact form' data and returns a message.
   */
  function sasabudi_execute_contact_form_message() {

    // retrieve ajax contact form data
    $js_data    = $_POST;
    $firstname   = wp_strip_all_tags($js_data['mfirstname']);
    $lastname   = wp_strip_all_tags($js_data['mlastname']);
    $email      = wp_strip_all_tags($js_data['memail']);
    $subject    = wp_strip_all_tags($js_data['msubject']);
    $message    = wp_strip_all_tags($js_data['mtext']);
    $terms      = wp_strip_all_tags($js_data['mterms']);
    $captcha    = $js_data['mcaptcha'];

    // set form return messages
    $invalid_verification  = __("Verification failed, please try again!", "sasabudi");
    $invalid_firstname     = __("First Name cannot be blank", "sasabudi");
    $invalid_lastname     = __("Last Name cannot be blank", "sasabudi");
    $invalid_email        = __("Email address is invalid", "sasabudi");
    $invalid_subject      = __("Subject cannot be blank", "sasabudi");
    $invalid_message      = __("Message cannot be blank", "sasabudi");
    $invalid_terms        = __("Please read and accept the Terms of Service to proceed with your message", "sasabudi");
    $success_message      = __("Thanks! Your message has been sent.", "sasabudi");
    $network_error        = __("Message was not sent. Please try again!", "sasabudi");

    // evaluate firstname
    if(empty($firstname)) {
      $response = ['form_error', 'error_firstname', $invalid_firstname];
      wp_send_json_success($response);
    }
    // evaluate lastname
    if(empty($lastname)) {
      $response = ['form_error', 'error_lastname', $invalid_lastname];
      wp_send_json_success($response);
    }

    // evaluate email
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $response = ['form_error', 'error_email', $invalid_email];
      wp_send_json_success($response);
    }

    // evaluate subject
    if(empty($subject)) {
      $response = ['form_error', 'error_subject', $invalid_subject];
      wp_send_json_success($response);
    }

    // evaluate message
    if(empty($message)) {
      $response = ['form_error', 'error_message', $invalid_message];
      wp_send_json_success($response);
    }

    // evaluate terms
    if($terms !== '1') {
      $response = ['form_error', 'error_terms', $invalid_terms];
      wp_send_json_success($response);
    }
    
    /**
     * reCaptch verification
     */
    if (isset($captcha)) {

      // Build POST request:
      $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
      $recaptcha_secret = '6LfZWKcZAAAAAIlGQUeUK3pvjuynw3alvxOGaryA';
      $recaptcha_response = $captcha;

      // Make and decode POST request:
      $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
      $recaptcha = json_decode($recaptcha);

      // Return invalid human error message if low score returned
      if ($recaptcha->score < 0.5) {
        $response = ['form_error', 'error_recaptcha', $invalid_verification];
        wp_send_json_success($response);
      }
    
    } else {

      // Return invalid human error message
      $response = ['form_error', 'error_recaptcha', $invalid_verification];
      wp_send_json_success($response);
    }

    // Concardinate subject & message
    $message_body = '<p>' . $subject . '</p>';
    $message_body .= '<p>' . $message . '</p>';

    // post arguments to save
    $args = array(
      'post_title'    => $firstname . ' ' . $lastname,
      'post_content'  => $message_body,
      'post_author'   => 2,
      'post_status'   => 'publish',
      'post_type'     => 'sasabudi-contact',
      'meta_input'    => array(
        '_contact_email_value_key' => $email
      )
    );

    // retrieve post id after saving
    $postID = wp_insert_post($args);

    if ($postiD !== 0) {

      global $phpmailer;

      if ( !is_object( $phpmailer ) || !is_a( $phpmailer, 'PHPMailer' ) ) { 
        require_once ABSPATH . WPINC . '/class-phpmailer.php';
        require_once ABSPATH . WPINC . '/class-smtp.php';
        $phpmailer = new PHPMailer( true );
      }

      try {
        $phpmailer->ClearCustomHeaders();
        $phpmailer->ClearReplyTos();
        $phpmailer->ClearAllRecipients();
        $phpmailer->AddAddress(get_bloginfo('admin_email'), get_bloginfo('name'));
        $phpmailer->SetFrom(get_bloginfo('admin_email'), get_bloginfo('name'));
        $phpmailer->AddReplyTo($email, $firstname . ' ' . $lastname);
        $phpmailer->SingleTo = true;
        $phpmailer->Subject = 'Sasabudi Contact Form | ' . $firstname . ' ' . $lastname;
        $phpmailer->CharSet = 'utf-8';
        $phpmailer->ContentType = 'text/html';
        $phpmailer->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
        $phpmailer->MsgHTML($message_body);
        // $phpmailer->MsgHTML(file_get_contents('contents.html'));
        // $phpmailer->ClearAttachments(); // clear all previous attachments if exist
        $phpmailer->Send();

        // send back success message
        $response = ['form_success', 'success', $success_message];
        wp_send_json_success($response);

      } catch (phpmailerException $e) {

        // Pretty error messages from PHPMailer
        $response = ['form_error', 'error_network', $e->errorMessage()];
        wp_send_json_success($response);

      } catch (Exception $e) {
        // Boring error messages from anything else!
        $response = ['form_error', 'error_network', $e->getMessage()];
        wp_send_json_success($response);
      }

    } else {

      // network error
      $response = ['form_error', 'error_network', $network_error];
      wp_send_json_success($response);
    }

    die();
  }
}
?>
