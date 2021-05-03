/**
 * Toggles the header sticky class by scroll positions.
 */
export const AppSticky = () => {

  const elements = {
    scrollY: 0,
    deviceNoteOffset: 0,
    desktopNoteOffset: 0,
    filterOffset: 0,
    isDesktopSize: false,
    desktopHeader: document.querySelector('.header-desktop'),
    desktopNote: document.querySelector('.note-desktop'),
    desktopDescription: document.querySelector('.catalog-header__desc'),
    deviceNote: document.querySelector('.note-device'),
    devicePromo: document.querySelector('.header-promo'),
    deviceFilter: document.querySelector('.catalog-header__filter'),
    deviceHeader: document.querySelector('.catalog-header'),
    catalogArchive: document.querySelector('.catalog-archive'),
    app: document.getElementById('app')
  }

  const STICKY_CLASSNAME = 'sticky-on'
  const FILTER_CLASSNAME = 'filter-on'
  const MOBILE_AND_TABLET_SIZE = 901

  const handleResize = () => {

    const { app, desktopHeader, deviceHeader, catalogArchive, desktopNote, desktopDescription, deviceNote, deviceFilter } = elements

    // Toggle between desktop and device
    elements.isDesktopSize = window.innerWidth < MOBILE_AND_TABLET_SIZE ? false : true

    // Calculate description like this because it not permanent active
    let descriptionHeight = 0
    if (desktopDescription) descriptionHeight = desktopDescription.clientHeight 

    // Calculate promo like this because it not permanent active
    let promoHeight = 0
    if (elements.devicePromo) promoHeight = elements.devicePromo.clientHeight 

    // Offsets
    if (desktopNote) elements.desktopNoteOffset = desktopNote.clientHeight
    if (deviceNote) elements.deviceNoteOffset = deviceNote.clientHeight + promoHeight
    if (deviceFilter) elements.filterOffset = desktopNote.clientHeight + descriptionHeight + promoHeight
    
    /**
     * Desktop View
     */
    if (elements.isDesktopSize && desktopHeader) {

      // Remove device 'sticky filter' class
      if (deviceHeader) deviceHeader.classList.remove(FILTER_CLASSNAME)
      
      // Handle desktop 'sticky header' class
      if (elements.scrollY >= elements.desktopNoteOffset) {
        app.classList.add(STICKY_CLASSNAME)
      } else {
        app.classList.remove(STICKY_CLASSNAME)
      }

      if (catalogArchive) {
        // Handle desktop 'sticky filter' class
        if (elements.scrollY >= elements.filterOffset) {
          app.classList.add(FILTER_CLASSNAME)
        } else {
          app.classList.remove(FILTER_CLASSNAME)
        }
      }

    }

    /**
     * Device View
     */
    if (!elements.isDesktopSize && deviceHeader) {

      // Remove desktop 'header' classes
      if (app) app.classList.remove(STICKY_CLASSNAME)
      if (app) app.classList.remove(FILTER_CLASSNAME)

      if (deviceFilter) {

        // Handle device 'sticky filter' class
        if (elements.scrollY >= elements.deviceNoteOffset) {
          deviceHeader.classList.add(FILTER_CLASSNAME)
        } else {
          deviceHeader.classList.remove(FILTER_CLASSNAME)
        }
      }
    }
  }

  const handleScroll = () => {

    elements.scrollY = window.scrollY

    handleResize()
  }

  const init = () => {
    
    // Set resize & scroll listener
    window.addEventListener('resize', handleResize)
    window.addEventListener('scroll', handleScroll)
  
    // Execute
    handleScroll()
  }

  init()
}