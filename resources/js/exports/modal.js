/**
 * Create a modal object with to open with events. Adds the 'modal-open' class to the modal element.
 * Needs to be accompanied with CSS.
 * @constructor
 * @param {String|HTMLElement} modal Selector or HTML node for the modal element that we want to dispaly
 * @param {String} content Selector for the modal's content. Clicks outside it will remove 'modal-open' class
 * @param {String|HTMLElement} closeBtn Selector or collection of HTML nodes for button that removes 'modal-open' class
 * @param {String} openBtns Optional. CSS selector for the buttons that adds 'modal-open' class. Can be added as the HTML attribute data-openbtn. Default null.
 * @returns {void}
 */

export default class {
  constructor(modal, content, closeBtn, openBtn = null) {
    this.modal = typeof modal === 'string' ? document.querySelector(modal) : modal;
    this.content = modal.querySelector(content);
    this.closeBtn = typeof closeBtn === 'string' ? modal.querySelectorAll(closeBtn) : closeBtn
    this.openBtns = this.modal.dataset?.openbtns ? document.querySelectorAll(this.modal.dataset.openbtns) : openBtn;
    this.focusables = this.modal.querySelectorAll('button, [href], input, [tabindex="0"]')
    this.lastActiveEl = null
    this.#init();
  }

  open(e) {
    e.stopPropagation();
    this.modal.hidden = false;
    setTimeout(() => {
      this.lastActiveEl = document.activeElement;
      if(e.pointerId != 1 && this.focusables.length) this.focusables[0].focus()
      this.modal.classList.add('modal-open');
      if(this.focusables.length) document.addEventListener('keydown', this.#checkFocus)
    })
  }

  #close(e) {
    document.removeEventListener('keydown', this.#checkFocus)
    this.modal.classList.remove('modal-open');
    this.modal.classList.add('modal-closing');
    if(e.pointerId != 1) this.lastActiveEl.focus();
    setTimeout(() => {
      this.modal.classList.remove('modal-closing');
      this.modal.hidden = true
    }, 500)
  }

  #checkFocus = (e) => {
    if (e.key === 'Tab') {
      if (e.target === this.focusables[this.focusables.length - 1] && !e.shiftKey) {
        e.preventDefault();
        this.focusables[0].focus()
      }
      if (e.target === this.focusables[0] && e.shiftKey) {
        e.preventDefault();
        this.focusables[this.focusables.length - 1].focus()
      }
    }
  }

  #clickOutside(e) {
    if (
      !this.modal ||
      this.content === e.target ||
      e.composedPath().includes(this.content)
    )
      return

    this.#close(e)
  }

  #addListeners() {
    if(this.openBtns) this.openBtns.forEach( btn => btn.addEventListener('click', (e) => this.open(e)))
    this.closeBtn.forEach( btn => btn.addEventListener('click', (e) => this.#close(e)))
    this.modal.addEventListener('click', (e) => this.#clickOutside(e))
  }

  #init() {
    if(this.modal && this.closeBtn) this.#addListeners();
    this.modal.classList.add('modal-initialised')
  }
}
