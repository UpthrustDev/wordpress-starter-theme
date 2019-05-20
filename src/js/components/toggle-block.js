import '@babel/polyfill'
import 'nodelist-foreach-polyfill'

// Mobile Menu
export const toggleBlocksInit = () => {

  const toggleBlocks = document.querySelectorAll('.toggle-block__title')

  if ( toggleBlocks != null ) {
    toggleBlocks.forEach((toggleBlock, index) => {
      toggleBlock.addEventListener('click', function () {
        if (toggleBlock.parentNode.classList.contains('is-active')) {
          toggleBlock.parentNode.classList.remove('is-active')
        } else {
          toggleBlock.parentNode.classList.add('is-active')
        }
      })
    })
  }

}
