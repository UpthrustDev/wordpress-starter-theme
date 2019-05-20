import '@babel/polyfill'
import 'nodelist-foreach-polyfill'

export const tabsInit = () => {

  const myTabs = document.querySelectorAll('.js-tabs > .tab')

  function myTabClicks (tabClickEvent) {
    for (let i = 0; i < myTabs.length; i++) {
      myTabs[i].classList.remove('is-active')
    }
    const clickedTab = tabClickEvent.currentTarget
    clickedTab.classList.add('is-active')
    const tabPanes = document.querySelectorAll('.js-pane')
    for (let i = 0; i < tabPanes.length; i++) {
      tabPanes[i].classList.remove('is-active');
			tabPanes[i].classList.remove('is-open');
    }
    const activeTab = clickedTab.dataset.tabId
    const activePane = document.querySelector('[data-pane-id="' + activeTab + '"]')
    activePane.classList.add('is-active');
		setTimeout(function () {
			activePane.classList.add('is-open');
		}, 20);
  }

  for (let i = 0; i < myTabs.length; i++) {
		myTabs[i].addEventListener('click', myTabClicks)
  }

}
