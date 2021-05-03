/**
 * Show modal with a list of 'store selection' which 
 * indicates the countries. It works paralell the
 * free shipping module and policies statements.
 */
export const StoreSelection = () => {

  const elements = {
    body: document.body,
    area: document.getElementById('app'),
    deviceStoreSelector: document.querySelector('.offset-left__selector'),
    desktopStoreSelector: document.querySelector('.note-desktop__selector')
  }

  const STORESELECTION_OPEN_CLASSNAME  = 'store-on'
  const STORESELECTION_CLOSE_CLASSNAME = 'store-off'

  const checkStoreModalStatus = () => {

    // Check cookie existence
    if (document.cookie.split(';').some((item) => item.trim().startsWith('wp_store_selector_UgNz4K='))) {

      const storeCookie = ("; "+document.cookie).split("; wp_store_selector_UgNz4K=").pop().split(";").shift()

      // United States
      if (storeCookie === "ejuksw") {
        setStoreToUnitedStates()
      }
      // Canada
      else if (storeCookie === "gewokx") { 
        setStoreToCanada()
      }
      // Europe
      else if (storeCookie === "jeuzew") {
        setStoreToEurope()
      }
      // United Kingdom
      else if (storeCookie === "awqoir") {
        setStoreToUnitedKingdom()
      }
      // Japan
      else if (storeCookie === "mpneys") {
        setStoreToJapan()
      }
      // Australia / New Zeeland
      else if (storeCookie === "komrfu") {
        setStoreToAustralia()
      } 
      // World
      else if (storeCookie === "jkdwan") {
        setStoreToWorld()
      }
    }
  }

  const setStoreCookie = value => {
    const d = new Date()
    d.setTime(d.getTime() + (7*24*60*60*1000))
    document.cookie = "wp_store_selector_UgNz4K=" + value + "; expires=" + d.toUTCString() + ";path=/"
  }

  const setNoteStyle = style => {

    const { deviceStoreSelector, desktopStoreSelector } = elements 
    const cls = ['us-section', 'ca-section', 'eu-section', 'uk-section', 'jp-section', 'au-section', 'world-section'];

    // Remove and add style
    deviceStoreSelector.classList.remove(...cls);
    deviceStoreSelector.classList.add(style);

    desktopStoreSelector.classList.remove(...cls);
    desktopStoreSelector.classList.add(style);
  }

  const showStoreModal = () => {
    
    const { body, area } = elements 
    
    // Apply css inline style
    body.style.overflowY = 'hidden'

    // Remove and apply style
    if (area) {
      area.classList.remove(STORESELECTION_CLOSE_CLASSNAME)
      area.classList.add(STORESELECTION_OPEN_CLASSNAME)
    }
  }

  const forewardPage = () => {
    location.reload()
  }

  const setStoreToUnitedStates = () => {
    setStoreCookie('ejuksw')
    setNoteStyle('us-section')
  }

  const setStoreToCanada = () => {
    setStoreCookie('gewokx')
    setNoteStyle('ca-section')
  }

  const setStoreToEurope = () => {
    setStoreCookie('jeuzew')
    setNoteStyle('eu-section')
  }

  const setStoreToUnitedKingdom = () => {
    setStoreCookie('awqoir')
    setNoteStyle('uk-section')
  }

  const setStoreToJapan = () => {
    setStoreCookie('mpneys')
    setNoteStyle('jp-section')
  }

  const setStoreToAustralia = () => {
    setStoreCookie('komrfu')
    setNoteStyle('au-section')
  }

  const setStoreToWorld = () => {
    setStoreCookie('jkdwan')
    setNoteStyle('world-section')
  }

  const init = () => {

    /**
     * 1. Check storeselection value on start up
     *    Check if a cookie is already set. 
     *    yes -> show country flag by cookie value
     *    no  -> show store modal
     */
    checkStoreModalStatus()

    document.addEventListener('click', (event) => { 

      /**
       * 2. Click on a button in the country selector modal
       *    -> set selected country cookie value
       *    -> set selected country flag style
       *    -> hide the country selector modal
       *    -> foreward page if 'country change' was initiated
       */
      if ( event.target.matches('#store_us') ) {
        event.preventDefault()
        setStoreCookie('ejuksw')
        forewardPage() 
      } 
      else if ( event.target.matches('#store_ca') ) {
        event.preventDefault()
        setStoreCookie('gewokx')
        forewardPage()   
      }
      else if ( event.target.matches('#store_eu') ) {
        event.preventDefault()
        setStoreCookie('jeuzew')
        forewardPage()
      }
      else if ( event.target.matches('#store_uk') ) {
        event.preventDefault()
        setStoreCookie('awqoir')
        forewardPage()
      }
      else if ( event.target.matches('#store_jp') ) {
        event.preventDefault()
        setStoreCookie('mpneys')
        forewardPage()
      }
      else if ( event.target.matches('#store_au') ) {
        event.preventDefault()
        setStoreCookie('komrfu') 
        forewardPage()
      }
      else if ( event.target.matches('#store_world') ) {
        event.preventDefault()
        setStoreCookie('jkdwan')
        forewardPage()
      }

      if ( event.target.matches('.offset-left__selector') || event.target.matches('.note-desktop__selector') || event.target.matches('.location-flag') ) {
        event.preventDefault()

        /**
         * 3. Click on the 'country change' button in header
         *    -> show country selector modal
         */
        showStoreModal()
      }
      
    })
  }

  init()
}