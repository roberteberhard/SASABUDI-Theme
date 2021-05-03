import Glide, { Controls, Breakpoints, Swipe } from '@glidejs/glide/dist/glide.modular.esm'

export const AppSwipers = () => {

  const elements = {
    statement: document.getElementById('glide_statements'),
    megamenu: document.getElementById('glide_megamenu')
  }

  const init = () => {

    const { statement, megamenu } = elements

    if( statement ) {
      new Glide(elements.statement, {
        type: 'carousel',
        perView: 3,
        bound:false,
        breakpoints: {
          901: {
            perView: 2
          },
          580: {
            perView: 1
          }
        }
      }).mount({ Controls, Breakpoints, Swipe })
    }

    if( megamenu ) {
      new Glide(elements.megamenu, {
        type: 'carousel',
        perView: 1,
        bound: false
      }).mount({ Controls, Swipe })
    }
  }

  init()
}