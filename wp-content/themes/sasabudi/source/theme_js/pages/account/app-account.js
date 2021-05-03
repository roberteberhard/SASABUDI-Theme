/**
 * This toggle the device & desktop 'account' menu behaviour.
 */
export const AppAccount = () => {

  const elements = {
    isDeviceSize: false,
    isDesktopSize: false,
    isDeviceStateOpen: false,
    navigation: document.querySelector('.account-menu__navigation')
  }

  const ANIM_ON_CLASSNAME  = 'menu--on'
  const ANIM_OFF_CLASSNAME = 'menu--off'
  const MOBILE_AND_TABLET_SIZE = 901
  
  const openDeviceMenu = () => {

    const { navigation } = elements
    const numLinks = navigation.querySelectorAll('.woocommerce-MyAccount-navigation-link').length
    
    // Calcutate the 'menu items' length and set the equivalent height argument.
    navigation.style.height = ((42 * numLinks) + 16) + 'px'
   
    // Toggle classlist
    navigation.classList.remove(ANIM_OFF_CLASSNAME)
    navigation.classList.add(ANIM_ON_CLASSNAME)
  }

  const closeDeviceMenu = () => {

    const { navigation } = elements

    // Set back the origin button height.
    navigation.style.height = 48 + 'px'

    // Toggle classlist
    navigation.classList.remove(ANIM_ON_CLASSNAME)
    navigation.classList.add(ANIM_OFF_CLASSNAME)
  }

  const resizeMenuToDeviceState = () => {

    const { isDeviceSize, navigation } = elements

    if (isDeviceSize) return

    // Select the 'active' menu section and hide it from the list
    const activeSection = document.querySelector('.is-active a').innerHTML
    const activeElement = document.getElementsByClassName('is-active')[0]

    if (activeElement) {
        activeElement.style.display = 'none'
    }

    if (activeSection) {

      closeDeviceMenu()

      // Prepare new button with selected 'active' state value
      const activeChild = document.createElement('div')
      activeChild.classList.add('account-toggle')
      activeChild.innerHTML += '<a href="#" id="toggle_account" class="account-toggle__button">Account / ' + activeSection + '</a>'
      
      // Prepend new button to navigation
      navigation.insertBefore(activeChild, navigation.firstChild)
     
      // Add an eventlistener on the newly created button
      const toggleButton = document.getElementById('toggle_account')
      toggleButton.addEventListener('click', (e) => {
        e.preventDefault()
        if (!elements.isDeviceStateOpen) {
          openDeviceMenu()
          elements.isDeviceStateOpen = true
        } else {
          closeDeviceMenu()
          elements.isDeviceStateOpen = false
        }
      })        
    }

    elements.isDeviceSize = true
    elements.isDesktopSize = false
  }

  const resizeMenuToDesktopState = () => {

    const { isDesktopSize, navigation } = elements

    if( isDesktopSize ) return
    /**
     * On desktop state, remove all the created elements againg
     * which we built in the device state.
     */

    // Show 'active' section again
    const activeElement = document.getElementsByClassName('is-active')[0]
    if (activeElement) activeElement.style.display = 'block'

    // Remove button
    const accountToggle = document.querySelector('.account-toggle')
    if (accountToggle) accountToggle.parentNode.removeChild(accountToggle)

    // Reset account menu style and classes
    navigation.style.height = 'auto'
    navigation.classList.remove(ANIM_OFF_CLASSNAME, ANIM_ON_CLASSNAME)

    // Update instance
    elements.isDeviceSize = false
    elements.isDesktopSize = true
    elements.isDeviceStateOpen = false
  }

  const handleMenuResize = () => {

    const { navigation } = elements

    if(window.innerWidth < MOBILE_AND_TABLET_SIZE && navigation) {

      resizeMenuToDeviceState()

      // Update instance
      elements.isDeviceSize = true
      elements.isDesktopSize = false
    }
    else
    {
      if( navigation ) {

        resizeMenuToDesktopState()

        // Update instance
        elements.isDeviceSize = false
        elements.isDesktopSize = true
      }
    }
  }
  
  const init = () => {
    window.addEventListener('resize', handleMenuResize)
    handleMenuResize()
  }
  
  init()
}