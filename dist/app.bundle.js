/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		"main": 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["./src/index.js","vendors"]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/css/app.scss":
/*!**************************!*\
  !*** ./src/css/app.scss ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./css/app.scss */ "./src/css/app.scss");
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_css_app_scss__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _js_utils_bowser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/utils/bowser */ "./src/js/utils/bowser.js");
/* harmony import */ var _js_utils_lazy__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/utils/lazy */ "./src/js/utils/lazy.js");
/* harmony import */ var _js_utils_inview__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./js/utils/inview */ "./src/js/utils/inview.js");
/* harmony import */ var _js_utils_inview_play__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./js/utils/inview-play */ "./src/js/utils/inview-play.js");
/* harmony import */ var _js_components_header__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./js/components/header */ "./src/js/components/header.js");
/* harmony import */ var _js_components_tabs__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./js/components/tabs */ "./src/js/components/tabs.js");
/* harmony import */ var _js_components_menu__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./js/components/menu */ "./src/js/components/menu.js");
/* harmony import */ var _js_components_bag__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./js/components/bag */ "./src/js/components/bag.js");
/* harmony import */ var _js_components_language__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./js/components/language */ "./src/js/components/language.js");
/* harmony import */ var _js_components_faq__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./js/components/faq */ "./src/js/components/faq.js");
/* harmony import */ var _js_components_product__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./js/components/product */ "./src/js/components/product.js");
/* harmony import */ var _js_components_scrollDown__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./js/components/scrollDown */ "./src/js/components/scrollDown.js");
/* harmony import */ var _js_pages_home__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./js/pages/home */ "./src/js/pages/home.js");
/* harmony import */ var _js_components_popup__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./js/components/popup */ "./src/js/components/popup.js");
/* harmony import */ var _js_components_accordion__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./js/components/accordion */ "./src/js/components/accordion.js");
/* harmony import */ var _js_components_sticky_sidebar__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./js/components/sticky-sidebar */ "./src/js/components/sticky-sidebar.js");
/* harmony import */ var _js_components_checkout_login_toggle__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./js/components/checkout-login-toggle */ "./src/js/components/checkout-login-toggle.js");
/* harmony import */ var _js_utils_ie_object_fit__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./js/utils/ie-object-fit */ "./src/js/utils/ie-object-fit.js");

/* -----------------------------------------
  IMPORT JS
----------------------------------------- */



















/* -----------------------------------------
  INIT
----------------------------------------- */

var goodmorningScripts = {
  init: function init() {
    Object(_js_utils_bowser__WEBPACK_IMPORTED_MODULE_1__["default"])();
    Object(_js_utils_lazy__WEBPACK_IMPORTED_MODULE_2__["default"])();
    Object(_js_components_faq__WEBPACK_IMPORTED_MODULE_10__["faqInit"])();
    Object(_js_components_tabs__WEBPACK_IMPORTED_MODULE_6__["tabsInit"])();
    Object(_js_components_menu__WEBPACK_IMPORTED_MODULE_7__["menuInit"])();
    Object(_js_components_bag__WEBPACK_IMPORTED_MODULE_8__["bagInit"])();
    Object(_js_components_header__WEBPACK_IMPORTED_MODULE_5__["headerInit"])();
    Object(_js_components_language__WEBPACK_IMPORTED_MODULE_9__["languageInit"])();
    Object(_js_pages_home__WEBPACK_IMPORTED_MODULE_13__["stepsSliderInit"])();
    Object(_js_pages_home__WEBPACK_IMPORTED_MODULE_13__["factsSliderInit"])();
    Object(_js_pages_home__WEBPACK_IMPORTED_MODULE_13__["flavorsSliderInit"])();
    Object(_js_utils_inview__WEBPACK_IMPORTED_MODULE_3__["default"])();
    Object(_js_utils_inview_play__WEBPACK_IMPORTED_MODULE_4__["default"])();
    Object(_js_components_accordion__WEBPACK_IMPORTED_MODULE_15__["accordionInit"])();
    Object(_js_components_scrollDown__WEBPACK_IMPORTED_MODULE_12__["scrollDownInit"])();
    Object(_js_components_product__WEBPACK_IMPORTED_MODULE_11__["initProduct"])();
    Object(_js_components_popup__WEBPACK_IMPORTED_MODULE_14__["popupInit"])();
    Object(_js_components_popup__WEBPACK_IMPORTED_MODULE_14__["popupVideoInit"])();
    Object(_js_components_sticky_sidebar__WEBPACK_IMPORTED_MODULE_16__["stickySidebarInit"])();
    Object(_js_components_checkout_login_toggle__WEBPACK_IMPORTED_MODULE_17__["checkoutLoginToggleInit"])();
    Object(_js_utils_ie_object_fit__WEBPACK_IMPORTED_MODULE_18__["objectFitPolyfill"])();
  }
};
goodmorningScripts.init();

/***/ }),

/***/ "./src/js/components/accordion.js":
/*!****************************************!*\
  !*** ./src/js/components/accordion.js ***!
  \****************************************/
