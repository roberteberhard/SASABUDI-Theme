/**
 * This is the Ajax Featuring functionality for handling
 * the corresponding 'product' feed.
 */

import { AppObserver } from '../../base/app-observer'
import { AppSwatches } from '../../pages/catalog/app-swatches'

export const CatalogFeaturing= () => {
  
  const elements = {
    dataStart: 0,
    dataEnd: 0,
    isLoading: false,
    iconWaiting: document.querySelector('.icon-waiting'),
    featuringArchive: document.querySelector('.product-featuring'),
    featuringNext: document.querySelector('.featuring-next'),
    featuringButton: document.querySelector('.featuring-next__button')
  }

  const showFeaturingSpinner = () => {

    const { featuringNext } = elements

    if( featuringNext ) {
      
      elements.isLoading = true

      // Handle class
      featuringNext.classList.add('show-loader')          
    }
  }

  const hideFeaturingSpinner = () => {
    
    const { iconWaiting, featuringNext, featuringButton } = elements

    elements.isLoading = false

    if( featuringNext ) {

      if (elements.dataStart >= elements.dataEnd) {
        
        // Resize featuring next div
        featuringNext.classList.remove('show-loader')
        featuringNext.classList.add('is-end')
        
        // Remove childs from the DOM
        iconWaiting.parentNode.removeChild(iconWaiting)
        featuringButton.parentNode.removeChild(featuringButton)
      }
      else {

        // Handle class
        featuringNext.classList.remove('show-loader')
      }
    }
  }


  /**
   * Fetch Ajax Featuring Items
   */
  const fetchAjaxFeaturingItems = () => {

    const { featuringArchive, featuringNext } = elements

    if ( elements.isLoading ) return

    // Read and save data attribute values
    elements.dataStart   = parseInt(featuringNext.dataset.start)
    elements.dataEnd     = parseInt(featuringNext.dataset.end)
    
    // Load next items as long start attribut < end attribute
    if( elements.dataStart < elements.dataEnd) {

      // Update data start attribute
      elements.dataStart++
      featuringNext.dataset.start = elements.dataStart
                      
      showFeaturingSpinner()
      
      // Set fetch arguments
      const url = sasabudi_scripts_vars.ajax_url
      const nonce = sasabudi_scripts_vars.ajax_nonce
      const header = new Headers()
      header.append('X-WP-Nonce', nonce)
      const data = {
        action: 'sasabudi_load_catalog_featuring',
        paged: elements.dataStart
      }
      const params =  new URLSearchParams(data)
      const request = new Request(url, {
          method: 'POST',
          credentials: 'same-origin',
          headers: header,
          body: params,
          mode: 'cors',
          cache: 'default'
      })

      // Request fetch response
      fetch(request).then(response => {
        return response.text()
      }).then(html => {

        // Insert posts response
        featuringArchive.insertAdjacentHTML('beforeend', html)
        
        // Hide spinner & reinitialize product items
        hideFeaturingSpinner()
        AppObserver()
        AppSwatches()

      }).catch(error => {
        console.log("Can’t access " + url + " response. Blocked by browser?" + error)
        hideFeaturingSpinner()
      })
    } else {
      hideFeaturingSpinner()            
    }         
  }
  
  const init = () => {

    const { featuringArchive, featuringNext } = elements

    // Initalize Featuring
    if ( featuringArchive ) {
      
      // Read and save data attribute values
      elements.dataStart   = parseInt(featuringNext.dataset.start)
      elements.dataEnd     = parseInt(featuringNext.dataset.end)
      elements.isLoading   = false
      
      // Show next button on init
      if (elements.dataStart < elements.dataEnd) {
        
        // Load ajaxified product items on button click
        document.addEventListener('click', (event) => {

          if (event.target.matches('.featuring-next__button')) {
            event.preventDefault()

            fetchAjaxFeaturingItems()
          }
        })
      }
    }
  }

  init()
}