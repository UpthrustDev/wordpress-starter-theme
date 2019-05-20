import '@babel/polyfill'

export const menuInit = () => {

  const menuButtons = document.querySelectorAll('.js-menu-button')

  menuButtons.forEach(menuButton => {
    menuButton.addEventListener('click', function (e) {
      document.documentElement.classList.toggle('is-menu')
    })
  })

}
