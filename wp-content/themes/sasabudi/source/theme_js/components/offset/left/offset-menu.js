/**
 * This manages the offset device 'menu' behaviour.
 */
export const OffsetMenu = () => {
  
  const elements = {
    menu: Array.from(document.querySelectorAll('.robs-menu'))
  }

  const ANIM_ON_CLASSNAME = 'menu--on'
  const ANIM_OFF_CLASSNAME = 'menu--off'

  const buildOffsetMenu = () => {

    // Loop through the menu and add the button height value and
    // the corresponding event listener on 'Device' view.
    elements.menu.forEach( item => {
      item.style.height = 48 + 'px'
      item.addEventListener('click', (event) => {

        // toggle offset menu on rob's button click
        toggleOffsetMenu(event)      
      })
    })
  }

  const toggleOffsetMenu = (event) => {
    const parent = event.target.parentElement

    // Prevent 'robs-manu' button to act as link
    if(parent.classList.contains('robs-menu')) {
      event.preventDefault()
    }

    // Toggle list between on and off state
    elements.menu.forEach(element => {
      if( element.classList === parent.classList && !element.classList.contains(ANIM_ON_CLASSNAME) ) { 
        openOffsetMenu(element)
      } else {
        closeOffsetMenu(element)
      }
    })
  }

  const openOffsetMenu = (element) => {

    // Calcutate the 'menu items' and add the equivalent height property
    const num = element.querySelectorAll('.menu-item').length + 1
    element.style.height = ((46 * num) + 21) + 'px'

    // Toggle the 'animation' classnames
    element.classList.remove(ANIM_OFF_CLASSNAME)
    element.classList.add(ANIM_ON_CLASSNAME)
  }

  const closeOffsetMenu = (element) => {

    // Set the original 'menu item' height as style property
    element.style.height = 48 + 'px'
    
    // Toggle the 'animation' classnames
    element.classList.remove(ANIM_ON_CLASSNAME)
    element.classList.add(ANIM_OFF_CLASSNAME)  
  }

  const init = () => {
    // Set a timeout here because the click event is in a widget.
    setTimeout(buildOffsetMenu, 500)
  }

  init()
}
