/**
 * This is the product 'Search' functionality of the Shop.
 * It opens an overlay and shows the results in it.
 */
export const AppSearch = () => {

    const elements = {
      isActive: false,
      langLocale: sasabudi_scripts_vars.root_lang.slice(-5),
      previousValue: '',
      typingTimeout: '',
      resultTimeout: '',
      body: document.body,
      deviceOpenButton: document.querySelector('.header-device__search--button'),
      desktopOpenButton: document.querySelector('.header-desktop__search--button'),
      modalCloseButton: document.querySelector('.app-search__head--close'),
      searchModal: document.getElementById('search-modal'),
      searchField: document.getElementById('search-term'),
      searchResults: document.getElementById('search-results'),
      searchLoader: document.getElementById('search-loader'),
      searchOverview: document.getElementById('search-overview'),
      resultDesc: {
        en_US: '<p class="found-products">Please type more than <strong>2</strong> characters to search</p>',
        de_DE: '<p class="found-products">Bitte gib für die Suche mehr als <strong>2</strong> Zeichen ein</p>'
      },
      swatches: null
    }
  
    const fadeInSearchModal = () => {
      const { body, searchModal, searchField } = elements

      // apply css inline style
      body.style.overflowY = 'hidden'

      // fade in modal
      searchModal.classList.remove('search--off')
      searchModal.classList.add('search--on')
      setTimeout(() => searchField.focus(), 301)
    }
  
    const fadeOutSearchModal = () => {
      const { body, searchModal, searchField } = elements

      // remove css inline style
      body.style.overflowY = ''

      // fade out modal
      searchModal.classList.remove('search--on')
      searchModal.classList.add('search--off')
      setTimeout(() => searchField.blur(), 301)
    }
  
    const fadeInSearchModalSpinner = () => {
      const { searchLoader } = elements
      searchLoader.classList.remove('loader--off')
      searchLoader.classList.add('loader--on')
    }
  
    const fadeOutSearchModalSpinner = () => {
      const { searchLoader } = elements
      searchLoader.classList.remove('loader--on')
      searchLoader.classList.add('loader--off')
    }
  
    const fadeInSearchModalOverview = () => {
      const { searchOverview } = elements
      searchOverview.classList.remove('view--off')
    }
  
    const fadeOutSearchModalOverview = () => {
      const { searchOverview } = elements
      searchOverview.classList.add('view--off')
    }
  
    const handleKeyDown = ({ keyCode }) => {
      // Close modal when esc key is pressed.
      if (keyCode === 27) {
         hideSearchModalView()
      }
    }
  
    const getResults = () => {
      const { searchField, searchResults, resultDesc, langLocale } = elements

      // results must be more then 2
      let typingVal = searchField.value.trim()
      let typingNum = typingVal.length
  
      if(typingNum > 2) {

        fetch(sasabudi_scripts_vars.root_url + '/wp-json/sasabudi/v1/search?term=' + typingVal).then(response => {
          return response.json()
        }).then(results => {

          if(results.products.length > 0) {
            clearTimeout(elements.resultTimeout)
            const resultAmount = `<p class="found-products">We found <strong>${results.products.length}</strong> products for <strong>"${typingVal}"</strong></p>`
            const resultProducts = `
              ${results.products.length ? `<div id="ajaxsearchresults" data-search="${typingVal}" class="app-search__wrapper"><ul class="results">` : ''}
                ${results.products.map(item => `<li class="result-item" data-id="${item.id}"><article class="result-article"><a href="${item.permalink}" tabindex="0"><div class="result-article__figure"><img class="result-article__figure--secondary lazy-img" id="r-${item.id}" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="${item.alt}" data-src="${item.secondary}"><img class="result-article__figure--primary lazy-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="100%" heigth="100%" alt="${item.alt}" data-src="${item.primary}"></div>${item.sale == 1 ? '<div class="result-article__sale">Sale</div>' : ''}<div class="result-article__desc"><div class="item-box"><div class="item-box__model">${item.title}</div><div class="item-box__price">${item.price}</div><div class="item-box__color">${item.colors}</div></div></div></a></article></li>`).join('')}
              ${results.products.length ? '</ul></div>' : ''}`  
            searchResults.innerHTML = resultAmount
            searchResults.insertAdjacentHTML('beforeend', resultProducts);
            elements.resultTimeout = setTimeout(function() {
              revalidateImageObserver()
              revalidateProductSwatches()
            }, 200)
            fadeOutSearchModalSpinner()
            fadeOutSearchModalOverview()
  
          } else {
            searchResults.innerHTML = `<p class="found-products">We found <strong>${results.products.length}</strong> products for <strong>"${typingVal}"</strong></p>`
            fadeOutSearchModalSpinner()
            fadeInSearchModalOverview()
          }
        }).catch(error => {
          searchResults.innerHTML = '<p class="found-products">Can’t access response.' + error + '</p>'
          fadeOutSearchModalSpinner()
          fadeInSearchModalOverview()
        })
      } else {
        searchResults.innerHTML = resultDesc[langLocale]
        fadeOutSearchModalSpinner()
        fadeInSearchModalOverview()
      }
    }
  
    const handleTypingLogic = () => {
      const { searchField, searchResults, resultDesc, langLocale } = elements
  
      if(searchField.value != elements.previousValue) {
        if(searchField.value.trim()) {
          clearTimeout(elements.typingTimeout)
          fadeInSearchModalSpinner()
          elements.typingTimeout = setTimeout(getResults, 750)
        } else {
          searchResults.innerHTML = resultDesc[langLocale]
          fadeOutSearchModalSpinner()
          fadeInSearchModalOverview()
        } 
      }
      elements.previousValue = searchField.value
    }
  
    const showSearchModalView = () => {
      const { searchField, searchResults, resultDesc, langLocale } = elements
  
      if( elements.isActive ) return
      elements.isActive = true
  
      fadeInSearchModal()
      fadeInSearchModalOverview()
      searchField.value = ''
      searchField.addEventListener('keyup', handleTypingLogic, false) // Only listen for keyup events when modal is open.
      document.addEventListener('keydown', handleKeyDown, false)  // Only listen for keydown events when modal is open.
      searchResults.innerHTML = resultDesc[langLocale]
    }
  
    const hideSearchModalView = () => {
      const { searchField } = elements
  
      if( !elements.isActive ) return
      elements.isActive = false
  
      fadeOutSearchModal()
      fadeOutSearchModalSpinner()
      searchField.removeEventListener('keyup', handleTypingLogic, false) // Remove the for keyup events when modal is closed.
      document.removeEventListener('keydown', handleKeyDown, false) // Remove the for keydown events when modal is closed.
    }
  
    const init = () => {
      const { deviceOpenButton, desktopOpenButton, modalCloseButton } = elements
      if( deviceOpenButton ) {
        // Open overlay on 'device' button click
        deviceOpenButton.addEventListener('click', (e) => {
          e.preventDefault()
          showSearchModalView()
        })
      }
      if( desktopOpenButton ) {
        // Open overlay on 'desktop' button click
        desktopOpenButton.addEventListener('click', (e) => {
          e.preventDefault()
          showSearchModalView()
        })
      }
      if( modalCloseButton ) {
        // Close overlay on 'search' close button click
        modalCloseButton.addEventListener('click', (e) => {
          e.preventDefault()
          hideSearchModalView()
        })
      }
    }
  
    /**
     * Similar to imageObserver.js
     */
    const revalidateImageObserver = () => {
      const { searchResults } = elements
      const images = [].slice.call(searchResults.querySelectorAll("img.lazy-img"))
      const imageObserver = new IntersectionObserver( (entries, imageObserver) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            let lazyImage = entry.target
            if (!lazyImage.classList.contains('lazy-fade')) {
              if (lazyImage.classList.contains('lazy-img')) {
                if(lazyImage.dataset.src) {
                  lazyImage.src = lazyImage.dataset.src;
                  lazyImage.classList.remove('lazy-img');
                  lazyImage.classList.add('lazy-fade');
                  delete lazyImage.dataset.src;
                  imageObserver.unobserve(lazyImage);
                }
              }
            }
          }
        })
      })
      images.forEach((v) => {
          imageObserver.observe(v);
      });
    }
  
    /**
     * Similar to productSwatches.js
     */
    const revalidateProductSwatches = () => {
      const { searchResults } = elements
      elements.swatches = Array.from(searchResults.querySelectorAll('.variant-color'))
      elements.swatches.forEach(item => {
        if( item.dataset.sTrigger === 'on') {
          item.dataset.sTrigger = 'off' // Hack for not setting multiple eventlistener on the same swatch!
          item.addEventListener('mouseover', event => {
            const color_dot = event.target
            const color_swatch = event.currentTarget
            const range_r = event.currentTarget.dataset.sId
            markSelectedProductSwatchColorAsActive( color_dot, range_r )
            showSelectedProductSwatchColorSecondImage( color_swatch )
          })
          item.addEventListener('mouseout', event => {
            resetProductSwatchesToOrigin( event.currentTarget, event.currentTarget.dataset.sId )
          })
        }
      })
    }
  
    const markSelectedProductSwatchColorAsActive = ( color_dot, range_r ) => {
      const { swatches } = elements
      swatches.forEach( item => {
        if( item.dataset.sId === range_r ) {
          const swatch_color = item.getElementsByClassName('variant-color__icon')[0]
          // Remove active class from the swatch color
          if( swatch_color.classList.contains('active') ) {
            swatch_color.classList.remove('active')
          }
        }
      })
      if( !color_dot.classList.contains('variant-color') ) {
        // Mark selected product color swatch as 'active'
        color_dot.classList.add('active')
      }
    }
  
    const showSelectedProductSwatchColorSecondImage = ( color_swatch ) => {
      const second_id = color_swatch.dataset.sId
      const second_img = color_swatch.dataset.sSrc
      // Switch product second image with selected one!
      if( second_img ) {
        document.getElementById(second_id).src = second_img
      }
    }
  
    const resetProductSwatchesToOrigin = ( color_swatch, range_r ) => {
      const { swatches } = elements
      swatches.forEach( item => {
        // Selected product color range
        if( item.dataset.sId === range_r ) {
          const swatch_color = item.getElementsByClassName('variant-color__icon')[0]
          // Remove active class from the swatch color
          if( swatch_color.classList.contains('active') ) {
            swatch_color.classList.remove('active')
          } 
          // Mark back origine product color swatch as 'active
          if( swatch_color.classList.contains('origine') ) {
            swatch_color.classList.add('active')
          } 
        }
        // Set back second image with gallery image
        const second_id = color_swatch.dataset.sId
        const gallery_img = color_swatch.dataset.gSrc
        if( gallery_img ) {
          document.getElementById(second_id).src = gallery_img
        }
      })
    }
  
    init()
  }