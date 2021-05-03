/**
 * This is the Ajax BestSeller functionality for handling
 * the corresponding 'product' feed.
 */

import { AppObserver } from '../../base/app-observer'
import { AppSwatches } from '../../pages/catalog/app-swatches'

export const CatalogBestseller = () => {
  
  const elements = {
    dataStart: 0,
    dataEnd: 0,
    isLoading: false,
    iconWaiting: document.querySelector('.icon-waiting'),
    bestsellerArchive: document.querySelector('.product-bestseller'),
    bestsellerNext: document.querySelector('.bestseller-next'),
    bestsellerButton: document.querySelector('.bestseller-next__button')
  }

  const showBestsellerSpinner = () => {

    const { bestsellerNext } = elements

    if( bestsellerNext ) {
      
      elements.isLoading = true

      // Handle class
      bestsellerNext.classList.add('show-loader')          
    }
  }

  const hideBestsellerSpinner = () => {
    
    const { iconWaiting, bestsellerNext, bestsellerButton } = elements

    elements.isLoading = false

    if( bestsellerNext ) {

      if (elements.dataStart >= elements.dataEnd) {
        
        // Resize bestseller next div
        bestsellerNext.classList.remove('show-loader')
        bestsellerNext.classList.add('is-end')
        
        // Remove childs from the DOM
        iconWaiting.parentNode.removeChild(iconWaiting)
        bestsellerButton.parentNode.removeChild(bestsellerButton)
      }
      else {

        // Handle class
        bestsellerNext.classList.remove('show-loader')
      }
    }
  }


  /**
   * Fetch Ajax Bestseller Items
   */
  const fetchAjaxBestsellerItems = () => {

    const { bestsellerArchive, bestsellerNext } = elements

    if ( elements.isLoading ) return

    // Read and save data attribute values
    elements.dataStart   = parseInt(bestsellerNext.dataset.start)
    elements.dataEnd     = parseInt(bestsellerNext.dataset.end)
    
    // Load next items as long start attribut < end attribute
    if( elements.dataStart < elements.dataEnd) {

      // Update data start attribute
      elements.dataStart++
      bestsellerNext.dataset.start = elements.dataStart
                      
      showBestsellerSpinner()
      
      // Set fetch arguments
      const url = sasabudi_scripts_vars.ajax_url
      const nonce = sasabudi_scripts_vars.ajax_nonce
      const header = new Headers()
      header.append('X-WP-Nonce', nonce)
      const data = {
        action: 'sasabudi_load_catalog_best_sellers',
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
        bestsellerArchive.insertAdjacentHTML('beforeend', html)
        
        // Hide spinner & reinitialize product items
        hideBestsellerSpinner()
        AppObserver()
        AppSwatches()

      }).catch(error => {
        console.log("Can’t access " + url + " response. Blocked by browser?" + error)
        hideBestsellerSpinner()
      })
    } else {
      hideBestsellerSpinner()            
    }         
  }
  
  const init = () => {

    const { bestsellerArchive, bestsellerNext } = elements

    // Initalize Bestseller
    if ( bestsellerArchive ) {
      
      // Read and save data attribute values
      elements.dataStart   = parseInt(bestsellerNext.dataset.start)
      elements.dataEnd     = parseInt(bestsellerNext.dataset.end)
      elements.isLoading   = false
      
      // Show next button on init
      if (elements.dataStart < elements.dataEnd) {
        
        // Load ajaxified product items on button click
        document.addEventListener('click', (event) => {

          if (event.target.matches('.bestseller-next__button')) {
            event.preventDefault()

            fetchAjaxBestsellerItems()
          }
        })
      }
    }
  }

  init()
}