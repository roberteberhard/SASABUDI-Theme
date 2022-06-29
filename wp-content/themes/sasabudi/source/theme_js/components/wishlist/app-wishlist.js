/**
 * Manages the 'wishlist' module
 * Toggles wishlist heart icon, by click and
 * page load.
 */
export const AppWishlist = () => {

  const elements = {
    ready: true,
    area: document.getElementById('app'),
    deviceIcon: document.querySelector('.header-device__wishlist--flag'),
    desktopIcon: document.querySelector('.header-desktop__wishlist--flag')
  }

  const WISHLIST_MODAL_OPEN_CLASSNAME   = 'wishlist-on'
  const WISHLIST_MODAL_CLOSE_CLASSNAME  = 'wishlist-off'

  /**
   * Toggle Sign In Modal View
   */
  const showSignInModal = () => {
    const { area } = elements
    // Remove and add style
    area.classList.remove(WISHLIST_MODAL_CLOSE_CLASSNAME)
    area.classList.add(WISHLIST_MODAL_OPEN_CLASSNAME)
  }

  const hideSignInModal = () => {
    const { area } = elements
    // Remove and add style
    area.classList.remove(WISHLIST_MODAL_OPEN_CLASSNAME)
    area.classList.add(WISHLIST_MODAL_CLOSE_CLASSNAME)
  }


  /**
   * Toggle Sign In Modal View
   */
  const createSavedProductId = productId => {

    const { deviceIcon, desktopIcon } = elements

    if (!elements.ready) return

    // Arguments
    const url = sasabudi_scripts_vars.root_url + '/wp-json/wishlist/v1/manager'
    const nonce = sasabudi_scripts_vars.ajax_nonce
    const header = new Headers()
    header.append('X-WP-Nonce', nonce)
    const data = { 'id': productId }
    const params =  new URLSearchParams(data)
    const request = new Request(url, {
      method: 'POST',
      credentials: 'same-origin',
      headers: header,
      body: params,
      mode: 'cors',
      cache: 'default'
    })

    elements.ready = false;

    // set ajax waiting icon
    const target = document.getElementById('pw' + productId)
    if (target) target.setAttribute("data-wait", 'yes')

    // save & get ajax data
    fetch(request).then(response => {
      return response.text()
    })
    .then(results => {
      if (target) target.setAttribute("data-exists", 'yes')
      if (target) target.setAttribute("data-wait", 'no')
      if (target) target.setAttribute("data-saved", results)
      if (deviceIcon) deviceIcon.classList.remove('icon-off')
      if (deviceIcon) deviceIcon.classList.add('icon-on')
      if (desktopIcon) desktopIcon.classList.remove('icon-off')
      if (desktopIcon) desktopIcon.classList.add('icon-on')
      elements.ready = true;
    })
    .catch(error => {
      console.log(error)
      elements.ready = true;
    })
  }

  const deleteSavedProductId = (productId, wishlistId) => {

    const { deviceIcon, desktopIcon } = elements

    if (!elements.ready) return

    // Arguments
    const url = sasabudi_scripts_vars.root_url + '/wp-json/wishlist/v1/manager/?id=' + wishlistId
    const nonce = sasabudi_scripts_vars.ajax_nonce
    const header = new Headers()
    header.append('X-WP-Nonce', nonce)
    const request = new Request(url, {
      method: 'DELETE',
      credentials: 'same-origin',
      headers: header,
      mode: 'cors',
      cache: 'default'
    })

    elements.ready = false;

    // set ajax waiting icon
    const targetCatalog = document.getElementById('pw' + productId)
    const targetAccount = document.getElementById('wi' + productId)
    if (targetCatalog) targetCatalog.setAttribute("data-wait", 'yes')

    // save & get ajax data
    fetch(request).then(response => {
      return response.text()
    })
    .then(results => {
      if (targetCatalog) targetCatalog.setAttribute("data-exists", 'no')
      if (targetCatalog) targetCatalog.setAttribute("data-wait", 'no')
      if (targetCatalog) targetCatalog.setAttribute("data-saved", '')
      if (targetAccount) targetAccount.setAttribute("data-removed", 'yes')
      if (results == 0 ) {
        if (deviceIcon) deviceIcon.classList.remove('icon-on')
        if (deviceIcon) deviceIcon.classList.add('icon-off')
        if (desktopIcon) desktopIcon.classList.remove('icon-on')
        if (desktopIcon) desktopIcon.classList.add('icon-off')
      }
      elements.ready = true;
    })
    .catch(error => {
      console.log(error)
      elements.ready = true;
    })
  }

  
  const init = () => {

    document.addEventListener('click', (event) => {

      /**
       * Get the current product id on click. Then check:
       * 1. Is the user already signed in. If not, show wishlist sign in modal.
       * 2. Does the user already saved this product id? If so, then 'delete' this saved product id.
       * 3. Save the product id to the user wishlist data.
       */
      if ( event.target.matches('.product-wishlist__icon') || event.target.matches('.options-wishlist__save')) {
        event.preventDefault()


        if (event.target.dataset.exists === 'signin') {
          showSignInModal()
        }
        else if (event.target.dataset.exists === 'yes') {
          deleteSavedProductId(productId, wishlistId)
        }
        else {
          createSavedProductId(productId)
        }
      }

      /**
       * Close the Wishlist Modal Overlay on click!
       */
      if ( event.target.matches('.wishlist-close') || event.target.matches('.wishlist-modal')) {
        event.preventDefault()

        hideSignInModal()
      }

      /**
       * Remove the My Account Saved Wishlist Item on click!
       */
      if ( event.target.matches('.wishlist-remove-saved-item') ) {
        event.preventDefault()

        const productId = event.target.dataset.item
        const wishlistId = event.target.dataset.saved
        
        deleteSavedProductId(productId, wishlistId)
      }

    })
  }

  init()
}
