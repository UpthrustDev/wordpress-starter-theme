import bowser from 'bowser'

const browserClasses = () => {

	// TEST MOBILE/TABLET/DESKTOP
  if (bowser.mobile) {

    document.documentElement.classList.add('is-mobile')

  } else if (bowser.tablet) {

    document.documentElement.classList.add('is-tablet')

  } else {

    document.documentElement.classList.add('is-desktop')

  }

	// TEST EDGE
  if (bowser.msedge) {
    document.documentElement.classList.add('is-edge')
  }

	// TEST IE
  if (bowser.msie) {
    document.documentElement.classList.add('is-ie')
  }

}

export default browserClasses