/*! exports provided: accordionInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "accordionInit", function() { return accordionInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);

var accordionInit = function accordionInit() {
  var accordionItems = document.querySelectorAll('.ingredients-accordion__item');
  accordionItems.forEach(function (item) {
    item.querySelector('.ingredients-accordion__tab').addEventListener('click', function (e) {
      var currentAccordionItems = item.closest('.ingredients-accordion').querySelectorAll('.ingredients-accordion__item');
      currentAccordionItems.forEach(function (elem) {
        if (elem.classList.contains('ingredients-accordion__item_active')) {
          elem.classList.remove('ingredients-accordion__item_active');
        }
      });
      item.closest('.ingredients-accordion__item').classList.toggle('ingredients-accordion__item_active');
    });
  });
};

/***/ }),

/***/ "./src/js/components/bag.js":
/*!**********************************!*\
  !*** ./src/js/components/bag.js ***!
  \**********************************/
/*! exports provided: bagInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "bagInit", function() { return bagInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);

var bagInit = function bagInit() {
  var button = document.querySelector('.js-bag-button');
  var bag = document.querySelector('.js-bag');
  button.addEventListener('click', function () {
    bag.classList.add('b-bag_active');
  });
  document.addEventListener('mousedown', function (e) {
    if (!bag.contains(e.target)) {
      bag.classList.remove('b-bag_active');
    }
  });
};

/***/ }),

/***/ "./src/js/components/checkout-login-toggle.js":
/*!****************************************************!*\
  !*** ./src/js/components/checkout-login-toggle.js ***!
  \****************************************************/
/*! exports provided: checkoutLoginToggleInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "checkoutLoginToggleInit", function() { return checkoutLoginToggleInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);

var checkoutLoginToggleInit = function checkoutLoginToggleInit() {
  var toggleLink = document.querySelector('.p-checkout a.showlogin');

  if (toggleLink) {
    // create copy of node to avoid click event error in scrollDown.js
    var copy = toggleLink.cloneNode(true);
    toggleLink.closest('.woocommerce-info').replaceChild(copy, toggleLink);
    var newToggleLink = document.querySelector('.p-checkout a.showlogin');
    newToggleLink.addEventListener('click', function (e) {
      var form = document.querySelector('.woocommerce-form-login-wrapper').classList.toggle('js-show');
    });
  }
};

/***/ }),

/***/ "./src/js/components/faq.js":
/*!**********************************!*\
  !*** ./src/js/components/faq.js ***!
  \**********************************/
/*! exports provided: faqInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "faqInit", function() { return faqInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);

var faqInit = function faqInit() {
  var faqItems = document.querySelectorAll('.b-faqs__item');
  faqItems.forEach(function (item) {
    item.querySelector('.b-faqs__head').addEventListener('click', function (e) {
      item.classList.toggle('b-faqs__item_active');
    });
  });
};

/***/ }),

/***/ "./src/js/components/header.js":
/*!*************************************!*\
  !*** ./src/js/components/header.js ***!
  \*************************************/
/*! exports provided: headerInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "headerInit", function() { return headerInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);

var headerInit = function headerInit() {
  var header = document.querySelector('.b-header');

  window.onscroll = function changeClass() {
    var scrollPosY = window.pageYOffset | document.body.scrollTop;

    if (scrollPosY > 50) {
      header.classList.add('is-sticky');
    } else {
      header.classList.remove('is-sticky');
    }
  };
};

/***/ }),

/***/ "./src/js/components/language.js":
/*!***************************************!*\
  !*** ./src/js/components/language.js ***!
  \***************************************/
/*! exports provided: languageInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "languageInit", function() { return languageInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);

var languageInit = function languageInit() {
  var langs = document.querySelectorAll('.js-lang');
  langs.forEach(function (lang) {
    var button = lang.querySelector('.js-lang-button');
    button.addEventListener('click', function () {
      lang.classList.toggle('b-lang_active');
    });
    document.addEventListener('mousedown', function (e) {
      if (!lang.contains(e.target)) {
        lang.classList.remove('b-lang_active');
      }
    });
  });
};

/***/ }),

/***/ "./src/js/components/menu.js":
/*!***********************************!*\
  !*** ./src/js/components/menu.js ***!
  \***********************************/
/*! exports provided: menuInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "menuInit", function() { return menuInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);

var menuInit = function menuInit() {
  var menuButtons = document.querySelectorAll('.js-menu-button');
  var items = document.querySelectorAll('.b-menu__list li ul');
  menuButtons.forEach(function (button) {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      document.documentElement.classList.toggle('is-menu');
    });
  });
  items.forEach(function (item) {
    var link = item.parentNode.querySelector('a');
    link.addEventListener('click', function (e) {
      e.preventDefault();
      item.style.display = item.style.display === 'block' ? 'none' : 'block';
    });
  });
};

/***/ }),

/***/ "./src/js/components/popup.js":
/*!************************************!*\
  !*** ./src/js/components/popup.js ***!
  \************************************/
