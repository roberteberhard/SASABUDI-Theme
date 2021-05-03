/**
 * This toggle the 'FAQ' tab behaviour.
 */
export const AppFAQ = () => {

  const elements = {
    faqlist: Array.from(document.querySelectorAll('.section-faq'))
  }

  const TAB_OPEN_CLASSNAME   = 'tab-open'
  const TAB_CLOSED_CLASSNAME   = 'tab-closed'

  const closeAllTabs = () => {

    const { faqlist } = elements

    // Remove active class from the tab list
    faqlist.forEach( item => {
      if( item.classList.contains(TAB_OPEN_CLASSNAME) ) {
        item.classList.remove(TAB_OPEN_CLASSNAME)
        item.classList.add(TAB_CLOSED_CLASSNAME)
      } else {
        if ( item.classList.contains(TAB_CLOSED_CLASSNAME) ) {
          item.classList.remove(TAB_CLOSED_CLASSNAME)
        }
      }
    })
  }

  const init = () => {

    document.querySelectorAll('.section-faq').forEach(item => {
      item.addEventListener('click', event => {
        closeAllTabs()
        if(!event.currentTarget.classList.contains(TAB_CLOSED_CLASSNAME)) {
          event.currentTarget.classList.add(TAB_OPEN_CLASSNAME)
        }
      })
    })

  }

  init()
}