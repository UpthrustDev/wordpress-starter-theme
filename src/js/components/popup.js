import '@babel/polyfill'
import 'nodelist-foreach-polyfill'
import Player from '@vimeo/player'

export const popupInit = () => {
  const _html = document.documentElement
  const popupTriggers = document.querySelectorAll('.js-popup-trigger')
  const popupCloses = document.querySelectorAll('.js-popup-close')

  popupTriggers.forEach((popupTrigger, index) => {
    popupTrigger.addEventListener('click', function () {
      const popupId = popupTrigger.dataset.popup
      _html.classList.add('popup-active')
      //console.log(popupId)
      const popup = document.querySelector('[data-popup-id="' + popupId + '"]')
      popup.classList.add('is-active')
    })
  })

  popupCloses.forEach((popupClose, index) => {
    popupClose.addEventListener('click', function () {
      const popupId = popupClose.dataset.popupId
      _html.classList.remove('popup-active')
      //console.log(popupId)
      const popup = document.querySelector('[data-popup-id="' + popupId + '"]')
      popup.classList.remove('is-active')
    })
  })
}

export const popupVideoInit = () => {
  const _html = document.documentElement
  const popupVideoTriggers = document.querySelectorAll('.js-popup-video-trigger')
  const popupVideoCloses = document.querySelectorAll('.js-popup-video-close')

  popupVideoTriggers.forEach((popupVideoTrigger, index) => {
    popupVideoTrigger.addEventListener('click', function () {
      const popupId = popupVideoTrigger.dataset.popupVideo
      _html.classList.add('popup-active')

      const popup = document.querySelector('[data-popup-video-id="' + popupId + '"]')
      popup.classList.add('is-active')

      const popupVideoVimeoSrc = popup.querySelector('.js-video-vimeo')

      const popupVideoPlayer = new Player(popupVideoVimeoSrc, {
        id: popupVideoVimeoSrc.dataset.id,
        width: 1000,
        background: false
      })

      popupVideoPlayer.play().then(function () {
      }).catch(function (error) {
        console.log('Error playing video.' + error)
      })
    })
  })

  popupVideoCloses.forEach((popupVideoClose, index) => {
    popupVideoClose.addEventListener('click', function () {
      const popupId = popupVideoClose.dataset.popupVideoId
      _html.classList.remove('popup-active')

      const popup = document.querySelector('[data-popup-video-id="' + popupId + '"]')
      popup.classList.remove('is-active')

      const popupVideoVimeoSrc = popup.querySelector('.js-video-vimeo')

      const popupVideoPlayer = new Player(popupVideoVimeoSrc, {
        id: popupVideoVimeoSrc.dataset.id,
        width: 1000,
        background: false
      })

      popupVideoPlayer.pause().then(function () {
      }).catch(function (error) {
        console.log('Error playing video.' + error)
      })
    })
  })
}
