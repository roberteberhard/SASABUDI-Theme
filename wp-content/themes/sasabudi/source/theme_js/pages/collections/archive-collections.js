/**
 * This fetches the next Archive and Single Collections items by ajax
 * and adds them as new items to the end of the 'collections' feed.
 */

import { AppObserver } from '../../base/app-observer'
import { AppSwatches } from '../../pages/catalog/app-swatches'

export const ArchiveCollections = () => {

  const elements  = {
    dataStart: 0,
    dataEnd: 0,
    dataID: 0,
    isLoading: false,
    collectionsArchive: document.getElementById('collections-archive'),
    collectionsNext: document.getElementById('collections-next'),
    collectionSingle: document.getElementById('collection-single'),
    collectionNext: document.getElementById('collection-next')
  }

  const showCollectionSpinner = () => {

    const { collectionsNext, collectionNext } = elements

    elements.isLoading = true

    if( collectionsNext ) {
       // Handle Classes
      collectionsNext.classList.remove('fade-out')
      collectionsNext.classList.add('fade-in')          
    }

    if( collectionNext ) {
       // Handle Classes
      collectionNext.classList.remove('fade-out')
      collectionNext.classList.add('fade-in')          
    }
  }

  const hideCollectionSpinner = () => {

    const { dataStart, dataEnd, collectionsNext, collectionNext } = elements

    elements.isLoading = false

    if (collectionsNext) {
       // Handle Classes
      collectionsNext.classList.remove('fade-in')
      collectionsNext.classList.add('fade-out')
      
      if (dataStart >= dataEnd) {
          // Remove Spinner
          collectionsNext.parentNode.removeChild(collectionsNext)  
      }     
    }

    if (collectionNext) {
      // Handle Classes
      collectionNext.classList.remove('fade-in')
      collectionNext.classList.add('fade-out')
      
      if (dataStart >= dataEnd) {
        // Remove Spinner
        collectionNext.parentNode.removeChild(collectionNext) 
      }      
    }
  }

  /**
   * Fetch Archive Collection Items
   */
  const fetchArchiveCollectionsItems = () => {

    const { collectionsArchive, collectionsNext } = elements

    if (elements.isLoading) return

    // Read and save data attribute values
    elements.dataStart   = parseInt(collectionsNext.dataset.start)
    elements.dataEnd     = parseInt(collectionsNext.dataset.end)

    if (elements.dataStart < elements.dataEnd) {

      // Update data start attribute
      elements.dataStart++
      collectionsNext.dataset.start = elements.dataStart
      
      showCollectionSpinner()

      // Set fetch arguments
      const url = sasabudi_scripts_vars.ajax_url
      const nonce = sasabudi_scripts_vars.ajax_nonce
      const header = new Headers()
      header.append('X-WP-Nonce', nonce)
      const data = {
        action: 'sasabudi_load_archive_collections',
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
        collectionsArchive.insertAdjacentHTML('beforeend', html)

        // Hide spinner & reinitialize product items
        hideCollectionSpinner()
        AppObserver()

      }).catch(error => {
        console.log("Can’t access " + url + " response. Blocked by browser?" + error)
        hideCollectionSpinner()
      })
    } else {
      hideCollectionSpinner()            
    }
  }

  /**
   * Fetch Single Product Items
   */
  const fetchSingleProductItems = () => {

    const { collectionSingle, collectionNext } = elements

    if ( elements.isLoading ) return

    // Read and save data attribute values
    elements.dataStart   = parseInt(collectionNext.dataset.start)
    elements.dataEnd     = parseInt(collectionNext.dataset.end)
    elements.dataID      = parseInt(collectionNext.dataset.id)

    if (elements.dataStart < elements.dataEnd) {

      elements.dataStart++
      collectionNext.dataset.start = elements.dataStart
          
      showCollectionSpinner()

      // Set fetch arguments
      const url = sasabudi_scripts_vars.ajax_url
      const nonce = sasabudi_scripts_vars.ajax_nonce
      const header = new Headers()
      header.append('X-WP-Nonce', nonce)
      const data = {
        action: 'sasabudi_load_single_collections',
        security: nonce,
        post: elements.dataID,
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
        collectionSingle.insertAdjacentHTML('beforeend', html)

        hideCollectionSpinner()
        AppObserver()
        AppSwatches()

      }).catch(error => {
        console.log("Can’t access " + url + " response. Blocked by browser?" + error)
        hideCollectionSpinner()
      }) 
    } else {
      hideCollectionSpinner()
    }
  }  

  const init = () => {

    const { collectionsNext, collectionNext } = elements

    elements.dataStart   = 0
    elements.dataEnd     = 0
    elements.dataID      = 0
    elements.isLoading   = false

    // Initalize Archive Page
    if (collectionsNext) {

      const fetchArchiveObserver = new IntersectionObserver(entries => {

        const archiveLoadingSpin = entries[0]

        if (archiveLoadingSpin.isIntersecting) {

          // Fetch next collection items data
          fetchArchiveCollectionsItems()
        }
      })

      fetchArchiveObserver.observe(collectionsNext)
    }

    // Initalize Single Page
    if (collectionNext) {

      const fetchSingleObserver = new IntersectionObserver(entries => {

        const singleLoadingSpin = entries[0]

        if (singleLoadingSpin.isIntersecting) {

          // Fetch next single product items data
          fetchSingleProductItems()
        }
      })

      fetchSingleObserver.observe(collectionNext)
    }
  }

  init()
}