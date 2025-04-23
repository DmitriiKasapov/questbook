/* NEEDS REWRITE TO COMPLY WITH ACCESSIBILITY */

export default class {
  constructor ( navLink ) {
    this.navLinks = document.querySelectorAll( navLink )
    this.#init()
  }

  #switcher(event) {
    event.preventDefault()
    if(event.target.classList.contains('active')) return;
    this.navLinks.forEach(el => {
      el.classList.remove('active')
      const target = document.querySelector(`#${el.dataset.id}`)
      if(target) target.classList.add('hidden')
    })
    event.target.classList.add('active')
    document.querySelector(`#${event.target.dataset.id}`).classList.remove('hidden')
  }

  #attachListeners() {
    this.navLinks.forEach (el => {
      el.addEventListener( 'click', event => this.#switcher(event) )
    })
  }

  #init() {
    this.#attachListeners()
    this.navLinks.forEach(el => {
      if (!el.classList.contains('active')) {
        const target = document.querySelector(`#${el.dataset.id}`)
        if (target) target.classList.add('hidden')
      }
    })
  }
}
