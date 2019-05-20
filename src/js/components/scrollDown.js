import '@babel/polyfill'
import 'nodelist-foreach-polyfill'
import vanillaSmoothie from 'vanilla-smoothie'

export const scrollDownInit = () => {

  document.querySelectorAll('.smooth').forEach((anchor) => {
    anchor.addEventListener('click', (event) => {
      vanillaSmoothie.scrollTo('#' + anchor.dataset.id, 600)
    })
  })

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {

    if (anchor.href.slice(-1) === '#') return;

    anchor.addEventListener('click', (event) => {
      vanillaSmoothie.scrollTo(event.target.getAttribute('href'), 600)
    })
  })

}
