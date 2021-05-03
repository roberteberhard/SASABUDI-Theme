/**
 * This fetches the next Archive Instagram items by ajax and
 * adds them as new items to the end of the 'instagram' feed.
 */

import { AppObserver } from '../../base/app-observer'

export const ArchiveInstagram = () => {

  const elements = {
    dataStart: 0,
    dataEnd: 0,
    isLoading: false,
    instaPosts: document.getElementById('ig-posts'),
    instaNext: document.getElementById('ig-next')
  }

  const showInstaSpinner = () => {

    const { instaNext } = elements

    elements.isLoading = true

    // Manage classes
    instaNext.classList.remove('fade-out')
    instaNext.classList.add('fade-in')
  }

  const hideInstaSpinner = () => {

    const { instaNext } = elements

    elements.isLoading = false

    // Manage classes
    instaNext.classList.remove('fade-in')
    instaNext.classList.add('fade-out')

    if( elements.dataStart >= elements.dataEnd ) {
      // Remove spinner
      instaNext.parentNode.removeChild(instaNext) 
    }  
  }

  const fetchNextInstaPosts = () => {

    const { instaPosts, instaNext } = elements

    // Stop here when feed is in execution process!
    if( elements.isLoading ) return

    // Read and save data attribute values
    elements.dataStart   = instaNext.dataset.start
    elements.dataEnd     = instaNext.dataset.end

    // Fetch more posts
    if( elements.dataStart < elements.dataEnd ) {
        
        // Update data start attribute
        elements.dataStart++
        instaNext.dataset.start = elements.dataStart
            
        showInstaSpinner()

        // Set fetch arguments
        const url = sasabudi_scripts_vars.ajax_url
        const nonce = sasabudi_scripts_vars.ajax_nonce
        const header = new Headers()
        header.append('X-WP-Nonce', nonce)
        const data = {
            action: 'sasabudi_load_archive_instagrams',
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
          instaPosts.insertAdjacentHTML('beforeend', html)

          hideInstaSpinner()
          AppObserver()
        
        }).catch(error => {
          console.log("Can’t access " + url + " response. Blocked by browser?" + error)
          hideInstaSpinner() 
      })   

    } else {
      hideInstaSpinner()
    }
  }

  const init = () => {

    const { instaNext } = elements

    if( instaNext ) {
      
      const fetchObserver = new IntersectionObserver(entries => {
        
        const loadingSpin = entries[0]
        if (loadingSpin.isIntersecting) {
          // Fetch next data
          fetchNextInstaPosts()
        }
      })
      fetchObserver.observe(instaNext)
    }
  }

  init()
}
