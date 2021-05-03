/**
 * Handle either the 'logo on click' method or the
 * footer 'scroll to top' method.
 */
import jump from 'jump.js'

export const FooterScroll = () => {

  const elements = {
    homeState: false,
    homeUrl: '',
    rootUrl: ''
  }

  const handleLocation = () => {

    // Declare arguments
    elements.homeState = false
    elements.homeUrl = window.location.href
    elements.rootUrl = sasabudi_scripts_vars.root_url

    // Declare if we are located at the 'homepage'
    if( (/^https?\:\/\/[^\/]+\/?$/).test(elements.homeUrl) ) {
      elements.homeState = true
    } else if (elements.homeUrl === `${location}/de/`) { // Deutsch
      elements.homeState = true
    } else if (elements.homeUrl === `${location}/fr/`) { // Francais
      elements.homeState = true
    }

    handlePageState()
  }

  const handlePageState = () => {

    const { homeState, rootUrl } = elements

    if( homeState ) {

      // Scroll to target
      jump('.app')
      
    } else {

      // Otherwise go back to 'hompage'
      location.href = rootUrl
    }
  }

  const init = () => {

    document.addEventListener('click', (event) => {

      // Handle logo button Click
      if ( event.target.matches('.header-device__title--link') || event.target.matches('.header-desktop__title--link') ) {
        event.preventDefault()

        handleLocation()
      }

      // Scroll to top on button click
      if ( event.target.matches('.footer-scroll__btn--link') ) {
        event.preventDefault()

        // Scroll to target
        jump('.app')
      }
    })
  }

  init()
}
  