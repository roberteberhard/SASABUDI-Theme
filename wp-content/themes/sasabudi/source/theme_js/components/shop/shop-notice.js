/**
 * ShopNotice
 * Shows the Woocommerce Notice Message at the bottom of the page and
 * closes it after 8 second.
 */
export const ShopNotice = () => {

  const elements = {
    showNoticeID: null,
    hideNoticeID: null
  }

  const NOTICE_SHOW_CLASSNAME = 'notice--on'
  const NOTICE_HIDE_CLASSNAME = 'notice--off'

  const addNewNoticeWithTimer = () => {

    // Select all notices from stage
    const errors = Array.from(document.querySelectorAll('.woocommerce-error'))
    const infos = Array.from(document.querySelectorAll('.woocommerce-info'))
    const messages = Array.from(document.querySelectorAll('.woocommerce-message'))
    const successes = Array.from(document.querySelectorAll('.woocommerce-success'))
    const notices = errors.concat(infos).concat(messages).concat(successes);

    for (let i = 0; i < notices.length; i++) {
      let notice = notices[i]
      let closer = notice.querySelector('.notice-closer')
      
      // If notice doesn't have a custom class then add 'notice--on' and apply the close tag
      if ( ! notice.classList.contains(NOTICE_SHOW_CLASSNAME) || ! notice.classList.contains(NOTICE_HIDE_CLASSNAME) ) {
        
        if ( !closer ) {

          // Clear timeouts
          window.clearTimeout(elements.showNoticeID)
          window.clearTimeout(elements.hideNoticeID)   

          // Set timeouts
          elements.showNoticeID = window.setTimeout(() => {
            // Add new notice & closer
            notice.insertAdjacentHTML('beforeend', '<div class="notice-closer"></div>');
            // Show only one!
            if (notices.length >= 2) {
              if( i == 0 ) notice.classList.add(NOTICE_SHOW_CLASSNAME)
            } else {
              notice.classList.add(NOTICE_SHOW_CLASSNAME)
            }
            // Hide notice by timeout
            elements.hideNoticeID = window.setTimeout(() => {
              removeOldNotice()
            }, 5000)
          }, 250)
        }
      }
    }
  }

  const removeOldNotice = () => {

    // Select all notices from stage
    const errors = Array.from(document.querySelectorAll('.woocommerce-error'))
    const infos = Array.from(document.querySelectorAll('.woocommerce-info'))
    const messages = Array.from(document.querySelectorAll('.woocommerce-message'))
    const successes = Array.from(document.querySelectorAll('.woocommerce-success'))
    const notices = errors.concat(infos).concat(messages).concat(successes);

    for (let i = 0; i < notices.length; i++) {
      let notice = notices[i]

      if ( notice.classList.contains(NOTICE_SHOW_CLASSNAME) || ! notice.classList.contains(NOTICE_HIDE_CLASSNAME) ) {
        if (notices.length >= 2) {
          // Remove only one!
          if( i == 0 ) {
            notice.classList.add(NOTICE_HIDE_CLASSNAME)
            notice.classList.remove(NOTICE_SHOW_CLASSNAME)
          }
        } else {
          notice.classList.add(NOTICE_HIDE_CLASSNAME)
          notice.classList.remove(NOTICE_SHOW_CLASSNAME)
        }
      }
    }

  }

  const init = () => {

    // Handle mutation observer
    const observer = new MutationObserver(mutations => {
      mutations.forEach( function(mutation) {
        if (!mutation.oldValue) {
          addNewNoticeWithTimer()
        }
      })
    })
    observer.observe(document.body, { childList: true, subtree: true })

    // Handle close button Click
    document.addEventListener('click', (event) => { 
      if ( event.target.matches('.notice-closer') ) {
        event.preventDefault()

        // Hide notice from stage
        window.clearTimeout(elements.hideNoticeID)
        removeOldNotice()
      }
    })

    addNewNoticeWithTimer()
  }

  init()
}