import '@babel/polyfill'
import 'nodelist-foreach-polyfill'
import { ElementObserver } from 'viewprt'

const isInViewCheck = () => {

  const inViewElements = document.querySelectorAll('.js-in-view')

  if (inViewElements != null) {

    inViewElements.forEach((inViewElement, index) => {
      const factsSliderObserver = ElementObserver(inViewElement, {
        onEnter (element, viewport) {
          element.classList.add('is-in-view')
        },
        once: true,
        offset: -200
      })
    })

  }

}

export default isInViewCheck
