/**
 * Show and hides app modal and toggles left and right
 * offset sections.
 */
export const AppModal = () => {

  const elements = {
    offset: '',
    body: document.body,
    area: document.getElementById('app')
  }

  const MODAL_CLOSE_CLASSNAME = 'modal-off'
  const MODAL_OPEN_CLASSNAME = 'modal-on'
  const OFFSET_LEFT_CLOSE_CLASSNAME = 'left-off'
  const OFFSET_LEFT_OPEN_CLASSNAME = 'left-on'
  const OFFSET_RIGHT_CLOSE_CLASSNAME = 'right-off'
  const OFFSET_RIGHT_OPEN_CLASSNAME = 'right-on'
  const OFFSET_LEFT_FILTER_CLASSNAME = 'left-filter'
  const LANGUAGE_SWITCH_CLOSE_CLASSNAME = 'lang-off'

  const handleKeyDown = ({ keyCode }) => {

    // Close modal when esc key is pressed.
    if (keyCode === 27) {
        hideSidebarAndModal()
    }
  }

  const hideSidebarAndModal = () => {

    const { body, area } = elements

    // Remove css inline style
    body.style.overflowY = ''

    // Remove and apply classnames
    area.classList.remove(MODAL_OPEN_CLASSNAME)
    area.classList.add(MODAL_CLOSE_CLASSNAME)
    
    if(elements.offset === 'left') {
      area.classList.remove(OFFSET_LEFT_OPEN_CLASSNAME)
      area.classList.add(OFFSET_LEFT_CLOSE_CLASSNAME)
    }

    if(elements.offset === 'right') {
      area.classList.remove(OFFSET_RIGHT_OPEN_CLASSNAME)
      area.classList.add(OFFSET_RIGHT_CLOSE_CLASSNAME)
    }

    // Remove the keydown event when modal is closed
    document.removeEventListener('keydown', handleKeyDown, false)
  }

  const showSidebarAndModal = () => {

    const { body, area } = elements 
    
    // Apply css inline style
    body.style.overflowY = 'hidden'

    // Remove- and apply classnames
    area.classList.remove(OFFSET_RIGHT_CLOSE_CLASSNAME)
    area.classList.remove(OFFSET_LEFT_CLOSE_CLASSNAME)
    area.classList.remove(OFFSET_LEFT_FILTER_CLASSNAME)
    area.classList.remove(LANGUAGE_SWITCH_CLOSE_CLASSNAME)
    area.classList.remove(MODAL_CLOSE_CLASSNAME)
    area.classList.add(MODAL_OPEN_CLASSNAME)

    // Only listen for keydown events when modal is open
    document.addEventListener('keydown', handleKeyDown, false)
  }

  const init = () => {

    document.addEventListener('click', (event) => {
      
      // Show right sidebar with modal overlay
      if ( event.target.matches('.header-desktop__cart--button') || event.target.matches('.header-desktop__cart--amount') || event.target.matches('.header-device__cart--button') || event.target.matches('.header-device__cart--amount') ) {
        
        const { area } = elements
        
        event.preventDefault()
        elements.offset = 'right'
        showSidebarAndModal()
        area.classList.add(OFFSET_RIGHT_OPEN_CLASSNAME)
      }

      // Show left sidebar (navigation) with modal overlay
      if ( event.target.matches('.header-device__toggle--button') ) {

        const { area } = elements

        event.preventDefault()
        elements.offset = 'left'
        showSidebarAndModal()
        area.classList.add(OFFSET_LEFT_OPEN_CLASSNAME)
      }

      // Show left sidebar (filter) with modal overlay
      if ( event.target.matches('.filter-bar__btn--filter') ) {
        
        const { area } = elements
        
        event.preventDefault()
        elements.offset = 'left'
        showSidebarAndModal()
        area.classList.add(OFFSET_LEFT_OPEN_CLASSNAME)
        area.classList.add(OFFSET_LEFT_FILTER_CLASSNAME)
      }

      // Hide left or right sidebar and modal overlay
      if ( event.target.matches('.app') || event.target.matches( '.mini-cart__header--button') || event.target.matches('.offset-left__close--button') ) {
        event.preventDefault()
        hideSidebarAndModal()
      }
      
    })
  }

  init()
}
