/**
 * Check view for Device or Desktop style and 
 * build footer menu accordinally.
 */
export const FooterMenu = () => {

  const elements = {
    menu: Array.from(document.querySelectorAll('.widget_nav_menu'))
  }

  const ANIM_ON_CLASSNAME = 'anim-on'
  const ANIM_OFF_CLASSNAME = 'anim-off'
  const MOBILE_AND_TABLET_SIZE = 901

  let isDeviceSize = false
  let isDesktopSize = false

  const toggleDeviceMenu = (event) => {

    const target = event.target
    const parent = target.parentElement.parentElement

    // toggle menu items by classlist names
    elements.menu.forEach(element => {
      if( element.classList === parent.classList && !element.classList.contains(ANIM_ON_CLASSNAME) ) {
        openDeviceMenu(element)
      } else {
        closeDeviceMenu(element)
      }
    })
  }

  const openDeviceMenu = element => {

    // Calcutate the 'menu items' and add the equivalent height property
    let num = element.querySelectorAll('.menu-item').length + 1
    element.style.height = ((46 * num) + 21) + 'px'

    // Toggle the 'animation' classnames
    element.classList.remove(ANIM_OFF_CLASSNAME)
    element.classList.add(ANIM_ON_CLASSNAME)
  }

  const closeDeviceMenu = element => {

    // Set the original 'menu item' height as style property
    element.style.height = 48 + 'px'

    // Toggle the 'animation' classnames
    element.classList.remove(ANIM_ON_CLASSNAME)
    element.classList.add(ANIM_OFF_CLASSNAME)     
  }

  const resizeToDevice = () => {
    if(isDeviceSize) return

    // Loop through the menu and add the button height value and
    // the corresponding event listener on 'Device' view.
    elements.menu.forEach( item => {
      item.style.height = 48 + 'px'
      item.addEventListener('click', toggleDeviceMenu)
    })
  }

  const resizeToDesktop = () => {
    if(isDesktopSize) return

    // Loop through the menu and remove the button height property
    // and corresponding menu event listener on 'Desktop' view.
    elements.menu.forEach( item => {
      item.style.removeProperty("height")
      item.removeEventListener('click', toggleDeviceMenu)
    })
  }

  const handleResize = () => {
    if (window.innerWidth < MOBILE_AND_TABLET_SIZE) {
      
      resizeToDevice()

      // update instance
      isDeviceSize = true
      isDesktopSize = false

    } else {

      resizeToDesktop()

      // update instance
      isDeviceSize = false
      isDesktopSize = true

    }
  }

  const init = () => {

    window.addEventListener('resize', handleResize)
    handleResize()
    
  }

  init()
}