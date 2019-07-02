import './css/app.scss'

/* -----------------------------------------
  IMPORT JS
----------------------------------------- */

import browserClasses from './js/utils/bowser'
import lazyLoad from './js/utils/lazy'
import isInViewCheck from './js/utils/inview'
import isInViewPlay from './js/utils/inview-play'
import windowHeightInit from './js/utils/window-height'

/* -----------------------------------------
  INIT
----------------------------------------- */

const initScripts = {

  init: function () {
    browserClasses()
    lazyLoad()
		isInViewCheck()
		isInViewPlay()
		windowHeightInit()
  }

}
initScripts.init()