/*! exports provided: popupInit, popupVideoInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "popupInit", function() { return popupInit; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "popupVideoInit", function() { return popupVideoInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! nodelist-foreach-polyfill */ "./node_modules/nodelist-foreach-polyfill/index.js");
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _vimeo_player__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @vimeo/player */ "./node_modules/@vimeo/player/dist/player.es.js");



var popupInit = function popupInit() {
  var _html = document.documentElement;
  var popupTriggers = document.querySelectorAll('.js-popup-trigger');
  var popupCloses = document.querySelectorAll('.js-popup-close');
  popupTriggers.forEach(function (popupTrigger, index) {
    popupTrigger.addEventListener('click', function () {
      var popupId = popupTrigger.dataset.popup;

      _html.classList.add('popup-active');

      console.log(popupId);
      var popup = document.querySelector('[data-popup-id="' + popupId + '"]');
      popup.classList.add('is-active');
    });
  });
  popupCloses.forEach(function (popupClose, index) {
    popupClose.addEventListener('click', function () {
      var popupId = popupClose.dataset.popupId;

      _html.classList.remove('popup-active');

      console.log(popupId);
      var popup = document.querySelector('[data-popup-id="' + popupId + '"]');
      popup.classList.remove('is-active');
    });
  });
};
var popupVideoInit = function popupVideoInit() {
  var _html = document.documentElement;
  var popupVideoTriggers = document.querySelectorAll('.js-popup-video-trigger');
  var popupVideoCloses = document.querySelectorAll('.js-popup-video-close');
  popupVideoTriggers.forEach(function (popupVideoTrigger, index) {
    popupVideoTrigger.addEventListener('click', function () {
      var popupId = popupVideoTrigger.dataset.popupVideo;

      _html.classList.add('popup-active');

      var popup = document.querySelector('[data-popup-video-id="' + popupId + '"]');
      popup.classList.add('is-active');
      var popupVideoVimeoSrc = popup.querySelector('.js-video-vimeo');
      var popupVideoPlayer = new _vimeo_player__WEBPACK_IMPORTED_MODULE_2__["default"](popupVideoVimeoSrc, {
        id: popupVideoVimeoSrc.dataset.id,
        width: 1000,
        background: false
      });
      popupVideoPlayer.play().then(function () {}).catch(function (error) {
        console.log('Error playing video.' + error);
      });
    });
  });
  popupVideoCloses.forEach(function (popupVideoClose, index) {
    popupVideoClose.addEventListener('click', function () {
      var popupId = popupVideoClose.dataset.popupVideoId;

      _html.classList.remove('popup-active');

      var popup = document.querySelector('[data-popup-video-id="' + popupId + '"]');
      popup.classList.remove('is-active');
      var popupVideoVimeoSrc = popup.querySelector('.js-video-vimeo');
      var popupVideoPlayer = new _vimeo_player__WEBPACK_IMPORTED_MODULE_2__["default"](popupVideoVimeoSrc, {
        id: popupVideoVimeoSrc.dataset.id,
        width: 1000,
        background: false
      });
      popupVideoPlayer.pause().then(function () {}).catch(function (error) {
        console.log('Error playing video.' + error);
      });
    });
  });
};

/***/ }),

/***/ "./src/js/components/product.js":
/*!**************************************!*\
  !*** ./src/js/components/product.js ***!
  \**************************************/
/*! exports provided: initProduct */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initProduct", function() { return initProduct; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var qs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! qs */ "./node_modules/qs/lib/index.js");
/* harmony import */ var qs__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(qs__WEBPACK_IMPORTED_MODULE_3__);
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; var ownKeys = Object.keys(source); if (typeof Object.getOwnPropertySymbols === 'function') { ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) { return Object.getOwnPropertyDescriptor(source, sym).enumerable; })); } ownKeys.forEach(function (key) { _defineProperty(target, key, source[key]); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }






var Dropdown =
/*#__PURE__*/
function (_Component) {
  _inherits(Dropdown, _Component);

  function Dropdown() {
    var _getPrototypeOf2;

    var _temp, _this;

    _classCallCheck(this, Dropdown);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    return _possibleConstructorReturn(_this, (_temp = _this = _possibleConstructorReturn(this, (_getPrototypeOf2 = _getPrototypeOf(Dropdown)).call.apply(_getPrototypeOf2, [this].concat(args))), _this.state = {
      isActive: false
    }, _this.setRef = function (node) {
      _this.ref = node;
    }, _this.handleClickOutside = function (event) {
      if (_this.ref && !_this.ref.contains(event.target)) {
        _this.setState({
          isActive: false
        });
      }
    }, _this.onClick = function () {
      _this.setState(function (state) {
        return {
          isActive: !state.isActive
        };
      });
    }, _this.onChange = function (id) {
      var onChange = _this.props.onChange;

      if (onChange) {
        onChange(id);
      }

      _this.setState({
        isActive: false
      });
    }, _temp));
  }

  _createClass(Dropdown, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      document.addEventListener('mousedown', this.handleClickOutside);
    }
  }, {
    key: "componentWillUnmount",
    value: function componentWillUnmount() {
      document.removeEventListener('mousedown', this.handleClickOutside);
    }
  }, {
    key: "render",
    value: function render() {
      var _this2 = this;

      var isActive = this.state.isActive;
      var _this$props = this.props,
          options = _this$props.options,
          value = _this$props.value;
      var placeholder = options.find(function (el) {
        return el.variation_id === value;
      });
      return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: classnames__WEBPACK_IMPORTED_MODULE_2___default()('dropdown', {
          dropdown_active: isActive
        }),
        ref: this.setRef
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "dropdown__head",
        onClick: this.onClick
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "dropdown__label"
      }, placeholder.attributes.attribute_pa_quantity, " - ", react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
        dangerouslySetInnerHTML: {
          __html: placeholder.price_html
        }
      }))), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "dropdown__options"
      }, options.map(function (el, index) {
        return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          key: index,
          className: classnames__WEBPACK_IMPORTED_MODULE_2___default()('dropdown__option', {
            dropdown__option_selected: el.variation_id === value
          }),
          onClick: function onClick() {
            return _this2.onChange(el.variation_id);
          }
        }, el.attributes.attribute_pa_quantity, " - ", react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
          dangerouslySetInnerHTML: {
            __html: el.price_html
          }
        }));
      })));
    }
  }]);

  return Dropdown;
}(react__WEBPACK_IMPORTED_MODULE_0__["Component"]);

