<?php
/**
 * The template part for the 'contact' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

// User Post Variables
$message_text = esc_html__('This is where you can explain exactly what\'s going on. The more information you give, the better we can help you.', 'sasabudi');

echo '<h1 class="support-content__title">';
	echo esc_html__( 'Contact', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

	echo '<h2 class="support-section__title">' . esc_html__( 'Hi There!', 'sasabudi' ) . '</h2>';

	echo '<p class="msg">';
		echo esc_html__( 'We are always happy to help and answer any questions you may have about your online purchases, returns, products or any other concerns you may have.', 'sasabudi' );
	echo '</p>';

	echo '<p class="msg">';
		printf(esc_html__( 'Before submitting your request, please check our %1$s where your question may already be answered.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/faqs/')) . '">FAQ</a>');
	echo '</p>';

	echo '<p class="msg ending">';
		printf(esc_html__( 'You can either use our contact form or our email %1$s to send your request.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url('mailto:support@sasabudi.com') . '">support@sasabudi.com</a>');
	echo '</p>';

	echo '<form action="#" method="post" id="app-contact">';

		echo '<p class="form-row form-row-first">';
			echo '<label for="message_firstname">' . esc_html__('First Name', 'sasabudi') . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
			echo '<input type="text" name="message_firstname" maxlength="32">';
		echo '</p>';

		echo '<p class="form-row form-row-last">';
			echo '<label for="message_lastname">' . esc_html__('Last Name', 'sasabudi') . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
			echo '<input type="text" name="message_lastname" maxlength="32">';
		echo '</p>';

		echo '<p class="form-row">';
			echo '<label for="message_email">' . esc_html__('Your Email', 'sasabudi') . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
			echo '<input type="text" name="message_email" maxlength="64">';
		echo '</p>';

		echo '<p class="form-row">';
			echo '<label for="message_subject">' . esc_html__('Subject (please include order number, if any)', 'sasabudi') . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
			echo '<input type="text" name="message_subject" maxlength="128">';
		echo '</p>';

		echo '<p class="form-row text-area">';
			echo '<label for="message_text">' . esc_html__('Your Message', 'sasabudi') . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
			echo '<textarea type="text" name="message_text" placeholder="' . $message_text . '"></textarea>';
		echo '</p>';

		echo '<div class="g-recaptcha" data-sitekey="6LfZWKcZAAAAAHb434cxFaCzOn85y55vc4GzhtaM" data-badge="inline" data-size="invisible" data-callback="setCaptchaResponse"></div>';
		
		echo '<input type="hidden" name="recaptcha-response" id="captcha-response">';

		echo '<p class="form-row privacy">';
			echo '<label class="label-for-checkbox" for="message_terms">'; 
			echo '<input class="input-checkbox" name="message_terms" type="checkbox" id="message_terms" />';
			echo '<span>';
				printf(esc_attr__('We take our privacy very seriously. Please state that you have read and agreed to our %1$s and %2$s before your continue.', 'sasabudi'), '<a class="primary-link" href="' . esc_url(home_url('/policies/terms-of-service/')) . '" target="_blank">Terms of Service</a>', '<a class="primary-link" href="' . esc_url(home_url('/policies/privacy-policy/')) . '" target="_blank">Privacy Policy</a>');
			echo '&nbsp;<abbr class="required" title="required">*</abbr></span>';
			echo '</label>';
		echo '</p>';

		echo '<div class="form-row submit-enabled" id="contact-submit">';
			echo '<button type="submit" name="submit" class="button btn-auto">' . esc_html__('Submit Message', 'sasabudi') . '</button>';
			echo '<div class="submit-waiting"><span></span><span></span><span></span></div>';
		echo '</div>';

	echo '</form>';

echo '</section>';

?>

<script>
var onCaptchaCallback = function() {
  grecaptcha.execute();
};
function setCaptchaResponse(response) { 
  document.getElementById('captcha-response').value = response; 
};
</script>
