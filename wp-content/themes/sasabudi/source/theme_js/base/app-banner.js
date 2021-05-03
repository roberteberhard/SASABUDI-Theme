/**
 * This is the product 'Banner' functionality of the Shop.
 * It checks if the image is loaded and animates the image.
 */
export const AppBanner = () => {

  const elements = {
    heroBanner: document.getElementById('hero_banner'),
    buttonExplore: document.getElementsByClassName('banner-explore')[0]
  }

  const START_BANNER_ANIM = 'animate-in'

  const preloadImage = () => {

    const { heroBanner, buttonExplore } = elements

    window.addEventListener('load', () => {

      const image = document.getElementsByClassName('banner-image')[0]
      const isLoaded = image.complete && image.naturalHeight !== 0

      if(isLoaded) {
        // Add class for animation
        heroBanner.classList.add(START_BANNER_ANIM)
        buttonExplore.classList.add(START_BANNER_ANIM)
      }      
    })
  }

  const init = () => {

    const { heroBanner } = elements

    if (heroBanner) {
      preloadImage()
    }
  }
  
  init()
}