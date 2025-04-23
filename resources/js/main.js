//// Modules ////
// import gsap from 'gsap'
// import ScrollTrigger from 'gsap/ScrollTrigger'
// import Swiper from 'swiper/bundle'

import { Expandable } from './exports/expandable';
// import Menu from './exports/menu'
// import SetScreenHeight from './exports/screenHeight'
// import scrollAnimations from './exports/scrollAnimations'
// import { triggerOnWindowBreak, setCSSProperty } from './exports/helpers'
// import { defaultSwiperElement } from './exports/swiperProps'

//// GSAP ////

// gsap.registerPlugin(ScrollTrigger)
// const scrollAnimations = new ScrollAnimations()

/* Refresh ScrollTrigger */
// ScrollTrigger.refresh()

//// Menu ////

// const menu = new Menu()

//// Sliders ////

/* if(document.querySelector('swiper-container')) {
  document.querySelectorAll('.default-swiper').forEach( el => {
    if(el) defaultSwiperElement(el)
  })
} */

//// Expandables ////

document.querySelectorAll('.expandable').forEach(el => {
  el.expandable = new Expandable(el, '.expandable__trigger', '.expandable__content');
})

//// DOC load ////

// document.addEventListener('DOMContentLoaded', function() {
  /* Remove preload class to allow transitions */
  // document.body.classList.remove('loading')
// })
