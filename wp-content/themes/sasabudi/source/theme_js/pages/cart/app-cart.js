/**
 * This handels the cart page functionality
 */
export const AppCart = () => {

  const elements = {
    inputQuantity: 0,
    inputMinQuantity: 0,
    inputMaxQuantity: 0,
    inputTimeout: undefined
  }

  const handleMinusButtonClick = (target) => {

    if (target) {

      const cartQuantity = target.parentNode.querySelector('input.custom-qty')
      const updateButton = document.getElementById('coupon_update')

      // Attributes
      updateButton.disabled = false
      elements.inputQuantity = parseInt(cartQuantity.value)
      elements.inputMinQuantity = parseInt(cartQuantity.getAttribute('min'))

      // count --
      if (elements.inputQuantity > elements.inputMinQuantity) {
        cartQuantity.value = parseInt(cartQuantity.value) - 1
      }
    }
  }

  const handlePlusButtonClick = (target) => {

    if (target) {

      const cartQuantity = target.parentNode.querySelector('input.custom-qty')
      const updateButton = document.getElementById('coupon_update')

      // Attributes
      updateButton.disabled = false
      elements.inputQuantity = parseInt(cartQuantity.value)
      elements.inputMaxQuantity = parseInt(cartQuantity.getAttribute('max'))

      // count ++
      if (elements.inputQuantity < elements.inputMaxQuantity) {
        cartQuantity.value = parseInt(cartQuantity.value) + 1
      }
    }
  }

  const init = () => {

    /**
     * Handle - Button Click
     */
    document.addEventListener('click', (event) => {

      if (event.target.matches('.cart-minus__btn')) {
        
        // manage minus button click
        clearTimeout(elements.inputTimeout)
        elements.inputTimeout = setTimeout( function () {
          handleMinusButtonClick(event.target)
        }, 150)
      }

      if (event.target.matches('.cart-plus__btn')) {
        
        // manage plus button click
        clearTimeout(elements.inputTimeout)
        elements.inputTimeout = setTimeout( function () {
          handlePlusButtonClick(event.target)
        }, 150)
        
      }
    })
  }

  init()
}