var Product =
/*#__PURE__*/
function (_Component2) {
  _inherits(Product, _Component2);

  function Product() {
    var _getPrototypeOf3;

    var _temp2, _this3;

    _classCallCheck(this, Product);

    for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      args[_key2] = arguments[_key2];
    }

    return _possibleConstructorReturn(_this3, (_temp2 = _this3 = _possibleConstructorReturn(this, (_getPrototypeOf3 = _getPrototypeOf(Product)).call.apply(_getPrototypeOf3, [this].concat(args))), _this3.state = {
      product: window.product_json,
      flavors: window.flavors_json,
      variations: window.variations_json,
      labels: window.labels,
      products: []
    }, _this3.setProduct = function (flavor, variation) {
      var status = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'change';

      if (status === 'change') {
        _this3.setState(function (state) {
          return {
            products: state.products.map(function (product) {
              return product.flavor === flavor ? {
                flavor: flavor,
                variation: variation
              } : product;
            })
          };
        });
      } else if (status === 'toggle') {
        var product = _this3.state.products.find(function (product) {
          return product.flavor === flavor;
        });

        if (_this3.state.products.length === 1 && product) {
          return;
        }

        if (product) {
          _this3.setState(function (state) {
            return {
              products: state.products.filter(function (product) {
                return product.flavor !== flavor;
              }).map(function (product) {
                var defaultVariation = window.variations_json.find(function (el) {
                  return el.attributes.attribute_pa_flavors === product.flavor && el.attributes.attribute_pa_quantity === window.product_json.default_attributes.pa_quantity;
                }).variation_id;
                return _objectSpread({}, product, {
                  variation: defaultVariation
                });
              })
            };
          });
        } else {
          var defaultVariation = window.variations_json.find(function (el) {
            return el.attributes.attribute_pa_flavors === flavor && el.attributes.attribute_pa_quantity === window.product_json.default_attributes.pa_quantity;
          }).variation_id;
          var products = [].concat(_toConsumableArray(_this3.state.products), [{
            flavor: flavor,
            variation: defaultVariation
          }]).map(function (product) {
            var firstVariation = window.variations_json.find(function (el) {
              return el.attributes.attribute_pa_flavors === product.flavor;
            }).variation_id;
            return _objectSpread({}, product, {
              variation: firstVariation
            });
          });

          _this3.setState({
            products: products
          });
        }
      } else if (status === 'default') {
        var _defaultVariation = window.variations_json.find(function (el) {
          return el.attributes.attribute_pa_flavors === flavor && el.attributes.attribute_pa_quantity === window.product_json.default_attributes.pa_quantity;
        }).variation_id;

        var _products = [].concat(_toConsumableArray(_this3.state.products), [{
          flavor: flavor,
          variation: _defaultVariation
        }]);

        _this3.setState({
          products: _products
        });
      }
    }, _this3.setDefaults = function () {
      var defaultFlavor = window.product_json.default_attributes.pa_flavors;

      _this3.setProduct(defaultFlavor, null, 'default');
    }, _temp2));
  }

  _createClass(Product, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      if (window.location.search) {
        var params = qs__WEBPACK_IMPORTED_MODULE_3___default.a.parse(window.location.search.substr(1));

        if (params.hasOwnProperty('attribute_pa_flavors')) {
          this.setProduct(params.attribute_pa_flavors, null, 'default');
        } else {
          this.setDefaults();
        }
      } else {
        this.setDefaults();
      }
    }
  }, {
    key: "render",
    value: function render() {
      var _this4 = this;

      var _this$state = this.state,
          product = _this$state.product,
          flavors = _this$state.flavors,
          variations = _this$state.variations,
          products = _this$state.products,
          labels = _this$state.labels;
      var selectedFlavors = products.map(function (i) {
        return i.flavor;
      });
      var selectedVariations = products.map(function (i) {
        return i.variation;
      });
      var selectedMinAmount = window.min_amount;
      var total = variations.filter(function (variation) {
        return selectedVariations.includes(variation.variation_id);
      }).reduce(function (a, i) {
        return i.display_price + a;
      }, 0);
      return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__inner"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__part"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__gallery"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__gallery-line",
        style: products.length === 1 ? {
          backgroundColor: flavors.find(function (i) {
            return i.data.slug === products[0].flavor;
          }).color_shade_1
        } : {}
      }), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__gallery-line",
        style: products.length === 1 ? {
          backgroundColor: flavors.find(function (i) {
            return i.data.slug === products[0].flavor;
          }).color_shade_2
        } : {}
      }), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__gallery-line",
        style: products.length === 1 ? {
          backgroundColor: flavors.find(function (i) {
            return i.data.slug === products[0].flavor;
          }).color_shade_3
        } : {}
      }), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__gallery-inner"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__gallery-images",
        style: products.length ? {
          transform: "translateX(".concat(products.length === 1 ? 0 : (products.length - 1) * 5 / products.length, "%)")
        } : {}
      }, flavors.map(function (item, index) {
        return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          key: index,
          className: "p-product__gallery-image",
          style: selectedFlavors.includes(item.data.slug) ? {
            transform: "translateX(".concat(products.length === 1 ? 0 : (index - 1) * 5, "%)"),
            opacity: 1
          } : {
            opacity: 0
          }
        }, item.image && react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("img", {
          src: item.image.url
        }));
      }))), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__gallery-bottles"
      }, flavors.map(function (item, index) {
        return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          key: index,
          className: classnames__WEBPACK_IMPORTED_MODULE_2___default()({
            'p-product__gallery-bottle': true,
            'p-product__gallery-bottle_active': products.find(function (p) {
              return p.flavor === item.data.slug;
            })
          }),
          onClick: function onClick() {
            return _this4.setProduct(item.data.slug, null, 'toggle');
          }
        }, item.image && react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("img", {
          src: item.image.url
        }));
      })))), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__part"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__content"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__title"
      }, product.name), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__description"
      }, product.description), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__message"
      }, "Vanaf maandag 27/5 zal je hier je drinkklaar ontbijt kunnen bestellen."), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__attributes"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__attribute"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__attribute-name"
      }, "1. ", labels.step_1), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__attribute-control"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "b-flavors"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "b-flavors__list"
      }, flavors.map(function (flavor, index) {
        return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          className: "b-flavors__item",
          key: index
        }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          className: classnames__WEBPACK_IMPORTED_MODULE_2___default()({
            'b-flavor': true,
            'b-flavor_active': products.find(function (item) {
              return item.flavor === flavor.data.slug;
            })
          }),
          onClick: function onClick() {
            return _this4.setProduct(flavor.data.slug, null, 'toggle');
          }
        }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          className: "b-flavor__point",
          style: {
            background: "linear-gradient(to bottom, ".concat(flavor.color_shade_1, " 0%, ").concat(flavor.color_shade_1, " 33.333%, ").concat(flavor.color_shade_2, " 33.333%, ").concat(flavor.color_shade_2, " 66.666%, ").concat(flavor.color_shade_3, " 66.666%, ").concat(flavor.color_shade_3, " 100%)")
          }
        }), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          className: "b-flavor__label"
        }, flavor.data.name)));
      }))))), products.length > 0 && react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__attribute"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__attribute-name"
      }, "2. ", labels.step_2), flavors.map(function (flavor, index) {
        var product = products.find(function (product) {
          return product.flavor === flavor.data.slug;
        });
        return product && react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          className: "p-product__attribute-row",
          key: index
        }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          className: "p-product__attribute-label"
        }, flavor.data.name), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
          className: "p-product__attribute-control"
        }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(Dropdown, {
          options: variations.filter(function (i) {
            return i.attributes.attribute_pa_flavors === flavor.data.slug;
          }),
          value: product.variation,
          onChange: function onChange(variation) {
            return _this4.setProduct(product.flavor, variation, 'change');
          }
        })));
      }))), products.length > 0 && react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__controls"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__control"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__price"
      }, "\u20AC ", total.toFixed(2).replace('.', ',')), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__flex"
      }, total >= selectedMinAmount ? react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__delivery p-product__delivery_free"
      }, labels.free_delivery) : react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__delivery"
      }, "+ \u20AC ", window.flat_amount.toFixed(2).replace('.', ','), " ", labels.delivery), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "b-tooltip fade",
        "data-title": labels.tooltip_delivery || ''
      }, "?"))), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "p-product__control"
      }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
        className: "button button--cart",
        href: window.location.pathname + "?add-to-bag=".concat(products.map(function (p) {
          return p.variation;
        }).join())
      }, labels.add_to_bag_button_text)))))));
    }
  }]);

  return Product;
}(react__WEBPACK_IMPORTED_MODULE_0__["Component"]);

