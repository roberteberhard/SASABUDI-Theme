/**
 * This handels the blog page functionality
 */
export const AppBlog = () => {

  const elements = {
    collectionBanner: document.querySelector('.collection-header__figure--white'),
    archiveBanner: document.querySelector('.blog-hero__figure--white'),
    singleBanner: document.querySelector('.post-hero__figure--white')
  }

  const MOBILE_AND_TABLET_SIZE = 901

  const handleScroll = () => {

    const { collectionBanner, archiveBanner, singleBanner } = elements

    // Manage collection Banner
    if ( collectionBanner ) {

      let collectionPosition = document.documentElement.scrollTop
      let collectionRemaining = collectionBanner.scrollHeight + 100
      let collectionPercentage = (collectionPosition / collectionRemaining)

      collectionBanner.style.opacity = 0
      if ( window.innerWidth >= MOBILE_AND_TABLET_SIZE ) collectionBanner.style.opacity = collectionPercentage
    }

    // Manage archive Banner
    if ( archiveBanner ) {

      let archivePosition = document.documentElement.scrollTop
      let archiveRemaining = archiveBanner.scrollHeight + 100
      let archivePercentage = (archivePosition / archiveRemaining)

      archiveBanner.style.opacity = 0
      if ( window.innerWidth >= MOBILE_AND_TABLET_SIZE ) archiveBanner.style.opacity = archivePercentage
    }

    // Manage single Banner
    if ( singleBanner ) {

      let singlePosition = document.documentElement.scrollTop
      let singleRemaining = singleBanner.scrollHeight + 100
      let singlePercentage = (singlePosition / singleRemaining)

      singleBanner.style.opacity = 0
      if ( window.innerWidth >= MOBILE_AND_TABLET_SIZE ) singleBanner.style.opacity = singlePercentage
    }

  }

  const init = () => {
    window.addEventListener('resize', handleScroll)
    window.addEventListener('scroll', handleScroll)
      
    // Execute
    handleScroll() 
  }

  init()
}