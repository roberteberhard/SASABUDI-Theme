/**
 * Handle the footer 'sign up' method and show a 
 * accordinally 'sign up' message banner on the
 * bottom of the site.
 */
export const FooterSignup = () => {

  const elements = {
    timeoutButton: null,
    timeoutNotice: null,
    body: document.body,
    area: document.getElementById('app'),
    form: document.getElementById('app-newsletter'),
    group: document.getElementById('signup-submit'),
    notice: document.getElementById('app-notice'),
    prompt: document.querySelector('.notice-prompt__message')
  }

  const SIGNUP_ERROR_CLASSNAME = 'has-error'
  const NOTICE_OPEN_CLASSNAME = 'notice-on'
  const NOTICE_CLOSE_CLASSNAME = 'notice-off'
  const NOTICE_ALERT_CLASSNAME = 'notice-alert'
  const NOTICE_SUCCESS_CLASSNAME = 'notice-success'
  const BUTTON_ENABLED_CLASSNAME = 'submit-enabled'
  const BUTTON_DISABLED_CLASSNAME = 'submit-disabled'
  const SUBSCRIPTION_OPEN_CLASSNAME = 'subscription-on'
  const SUBSCRIPTION_CLOSE_CLASSNAME = 'subscription-off'

  const subscriptionKeyDown = ({ keyCode }) => {

    // Close modal when esc key is pressed.
    if (keyCode === 27) {
      hideSubscriptionModalNotice()
    }
  }

  /**
   *  MANAGE USER INTERFACE
   */
  const handleSubmitButtonState = () => {
    const { group } = elements

    // Manage group disabled state
    clearTimeout(elements.timeoutButton)
    group.classList.remove(BUTTON_ENABLED_CLASSNAME)
    group.classList.add(BUTTON_DISABLED_CLASSNAME)
    
    // Reset group ui after 2 seconds
    elements.timeoutButton = setTimeout( function () {
      group.classList.remove(BUTTON_DISABLED_CLASSNAME)
      group.classList.add(BUTTON_ENABLED_CLASSNAME)
      group.blur()
    }, 2000)
  }

  const clearAllInputFields = () => {
    const { form } = elements

    form.elements['subscriber_name'].value = ''
    form.elements['subscriber_email'].value = ''
    form.elements['subscriber_gdpr'].checked = false;
  }


  /**
   * MANAGE NEWSLETTER SIGNUP FORM
   */
  const handleNameError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['subscriber_name'].parentNode.classList.add(SIGNUP_ERROR_CLASSNAME)
      form.elements['subscriber_name'].focus()
    } else {
      form.elements['subscriber_name'].parentNode.classList.remove(SIGNUP_ERROR_CLASSNAME)
    }
  }

  const handleEmailError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['subscriber_email'].parentNode.classList.add(SIGNUP_ERROR_CLASSNAME)
      form.elements['subscriber_email'].focus()
    } else {
      form.elements['subscriber_email'].parentNode.classList.remove(SIGNUP_ERROR_CLASSNAME)
    }
  }

  const handleTermsError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['subscriber_gdpr'].parentNode.classList.add(SIGNUP_ERROR_CLASSNAME)
      form.elements['subscriber_gdpr'].focus()
    } else {
      form.elements['subscriber_gdpr'].parentNode.classList.remove(SIGNUP_ERROR_CLASSNAME)
    }
  }

  const handleSignupNotice = (alert, msg) => {
    const { notice, prompt } = elements

    // Manage notice background style
    if( notice ) {
      notice.classList.remove(NOTICE_ALERT_CLASSNAME)
      notice.classList.remove(NOTICE_SUCCESS_CLASSNAME)
      if(alert === 'error') notice.classList.add(NOTICE_ALERT_CLASSNAME)
      if(alert === 'success') notice.classList.add(NOTICE_SUCCESS_CLASSNAME)
    }

    // Append message
    if( prompt ) {
      prompt.innerHTML = ''
      prompt.innerHTML = msg
    }

    showSignupNotice()
  }


  /**
   * MANAGE NOTICE BANNER
   */
  const showSignupNotice = () => {
    const { notice } = elements

    // Manage timeout notice
    clearTimeout(elements.timeoutNotice)
    elements.timeoutNotice = setTimeout( function () {
      hideSignupNotice()
    }, 4000)

    // manage contact form notice
    if( notice ) {
      notice.classList.remove(NOTICE_CLOSE_CLASSNAME)
      notice.classList.add(NOTICE_OPEN_CLASSNAME)
    }
  }

  const hideSignupNotice = () => {
    const { notice } = elements

    if( notice ) {
      notice.classList.remove(NOTICE_OPEN_CLASSNAME)
      notice.classList.add(NOTICE_CLOSE_CLASSNAME)
    }
  }


  /**
   * MANAGE SUBSCRIPTION MODAL NOTICE
   */
  const showSubscriptionModalNotice = () => {

    const { area } = elements

    // Manage Classlist
    if( area ) {
      area.classList.remove(SUBSCRIPTION_CLOSE_CLASSNAME)
      area.classList.add(SUBSCRIPTION_OPEN_CLASSNAME)
    }

    // Only listen for keydown events when modal is open.
    document.addEventListener('keydown', subscriptionKeyDown, false)
  }

  const hideSubscriptionModalNotice = () => {

    const { area } = elements

    // Manage classlist
    if( area ) {
      area.classList.remove(SUBSCRIPTION_OPEN_CLASSNAME)
      area.classList.add(SUBSCRIPTION_CLOSE_CLASSNAME)
    }

    // Remove the for keydown events when modal is closed
    document.removeEventListener('keydown', subscriptionKeyDown, false)
  }


  /**
   * INITIALIZE
   */
  const init = () => {
    
    const { form } = elements

    if (form) {

      /**
       * Handle Newsletter Form Actions
       */ 
      form.addEventListener('submit', (event) => {
        event.preventDefault() 

        // Arguments to save
        const subscribeform   = event.currentTarget
        const subscribe_name  = subscribeform.elements['subscriber_name'].value
        const subscribe_email = subscribeform.elements['subscriber_email'].value
        const subscribe_terms = subscribeform.elements['subscriber_gdpr'].checked

        // Prepare fetch arguments
        const url     = sasabudi_scripts_vars.ajax_url
        const nonce   = sasabudi_scripts_vars.ajax_nonce
        const header  = new Headers()
        header.append('X-WP-Nonce', nonce)
        const data    = {
          action: 'sasabudi_newsletter_subscribe',
          sname: subscribe_name,
          semail: subscribe_email,
          sterms: subscribe_terms === true ? 1 : 0
        }
        const params  =  new URLSearchParams(data)
        const request = new Request(url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: header,
            body: params,
            mode: 'cors',
            cache: 'default'
        })

        // Button submit status
        handleSubmitButtonState()

        // Request fetch response
        fetch(request).then(response => {

          return response.json()

        }).then(data => {

          if(data.success) {

            const formMessage = data.data[0]
            const errorMessage = data.data[1]
            const signupMessage = data.data[2]

            // reset all formfieds errors
            handleNameError(false)
            handleEmailError(false)
            handleTermsError(false)

            // Error handling
            if(formMessage === 'form_error') {
              
              // Bad name
              if(errorMessage === 'error_name') {
                handleNameError(true)
                handleSignupNotice('error', signupMessage)
              }

              // Bad email
              if(errorMessage === 'error_email') {
                handleEmailError(true)
                handleSignupNotice('error', signupMessage)
              }

              // Bad terms
              if(errorMessage === 'error_terms') {
                handleTermsError(true)
                handleSignupNotice('error', signupMessage)
              }
              
              // Bad list id
              if(errorMessage === 'error_listid') {
                handleSignupNotice('error', signupMessage)
              }

              // Already subscribed
              if(errorMessage === 'error_subscribed') {
                handleSignupNotice('error', signupMessage)
              }
              
              // Bad network
              if(errorMessage === 'error_network') {
                handleSignupNotice('error', signupMessage)
              }
            }

            // Success handling
            if(formMessage === 'form_success') {

              /** Show subscription modal notice **/
              clearAllInputFields()
              showSubscriptionModalNotice()
            }

          } else {
            // Bad network
            handleSignupNotice('error', 'Sorry, unable to subscribe. Please try again later!')
          }

        }).catch(error => {
          console.log(error)
          handleSignupNotice('error', 'Sorry, unable to subscribe. Please try again later!')
        })

      })
    }

    if (form) {

      /**
       * Handle Newsletter Form Notice
       */
      document.addEventListener('click', (event) => {

        // hide notice on click
        if ( event.target.matches('.notice-close__btn') || event.target.matches('.notice-close__btn--bar') ) {
          event.preventDefault()

          hideSignupNotice()
        }

        // hide subscription modal message on click
        if ( event.target.matches('.subscription') || event.target.matches('.subscription-close') || event.target.matches('.subscription-box__close') ) {
          event.preventDefault()

          hideSubscriptionModalNotice()
        }
      }) 
    }
  }
  
  init()
}