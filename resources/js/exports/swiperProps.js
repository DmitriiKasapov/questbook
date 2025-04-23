/**
 * Some default parameters for Swiper slider
 * Full api: https://swiperjs.com/swiper-api
 */

export const exampleProps = {
  direction: 'horizontal',
  slidesPerView: 1,
  spaceBetween: 0,
  updateOnWindowResize: true,
  loop: true,
  speed: 500,
  resistanceRatio: 0.9,
  threshold: 20,
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
  navigation: {
    nextEl: '.swiper-container-test .swiper-button-next',
    prevEl: '.swiper-container-test .swiper-button-prev'
  }
}

/* Example for swiper custom element with resize observer for more dynamic slides per view */

export const defaultSwiperElement = function (el, params = null) {
  if (!el.swiperinit) {
    const swiper = el.querySelector('swiper-container')
    if(params) Object.assign(swiper, params);
    swiper.addEventListener('init', (event) => {
      const [swiper] = event.detail
      const minwidth = parseInt(swiper.dataset?.minwidth) ? parseInt(swiper.dataset?.minwidth) : 300;
      const resizeObserver = new ResizeObserver((entries) => {
        swiper.params.slidesPerView = Math.floor(entries[0].contentRect.width / minwidth)
        swiper.update()
      })
      resizeObserver.observe(swiper.el)
    })
    swiper.initialize()
    el.swiperinit = true
  }
}