var initProduct = function initProduct() {
  var selector = document.querySelector('#app-product');

  if (selector) {
    react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render(react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(Product, null), selector);
  }
};

/***/ }),

/***/ "./src/js/components/scrollDown.js":
/*!*****************************************!*\
  !*** ./src/js/components/scrollDown.js ***!
  \*****************************************/
/*! exports provided: scrollDownInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "scrollDownInit", function() { return scrollDownInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! nodelist-foreach-polyfill */ "./node_modules/nodelist-foreach-polyfill/index.js");
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vanilla_smoothie__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vanilla-smoothie */ "./node_modules/vanilla-smoothie/dist/vanilla-smoothie.js");
/* harmony import */ var vanilla_smoothie__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vanilla_smoothie__WEBPACK_IMPORTED_MODULE_2__);



var scrollDownInit = function scrollDownInit() {
  document.querySelectorAll('.smooth').forEach(function (anchor) {
    anchor.addEventListener('click', function (event) {
      vanilla_smoothie__WEBPACK_IMPORTED_MODULE_2___default.a.scrollTo('#' + anchor.dataset.id, 600);
    });
  });
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    if (anchor.href.slice(-1) === '#') return;
    anchor.addEventListener('click', function (event) {
      vanilla_smoothie__WEBPACK_IMPORTED_MODULE_2___default.a.scrollTo(event.target.getAttribute('href'), 600);
    });
  });
};

