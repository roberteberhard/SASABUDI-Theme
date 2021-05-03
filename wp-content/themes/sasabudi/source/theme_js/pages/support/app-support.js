/**
 * This toggle the device & desktop 'support' menu behaviour.
 */
export const AppSupport = () => {

  const elements = {
    isDeviceSize: false,
    isDesktopSize: false,
    isDeviceStateOpen: false,
    navigation: document.querySelector('.support-menu__navigation'),
    accordion: document.getElementsByClassName("accordion")
  }

  const ANIM_ON_CLASSNAME  = 'menu--on'
  const ANIM_OFF_CLASSNAME = 'menu--off'
  const MOBILE_AND_TABLET_SIZE = 901
  
  const openDeviceMenu = () => {

    const { navigation } = elements

    // Calcutate the 'menu items' length and set the equivalent height argument.
    const numLinks = navigation.querySelectorAll('.support-menu__link').length
    navigation.style.height = ((42 * numLinks) + 21) + 'px'

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
      activeChild.classList.add('support-toggle')
      activeChild.innerHTML += '<a href="#" id="toggle_support" class="support-toggle__button">Help / ' + activeSection + '</a>'
      
      // Prepend new button to navigation
      navigation.insertBefore(activeChild, navigation.firstChild)
      
      // Add an eventlistener on the newly created button
      const toggleButton = document.getElementById('toggle_support')
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
    const supportToggle = document.querySelector('.support-toggle')
    if (supportToggle) supportToggle.parentNode.removeChild(supportToggle)
    
    // Reset Support menu style and classes
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

  const handleAccordion = () => {
    const { accordion } = elements

    if(accordion) {
      let i = 0;

      for (i = 0; i < accordion.length; i++) {
        accordion[i].addEventListener('click', function() {
          this.classList.toggle('active')
          const panel = this.nextElementSibling
          if (panel.style.display === 'block') {
            panel.style.display = 'none'
          } else {
            panel.style.display = 'block'
          }
        })
      }
    }
  }
  
  const init = () => {
    window.addEventListener('resize', handleMenuResize)
    handleMenuResize()
    handleAccordion()
  }
  
  init()
}