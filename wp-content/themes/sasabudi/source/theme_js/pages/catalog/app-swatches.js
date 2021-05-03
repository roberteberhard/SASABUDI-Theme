/**
 * This handels the product variant colors
 */
export const AppSwatches = () => {

  const elements = {
    swatches: Array.from(document.querySelectorAll('.variant-color'))
  }

  const SWATCH_ACTIVE_CLASSNAME   = 'active'
  const SWATCH_ORIGINE_CLASSNAME  = 'origine'
  const SWATCH_COLOR_CLASSNAME    = 'variant-color__icon'

  /**
   * On mouse over first remove all 'active' classes for the selected product 
   * swatches and then mark the 'active' color.
   */
  const markSelectedSwatchColorAsActive = ( color_dot, range_s ) => {

    const { swatches } = elements

    // Loop over product color swatches
    swatches.forEach( item => {
      // Selected product color range
      if( item.dataset.sId === range_s ) {
        const swatch_color = item.getElementsByClassName(SWATCH_COLOR_CLASSNAME)[0]
        // Remove active class from the swatch color
        if( swatch_color.classList.contains(SWATCH_ACTIVE_CLASSNAME) ) {
          swatch_color.classList.remove(SWATCH_ACTIVE_CLASSNAME)
        }
      }
    })

    if( !color_dot.classList.contains('variant-color') ) {
      // Mark selected product color swatch as 'active'
      color_dot.classList.add(SWATCH_ACTIVE_CLASSNAME)
    }
  }

  const showSelectedSwatchColorSecondImage = ( color_swatch ) => {

    const second_id = color_swatch.dataset.sId
    const second_img = color_swatch.dataset.sSrc

    // Change product second image with selected one!
    if( second_img ) {
      document.getElementById(second_id).src = second_img
    }
  }

  /**
   * On mouse out first remove all 'active' classes for the selectd product
   * swatches and then mark the 'origin' one as 'active'.
   */
  const resetSwatchStylesToOrigin = ( color_swatch, range_s ) => 
  {

    const { swatches } = elements

    // Loop over product color swatches
    swatches.forEach( item => {

      // Selected product color range
      if( item.dataset.sId === range_s ) {
        const swatch_color = item.getElementsByClassName(SWATCH_COLOR_CLASSNAME)[0]
        // Remove active class from the swatch color
        if( swatch_color.classList.contains(SWATCH_ACTIVE_CLASSNAME) ) {
          swatch_color.classList.remove(SWATCH_ACTIVE_CLASSNAME)
        } 
        // Mark back origine product color swatch as 'active
        if( swatch_color.classList.contains(SWATCH_ORIGINE_CLASSNAME) ) {
          swatch_color.classList.add(SWATCH_ACTIVE_CLASSNAME)
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

  const init = () => {
    /**
     * Toggle eventlistener between device mode (onTouch) or
     * desktop mode (onMouseOver).
     *
     * TODO: ON TOUCH MODE
     */
    document.querySelectorAll('.variant-color').forEach(item => {
      /**
       * Device Style
       */
      /**
       * Desktop Style
       */
      if( item.dataset.sTrigger === 'on') {
        // Hack for not setting multiple eventlistener on the same swatch!
        item.dataset.sTrigger = 'off'
        item.addEventListener('mouseover', event => {
          const color_dot = event.target
          const color_swatch = event.currentTarget
          const range_s = event.currentTarget.dataset.sId
          markSelectedSwatchColorAsActive( color_dot, range_s )
          showSelectedSwatchColorSecondImage( color_swatch )
          // possibilities:
          // event.currentTarget.getElementsByClassName("variant-color__icon")[0]
          // event.target.classList.add(SWATCH_ACTIVE_CLASSNAME)
        })

        item.addEventListener('mouseout', event => {
          const color_swatch = event.currentTarget
          const range_s = event.currentTarget.dataset.sId
          resetSwatchStylesToOrigin( color_swatch, range_s )
        })
      }
    })
  }

  init()
}