/***/ }),

/***/ "./src/js/components/sticky-sidebar.js":
/*!*********************************************!*\
  !*** ./src/js/components/sticky-sidebar.js ***!
  \*********************************************/
/*! exports provided: stickySidebarInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "stickySidebarInit", function() { return stickySidebarInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var sticky_sidebar__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! sticky-sidebar */ "./node_modules/sticky-sidebar/src/sticky-sidebar.js");


var stickySidebarInit = function stickySidebarInit() {
  var checkoutSidebar = document.querySelector('.p-checkout__sidebar');

  if (checkoutSidebar) {
    var sidebar = new sticky_sidebar__WEBPACK_IMPORTED_MODULE_1__["default"](checkoutSidebar, {
      topSpacing: 0,
      bottomSpacing: 0,
      containerSelector: '.p-checkout__inner',
      innerWrapperSelector: '.sidebar__inner',
      resizeSensor: true,
      stickyClass: 'is-affixed',
      minWidth: 768
    });
    console.log(sidebar);
  }
};

/***/ }),

/***/ "./src/js/components/tabs.js":
/*!***********************************!*\
  !*** ./src/js/components/tabs.js ***!
  \***********************************/
/*! exports provided: tabsInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "tabsInit", function() { return tabsInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! nodelist-foreach-polyfill */ "./node_modules/nodelist-foreach-polyfill/index.js");
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__);


var tabsInit = function tabsInit() {
  var myTabs = document.querySelectorAll('.js-tabs > .tab');

  function myTabClicks(tabClickEvent) {
    for (var i = 0; i < myTabs.length; i++) {
      myTabs[i].classList.remove('is-active');
    }

    var clickedTab = tabClickEvent.currentTarget;
    clickedTab.classList.add('is-active');
    var tabPanes = document.querySelectorAll('.js-pane');

    for (var _i = 0; _i < tabPanes.length; _i++) {
      tabPanes[_i].classList.remove('is-active');

      tabPanes[_i].classList.remove('is-open');
    }

    var activeTab = clickedTab.dataset.tabId;
    var activePane = document.querySelector('[data-pane-id="' + activeTab + '"]');
    activePane.classList.add('is-active');
    setTimeout(function () {
      activePane.classList.add('is-open');
    }, 20);
  }

  for (var i = 0; i < myTabs.length; i++) {
    myTabs[i].addEventListener('click', myTabClicks);
  }
};

/***/ }),

/***/ "./src/js/pages/home.js":
/*!******************************!*\
  !*** ./src/js/pages/home.js ***!
  \******************************/
/*! exports provided: stepsSliderInit, factsSliderInit, flavorsSliderInit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "stepsSliderInit", function() { return stepsSliderInit; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "factsSliderInit", function() { return factsSliderInit; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "flavorsSliderInit", function() { return flavorsSliderInit; });
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! nodelist-foreach-polyfill */ "./node_modules/nodelist-foreach-polyfill/index.js");
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var swiper_dist_js_swiper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! swiper/dist/js/swiper.js */ "./node_modules/swiper/dist/js/swiper.js");
/* harmony import */ var swiper_dist_js_swiper_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(swiper_dist_js_swiper_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var viewprt__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! viewprt */ "./node_modules/viewprt/dist/viewprt.esm.js");
/* harmony import */ var _utils_lazy__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./../utils/lazy */ "./src/js/utils/lazy.js");





