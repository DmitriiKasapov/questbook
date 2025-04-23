/**
 * Create a menu object with event listeners for open and close buttons
 * The function will 1) add 'menu-is-active' class to menu and its buttons, when the menu is open
 * as well as 2) 'overflow-hidden' class to the body: both classes must be accompanied with css
 * @constructor
 * @param {String|HTMLElement} menu Selector or HTML node for menu element that we want to dispaly
 * @param {String} openMenuButton Selector or collection of HTML nodes for button that opens the menu
 * @param {String} closeMenuButton Selector or collection of HTML nodes for button that closes the menu
 * @param {Boolean} toggle If menu closes on openMenuButton click
 * @returns {void}
 */

export default class {
  constructor(menu, openMenuButton, closeMenuButton, toggle = false) {
    // this.body = document.getElementsByTagName('body')[0]
    this.toggle = toggle
    this.menu = typeof menu === 'string' ? document.querySelector(menu) : menu
    this.menuBtnOpen = typeof openMenuButton === 'string' ? document.querySelectorAll(openMenuButton) : openMenuButton
    this.menuBtnClose = typeof closeMenuButton === 'string' ? document.querySelectorAll(closeMenuButton) : closeMenuButton
    this.#init()
  }

  #init() {
    if(this.menu)
      this.#attachListeners()
  }

  #attachListeners() {
    if (this.menuBtnOpen) this.menuBtnOpen.forEach( btn => {
      btn.addEventListener('click', () => this.toggle ? this.#toggleMenu() : this.#openMenu())
    })

    if (this.menuBtnClose) this.menuBtnClose.forEach( btn => {
      if (btn) btn.addEventListener('click', () => this.#closeMenu())
    })
  }

  #openMenu() {
    this.menu.classList.add('menu-is-active')
    this.menuBtnOpen.forEach( btn => {
      btn.classList.add('menu-is-active')
    })
    // this.body.classList.add('overflow-hidden')
    window.addEventListener('click', this.#clickOutside)
  }

  #closeMenu() {
    this.menu.classList.remove('menu-is-active')
    this.menuBtnOpen.forEach( btn => {
      btn.classList.remove('menu-is-active')
    })
    // this.body.classList.remove('overflow-hidden')
    window.removeEventListener('click', this.#clickOutside)
  }

  #toggleMenu() {
    this.menu.classList.contains('menu-is-active') ? this.#closeMenu() : this.#openMenu();
  }

  #clickOutside(e) {
    if (
      !this.menu ||
      this.menu === e.target ||
      [...this.menuBtnOpen].includes(e.target) ||
      e.composedPath().includes(this.menu) ||
      [...this.menuBtnOpen].some(btn => e.composedPath().includes(btn))
    )
      return

    this.#closeMenu()
  }
}
