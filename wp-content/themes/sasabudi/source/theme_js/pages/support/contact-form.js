/**
 * Mangages the whole contact form handling.
 */
export const ContactForm = () => {

  const elements = {
    timeoutButton: null,
    timeoutNotice: null,
    form: document.getElementById('app-contact'),
    notice: document.getElementById('app-notice'),
    group: document.getElementById('contact-submit'),
    prompt: document.querySelector('.notice-prompt__message')
  }

  const CONTACT_ERROR_CLASSNAME   = 'has-error'
  const NOTICE_OPEN_CLASSNAME     = 'notice-on'
  const NOTICE_CLOSE_CLASSNAME    = 'notice-off'
  const NOTICE_ALERT_CLASSNAME    = 'notice-alert'
  const NOTICE_SUCCESS_CLASSNAME  = 'notice-success'
  const BUTTON_ENABLED_CLASSNAME  = 'submit-enabled'
  const BUTTON_DISABLED_CLASSNAME = 'submit-disabled'

  /**
   *  MANAGE USER INTERFACE
   */
  const handleSubmitButtonState = () => {

    const { group } = elements

    // manage group disabled state
    clearTimeout(elements.timeoutButton)
    group.classList.remove(BUTTON_ENABLED_CLASSNAME)
    group.classList.add(BUTTON_DISABLED_CLASSNAME)
    
    // reset after 2 seconds
    elements.timeoutButton = setTimeout( function () {
      group.classList.remove(BUTTON_DISABLED_CLASSNAME)
      group.classList.add(BUTTON_ENABLED_CLASSNAME)
      group.blur()
    }, 2000)
  }

  const clearAllInputFields = () => {

    const { form } = elements
    
    form.elements['message_firstname'].value = ''
    form.elements['message_lastname'].value = ''
    form.elements['message_email'].value = ''
    form.elements['message_subject'].value = ''
    form.elements['message_text'].value = ''
    form.elements['message_terms'].checked = false
  }
 
  /**
   * MANAGE CONTACT FORM
   */
  const handleFirstnameError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['message_firstname'].parentNode.classList.add(CONTACT_ERROR_CLASSNAME)
      form.elements['message_firstname'].focus()
    } else {
      form.elements['message_firstname'].parentNode.classList.remove(CONTACT_ERROR_CLASSNAME)
    }
  }

  const handleLastnameError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['message_lastname'].parentNode.classList.add(CONTACT_ERROR_CLASSNAME)
      form.elements['message_lastname'].focus()
    } else {
      form.elements['message_lastname'].parentNode.classList.remove(CONTACT_ERROR_CLASSNAME)
    }
  }

  const handleEmailError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['message_email'].parentNode.classList.add(CONTACT_ERROR_CLASSNAME)
      form.elements['message_email'].focus()
    } else {
      form.elements['message_email'].parentNode.classList.remove(CONTACT_ERROR_CLASSNAME)
    }
  }

  const handleSubjectError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['message_subject'].parentNode.classList.add(CONTACT_ERROR_CLASSNAME)
      form.elements['message_subject'].focus()
    } else {
      form.elements['message_subject'].parentNode.classList.remove(CONTACT_ERROR_CLASSNAME)
    }
  }

  const handleMessageError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['message_text'].parentNode.classList.add(CONTACT_ERROR_CLASSNAME)
      form.elements['message_text'].focus()
    } else {
      form.elements['message_text'].parentNode.classList.remove(CONTACT_ERROR_CLASSNAME)
    }
  }

  const handleTermsError = (showing) => {
    const { form } = elements

    if(showing) {
      form.elements['message_terms'].parentNode.classList.add(CONTACT_ERROR_CLASSNAME)
      form.elements['message_terms'].focus()
    } else {
      form.elements['message_terms'].parentNode.classList.remove(CONTACT_ERROR_CLASSNAME)
    }
  }
  
  const handleFooterNotice = (alert, msg) => {
    const { notice, prompt } = elements

    // Manage notice background style
    notice.classList.remove(NOTICE_ALERT_CLASSNAME)
    notice.classList.remove(NOTICE_SUCCESS_CLASSNAME)
    if(alert === 'error') notice.classList.add(NOTICE_ALERT_CLASSNAME)
    if(alert === 'success') notice.classList.add(NOTICE_SUCCESS_CLASSNAME)

    // Append message
    prompt.innerHTML = ''
    prompt.innerHTML = msg

    showAppNotice()
    if(alert === 'success') clearAllInputFields()
  }

  /**
   * MANAGE NOTICE BANNER
   */
  const showAppNotice = () => {
    const { notice } = elements

    // manage timeout notice
    clearTimeout(elements.timeoutNotice)
    elements.timeoutNotice = setTimeout( function () {
      hideAppNotice()
    }, 4000)

    // manage contact form notice
    notice.classList.remove(NOTICE_CLOSE_CLASSNAME)
    notice.classList.add(NOTICE_OPEN_CLASSNAME)
  }

  const hideAppNotice = () => {
    const { notice } = elements

    // manage timeout notice
    clearTimeout(elements.timeoutNotice)

    // manage contact form notice
    notice.classList.remove(NOTICE_OPEN_CLASSNAME)
    notice.classList.add(NOTICE_CLOSE_CLASSNAME)      
  }


  /**
   * INITIALIZE
   */
  const init = () => {
    const { form } = elements

    if (form) {

      /**
       * Handle Contact Form Actions
       */
      form.addEventListener('submit', (event) => {
        event.preventDefault()
        
        // Excecute recaptcha token
        // Now the recaptcha timer get resetted on each submit!
        grecaptcha.ready(function () {
          grecaptcha.execute()
        })

        // Arguments to save
        const contactform         = event.currentTarget
        const message_firstname   = contactform.elements['message_firstname'].value
        const message_lastname    = contactform.elements['message_lastname'].value
        const message_email       = contactform.elements['message_email'].value
        const message_subject     = contactform.elements['message_subject'].value
        const message_text        = contactform.elements['message_text'].value
        const message_terms       = contactform.elements['message_terms'].checked
        const message_recaptcha   = contactform.elements['recaptcha-response'].value
        
        // Prepare fetch arguments
        const url     = sasabudi_scripts_vars.ajax_url
        const nonce   = sasabudi_scripts_vars.ajax_nonce
        const header  = new Headers()
        header.append('X-WP-Nonce', nonce)
        const data    = {
          action: 'sasabudi_contact_form_message',
          mfirstname: message_firstname,
          mlastname: message_lastname,
          memail: message_email,
          msubject: message_subject,
          mtext: message_text,
          mterms: message_terms === true ? 1 : 0,
          mcaptcha: message_recaptcha
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
            const outputMessage = data.data[2]

            // reset all formfieds errors
            handleFirstnameError(false)
            handleLastnameError(false)
            handleEmailError(false)
            handleSubjectError(false)
            handleMessageError(false)
            handleTermsError(false)

            // Error handling
            if(formMessage === 'form_error') {
              
              // bad firstname
              if(errorMessage === 'error_firstname') {
                handleFirstnameError(true)
                handleFooterNotice('error', outputMessage)
              }

              // bad lastname
              if(errorMessage === 'error_lastname') {
                handleLastnameError(true)
                handleFooterNotice('error', outputMessage)
              }

              // bad email
              if(errorMessage === 'error_email') {
                handleEmailError(true)
                handleFooterNotice('error', outputMessage)
              }

              // bad subject
              if(errorMessage === 'error_subject') {
                handleSubjectError(true)
                handleFooterNotice('error', outputMessage)
              }

              // bad message
              if(errorMessage === 'error_message') {
                handleMessageError(true)
                handleFooterNotice('error', outputMessage)
              }

              // bad terms
              if(errorMessage === 'error_terms') {
                handleTermsError(true)
                handleFooterNotice('error', outputMessage)
              }

              // bad reCaptcha
              if(errorMessage === 'error_recaptcha') {
                handleFooterNotice('error', outputMessage)
              }

              // bad network
              if(errorMessage === 'error_network') {
                handleFooterNotice('error', outputMessage)
              }
            }

            // Success handling
            if(formMessage === 'form_success') {
              handleFooterNotice('success', outputMessage)
            }

          } else {

            // bad network
            handleFooterNotice('error', 'Message was not sent. Please try again!')

          }

        }).catch(error => {
          console.log(error)
          handleFooterNotice('error', 'Message was not sent. Please try again!')
        })
      })
    }

    if (form) {

      /**
       * Handle Contact Form Notice
       */
      document.addEventListener('click', (event) => {

        // hide notice on click
        if ( event.target.matches('.notice-close__btn') || event.target.matches('.notice-close__btn--bar') ) {
          event.preventDefault()

          hideAppNotice()
        }
      }) 
    }
  }

  init()
}