var stepsSliderInit = function stepsSliderInit() {
  var stepsSliderSrc = document.querySelector('.js-steps-slider');

  if (stepsSliderSrc != null) {
    var stepsSlider = new swiper_dist_js_swiper_js__WEBPACK_IMPORTED_MODULE_2___default.a(stepsSliderSrc, {
      slidesPerView: 'auto',
      speed: 400,
      spaceBetween: 40,
      centeredSlides: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: true
      },
      navigation: {
        nextEl: '.steps-slider-next',
        prevEl: '.steps-slider-prev'
      },
      breakpoints: {
        767: {
          spaceBetween: 10,
          centeredSlides: true
        }
      },
      init: true
    });
    stepsSlider.autoplay.stop();
    stepsSlider.on('slideChange', function () {
      Object(_utils_lazy__WEBPACK_IMPORTED_MODULE_4__["default"])();
    });

    if (stepsSliderSrc) {
      stepsSlider.el.addEventListener('mouseenter', function (e) {
        stepsSlider.autoplay.stop();
      }, false);
      stepsSlider.el.addEventListener('mouseleave', function (e) {
        stepsSlider.autoplay.start();
      }, false);
    }

    var stepsSliderObserver = Object(viewprt__WEBPACK_IMPORTED_MODULE_3__["ElementObserver"])(stepsSliderSrc, {
      onEnter: function onEnter(element, viewport) {
        stepsSlider.autoplay.start(); //stepsSlider.init()
        //console.log('Steps slider init')
      },
      onExit: function onExit(element, viewport) {
        stepsSlider.autoplay.stop(); //console.log('Steps slider out viewport')
      },
      once: false
    });
  }
};
var factsSliderInit = function factsSliderInit() {
  var factsSliderSrc = document.querySelector('.js-facts-slider');

  if (factsSliderSrc != null) {
    var factsSlider = new swiper_dist_js_swiper_js__WEBPACK_IMPORTED_MODULE_2___default.a(factsSliderSrc, {
      slidesPerView: 1,
      speed: 400,
      direction: 'vertical',
      loop: true,
      simulateTouch: false,
      allowTouchMove: false,
      autoplay: {
        delay: 4000
      }
    });
    factsSlider.autoplay.stop();
    var factsSliderObserver = Object(viewprt__WEBPACK_IMPORTED_MODULE_3__["ElementObserver"])(factsSliderSrc, {
      onEnter: function onEnter(element, viewport) {
        factsSlider.autoplay.start(); //console.log('Facts slider init')
      },
      onExit: function onExit(element, viewport) {
        factsSlider.autoplay.stop(); //console.log('Facts slider out viewport')
      },
      once: false
    });
  }
};
var flavorsSliderInit = function flavorsSliderInit() {
  var flavorsSliderBottlesSrc = document.querySelector('.js-slider-flavors-bottles');
  var flavorsTabs = document.querySelectorAll('.js-slider-flavors-tabs .tab');
  var flavorsSliderContents = document.querySelectorAll('.slider-flavors-content .slider-flavors-content__slide');
  var flavorsShades = document.querySelectorAll('.shades');

  if (flavorsSliderBottlesSrc != null) {
    var flavorsSliderBottles = new swiper_dist_js_swiper_js__WEBPACK_IMPORTED_MODULE_2___default.a(flavorsSliderBottlesSrc, {
      slidesPerView: 1,
      speed: 600,
      direction: 'horizontal',
      simulateTouch: true
    });
    flavorsTabs.forEach(function (flavorsTab, index) {
      flavorsTab.addEventListener('click', function () {
        flavorsSliderBottles.slideTo(index);
        flavorsTab.classList.add('is-active');
      });
    });
    flavorsSliderBottles.on('slideChange', function () {
      flavorsTabs.forEach(function (item, index) {
        item.classList.remove('is-active');

        if (flavorsSliderBottles.activeIndex === index) {
          item.classList.add('is-active');
        }
      });
      flavorsShades.forEach(function (item, index) {
        item.classList.remove('is-active');

        if (flavorsSliderBottles.activeIndex === index) {
          item.classList.add('is-active');
        }
      });
      flavorsSliderContents.forEach(function (item, index) {
        item.classList.remove('is-active');

        if (flavorsSliderBottles.activeIndex === index) {
          item.classList.add('is-active');
        }
      });
      Object(_utils_lazy__WEBPACK_IMPORTED_MODULE_4__["default"])();
    });
  }
};

/***/ }),

/***/ "./src/js/utils/bowser.js":
/*!********************************!*\
  !*** ./src/js/utils/bowser.js ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var bowser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bowser */ "./node_modules/bowser/src/bowser.js");
/* harmony import */ var bowser__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(bowser__WEBPACK_IMPORTED_MODULE_0__);


