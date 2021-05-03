
<?php
/**
 * The template part for the 'account' section.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0
 */

echo '<h1 class="support-content__title">';
  echo esc_html__( 'Account', 'sasabudi' );
echo '</h1>';

echo '<section class="support-section">';

  echo '<h2 class="support-section__title">' . esc_html__( 'Customer Account', 'sasabudi' ) . '</h2>';

  echo '<div class="support-faq" role="tablist">';

    /**
     * Question 01
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How do I create an account?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            echo esc_html__( 'You can create your own customer account via the main menu or after placing an order as a guest. This way you can view all information and data about your orders at any time.', 'sasabudi' );
          echo '</p>';
          echo '<p>';
            echo esc_html__( 'Click the person-shaped icon in the top right corner of the main menu (if you use a mobile device, you can find it in the menu that opens with the hamburger button).  Click the create account button and then fill out the required fields.', 'sasabudi' );
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'When you place an order as a guest, we will ask you on the checkout page if you want to create an account. Check the appropriate checkbox and enter your password. You will then receive a confirmation email. You now have access to your customer account!', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 02
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'What if I forgot my password?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting">';
            printf(__( 'You have forgotten your password? That\'s no problem. You can request a new password by clicking on the "Login" button and then on the "Forgot your password?" link or simply click  %s. You will receive a link to create a new password via email.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/my-account/lost-password/')) . '">here</a>');
          echo '</p>';
          echo '<p class="ending">';
            echo esc_html__( 'Are you having trouble logging into your account? This does not necessarily mean that you have forgotten your password. See if you ordered as a guest and did not create an account.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';
    
    /**
     * Question 03
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'What if I entered a wrong email address?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            printf(__( 'You can easily change your email address in your customer account by clicking %s. Unfortunately, this does not apply to current orders, but only to future orders.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/my-account/edit-account/')) . '">here</a>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 04
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'What about data protection?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__( 'Don\'t worry, we value data protection. Your data will be treated confidentially and will not be shared with third parties.', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 05
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How to delete my customer account?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';;
          echo '<p class="starting ending">';
            printf(__( 'To cancel your account with us, just %s us and we will take care of everything. It hurts us to let you go, but we hope you will come back to SASABUDI soon.', 'sasabudi' ), '<a class="primary-link" href="' . esc_url(home_url('/help/contact')) . '">contact</a>');
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

    /**
     * Question 06
     */
    echo '<div class="section-faq">';
      echo '<div class="section-faq-header">';
        echo '<h3 class="section-faq-header__title">' . esc_html__( 'How to unsubscribe from the newsletter?', 'sasabudi' ) . '</h3>';
      echo '</div>';
      echo '<div class="section-faq-feature">';
        echo '<div class="section-faq-feature__notice">';
          echo '<p class="starting ending">';
            echo esc_html__('This makes us really sad, but we\'ll let you go. Just scroll to the bottom of the newsletter and click: "If you no longer wish to receive these emails, click here" or "Unsubscribe".', 'sasabudi' );
          echo '</p>';
        echo '</div>'; 
      echo '</div>';
    echo '</div>';

  echo '</div>';
echo '</section>';