var browserClasses = function browserClasses() {
  if (bowser__WEBPACK_IMPORTED_MODULE_0___default.a.mobile) {
    document.querySelector('html').classList.add('is-mobile');
  } else if (bowser__WEBPACK_IMPORTED_MODULE_0___default.a.tablet) {
    document.querySelector('html').classList.add('is-tablet');
  } else {
    document.querySelector('html').classList.add('is-desktop');
  }

  if (bowser__WEBPACK_IMPORTED_MODULE_0___default.a.msedge) {
    document.querySelector('html').classList.add('is-edge');
  }

  if (bowser__WEBPACK_IMPORTED_MODULE_0___default.a.msie) {
    document.querySelector('html').classList.add('is-ie');
  }
};

/* harmony default export */ __webpack_exports__["default"] = (browserClasses);

/***/ }),

/***/ "./src/js/utils/ie-object-fit.js":
/*!***************************************!*\
  !*** ./src/js/utils/ie-object-fit.js ***!
  \***************************************/
/*! exports provided: objectFitPolyfill */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "objectFitPolyfill", function() { return objectFitPolyfill; });
var objectFitPolyfill = function objectFitPolyfill() {
  if ('objectFit' in document.documentElement.style === false) {
    document.addEventListener('DOMContentLoaded', function () {
      var images = document.querySelectorAll('img.u-object-fit');

      if (images.length > 0) {
        images.forEach(function (el) {
          if (el.parentNode.classList.contains('u-full')) {
            el.style.opacity = '0';
            var imageSrc = el.dataset.src || el.src;
            var styles = "\n              position: absolute;\n              left: 0;\n              top: 0;\n              right: 0;\n              bottom: 0;\n              background-image: url(".concat(imageSrc, ");\n              background-position: 50%;\n              background-repeat: no-repeat;\n              background-size: cover;\n              ");
            var cover = document.createElement('div'); //cover.style = styles; //ie11 error

            cover.setAttribute('style', styles); //el.closest('picture.u-full').appendChild(cover); //ie11 error

            el.parentNode.appendChild(cover);
          }
        });
      }

      var bottles = document.querySelectorAll('.p-product__gallery-bottle');

      if (bottles.length > 0) {
        bottles.forEach(function (el) {
          var image = el.querySelector('img');
          var imageSrc = image.src;
          image.style.opacity = '0';
          el.setAttribute('style', "\n            background-image: url(".concat(imageSrc, ");\n            background-position: 50%;\n            background-repeat: no-repeat;\n            background-size: contain;\n          "));
        });
      }
    });
  }
};

/***/ }),

/***/ "./src/js/utils/inview-play.js":
/*!*************************************!*\
  !*** ./src/js/utils/inview-play.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! nodelist-foreach-polyfill */ "./node_modules/nodelist-foreach-polyfill/index.js");
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var viewprt__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! viewprt */ "./node_modules/viewprt/dist/viewprt.esm.js");




var isInViewPlay = function isInViewPlay() {
  var inViewElements = document.querySelectorAll('.play-in-view');

  if (inViewElements != null) {
    inViewElements.forEach(function (inViewElement, index) {
      var playVideosObserver = Object(viewprt__WEBPACK_IMPORTED_MODULE_2__["ElementObserver"])(inViewElement, {
        onEnter: function onEnter(element, viewport) {
          element.querySelector('video').play();
        },
        once: false,
        offset: -200
      });
    });
  }
};

/* harmony default export */ __webpack_exports__["default"] = (isInViewPlay);

/***/ }),

/***/ "./src/js/utils/inview.js":
/*!********************************!*\
  !*** ./src/js/utils/inview.js ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/polyfill */ "./node_modules/@babel/polyfill/lib/index.js");
/* harmony import */ var _babel_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_polyfill__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! nodelist-foreach-polyfill */ "./node_modules/nodelist-foreach-polyfill/index.js");
/* harmony import */ var nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(nodelist_foreach_polyfill__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var viewprt__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! viewprt */ "./node_modules/viewprt/dist/viewprt.esm.js");




var isInViewCheck = function isInViewCheck() {
  var inViewElements = document.querySelectorAll('.js-in-view');

  if (inViewElements != null) {
    inViewElements.forEach(function (inViewElement, index) {
      var factsSliderObserver = Object(viewprt__WEBPACK_IMPORTED_MODULE_2__["ElementObserver"])(inViewElement, {
        onEnter: function onEnter(element, viewport) {
          element.classList.add('is-in-view');
        },
        once: true,
        offset: -200
      });
    });
  }
};

/* harmony default export */ __webpack_exports__["default"] = (isInViewCheck);

/***/ }),

/***/ "./src/js/utils/lazy.js":
/*!******************************!*\
  !*** ./src/js/utils/lazy.js ***!
  \******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var Blazy = __webpack_require__(/*! blazy */ "./node_modules/blazy/blazy.js");

var lazyLoad = function lazyLoad() {
  var bLazy = new Blazy({
    selector: '.lazy',
    successClass: 'is-loaded',
    offset: 300,
    success: function success(element) {
      element.parentElement.classList.add('is-loaded');
    }
  });
};

/* harmony default export */ __webpack_exports__["default"] = (lazyLoad);

/***/ })

/******/ });
//# sourceMappingURL=app.bundle.js.map