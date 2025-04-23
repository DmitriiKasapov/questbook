/**
 * Makes animated expandables with multiple behaviourial options. Follows accessibility guidelines.
 * @param {HTMLElement} el HTML element for the expandable.
 * @param {String|HTMLCollection} trigger CCS selector for the trigger element to open/close.
 * @param {String|HTMLCollection} content CCS selector for the content.
 * @param {String|Number} initialHeight Initial height of the content element in px. Default 0px.
 * @param {String|Number} duration Duration of the animation in ms. Can be added as the HTML attribute data-duration. Default 400ms.
 * @param {String|Boolean} clickOutside Close on clicks outside the expandable elemenet. Can be added as the HTML attribute data-clickoutside. Default false.
 * @param {String|Boolean} opened Initial state on load opened(true) or closed(false). Can be added as the HTML attribute data-opened. Default false.
 * @param {String|Boolean} disabled Disable click events. Can be added as the HTML attribute data-opened. Default false.
 * @param {String|Boolean} checkTop Scrolls the document should the top of the expandable go outside the document view. Default true.
 * @param {String} closeTrigger CSS selector for a seperate close trigger within the element. Can be added as the HTML attribute data-opened. Default false.
 * @param {String} mode Whether expands on hover or clicks. Defaults to 'click' if no device that can hover. Can be added as the HTML attribute data-mode. Default 'click'.
 */

import { elementOffset } from "./helpers";

export class Expandable {
  constructor(el, trigger, content, { initialHeight = 0, duration = 400, clickOutside = false, opened = false, closeTrigger = null, mode = 'click', disabled = false, checkTop = true } = {}) {
    this.el = el;
    this.trigger = typeof trigger === 'string' ? el.querySelector(trigger) : trigger;
    this.content = typeof content === 'string' ? el.querySelector(content) : content;
    this.initialHeight = initialHeight;
    this.duration = this.el.dataset.duration ? parseInt(this.el.dataset.duration) : duration;
    this.opened = this.el.dataset.opened ? ( this.el.dataset.opened === 'true' || parseInt(this.el.dataset.opened) === 1 ? true : false ) : opened;
    this.clickOutside = this.el.dataset.clickOutside ? ( this.el.dataset.clickOutside === 'true' || parseInt(this.el.dataset.clickOutside) === 1 ? true : false ) : clickOutside;
    this.disabled = this.el.dataset.disabled ? ( this.el.dataset.disabled === 'true' || parseInt(this.el.dataset.disabled) === 1 ? true : false ) : disabled;
    this.closeTrigger = this.el.dataset.closeTrigger ? this.el.querySelectorAll(this.el.dataset.closeTrigger) : ( closeTrigger ? this.el.querySelectorAll(closeTrigger) : null );
    this.checkTop = this.el.dataset.checkTop ? ( this.el.dataset.checkTop === 'true' || parseInt(this.el.dataset.checkTop) === 1 ? true : false ) : checkTop;
    this.mode = this.el.dataset.mode ?? mode;
    this.animation = null;
    this.isClosing = false;
    this.isExpanding = false;
    this.closedByUser = false;
    this.zero = null;
    this.#init()
  }

  onClick(e) {
    e.stopPropagation();
    if (this.disabled) return;
    e.preventDefault();
    if (this.isClosing || !this.el.open) {
      this.open(this.duration);
    } else if (this.isExpanding || this.el.open) {
      this.shrink(this.duration, this.el);
      this.closedByUser = true;
    }
  }

  shrink(duration, el) {
    this.el.dispatchEvent(new Event('collapsing'))
    if (el === this.el) {
      this.content.style.overflow = "hidden";
      this.isClosing = true;
      const startHeight = `${this.content.offsetHeight}px`;
      const endHeight = `${this.initialHeight}px`;
      if (this.el.classList.contains("animation-open"))
        this.el.classList.remove("animation-open");
      this.el.classList.add("animation-close");
      if (this.animation) {
        this.animation.cancel();
      }
      this.animation = this.content.animate(
        {
          height: [startHeight, endHeight],
        },
        {
          duration: duration,
          easing: "ease-out",
          fill: "forwards",
        }
      );
      this.animation.onfinish = () => this.#onAnimationFinish(false);
      this.animation.oncancel = () => (this.isClosing = false);
    }
  }

  open(duration) {
    if (!this.el.open) {
      this.el.open = true;
      if (this.el.classList.contains("animation-close"))
        this.el.classList.remove("animation-close");
      this.el.classList.add("animation-open");
      window.requestAnimationFrame(() => {
        this.zero = performance.now()
        this.checkTopFunc()
        this.expand(duration)
      });
    }
  }

  checkTopFunc() {
    if (this.checkTop) {
      const value = (performance.now() - this.zero) / this.duration
      if (value < 1) {
        const elOffset = elementOffset(this.el)
        if (elOffset.top < window.scrollY) window.scrollTo(0, elOffset.top)
        window.requestAnimationFrame((t) => this.checkTopFunc(t))
      }
    }
  }

  expand(duration) {
    this.el.dispatchEvent(new Event('expanding'))
    this.isExpanding = true;
    this.content.hidden = false;
    const startHeight = `${this.initialHeight}px`;
    const endHeight = `${this.content.children[0].offsetHeight}px`;
    if (this.animation) {
      this.animation.cancel();
    }
    this.animation = this.content.animate(
      {
        height: [startHeight, endHeight, "auto"],
        offset: [0, 0.999, 1],
      },
      {
        duration: duration,
        easing: "ease-out",
        fill: "forwards",
      }
    );
    this.animation.onfinish = () => this.#onAnimationFinish(true);
    this.animation.oncancel = () => (this.isExpanding = false);
  }

  #clickOutside(e) {
    if (
      !this.el ||
      this.el === e.target ||
      e.composedPath().includes(this.el) ||
      e.composedPath().includes(this.trigger) ||
      (this.opened && !this.closedByUser)
    )
      return

    this.shrink(this.duration, this.el)
  }

  #onAnimationFinish(open) {
    if (open) {
      this.content.style.overflow = "visible";
      this.el.classList.remove("animation-open");
      this.el.classList.add("open");
    } else {
      this.el.classList.remove("animation-close");
      this.el.classList.remove("open");
      this.content.hidden = true;
    }

    this.trigger.ariaExpanded = open

    if(this.clickOutside) {
      open ?
        window.addEventListener('click', this.#clickOutside.bind(this)) :
        window.removeEventListener('click', this.#clickOutside.bind(this))
    }

    this.el.open = open;
    this.animation = null;
    this.isClosing = false;
    this.isExpanding = false;
  }

  #addHover() {
    this.trigger.addEventListener("mouseenter",  this.open.bind(this))
    this.el.addEventListener("mouseleave", this.shrink.bind(this, this.duration, this.el))
  }

  #addClick() {
    this.trigger.addEventListener("click", this.onClick.bind(this));
  }

  #init() {
    if ( this.trigger && this.content ) {
      this.content.style.overflow = "hidden";
      this.opened ? this.open(0) : this.shrink(0, this.el);
      this.content.classList.remove('hidden');
      (this.mode === 'hover' && window.matchMedia('hover: hover').matches) ? this.#addHover() : this.#addClick();
      if (this.closeTrigger) this.closeTrigger.forEach((trigger) => {
        trigger.addEventListener('click', this.shrink.bind(this, this.duration, this.el))
      });
    }
  }
}

/**
 * Links a group of expandables so that only one is open at a time. Expandable class must be attached to the element.
 * @param {String|HTMLCollection} exapndables CSS selector to search for within the container || An HTML collection of elements
 * @param {HTMLElement} container Container element within which the expandables are contained. Defaults to document
 */
export class LinkedExpandables {
  constructor(expandables, container = document) {
    this.container = container
    this.expandables = typeof trigger === 'string' ? container.querySelectorAll(expandables) : expandables;
    this.activeExpandable = null
    this.#init()
  }

  #init() {
    this.expandables.forEach(el => {
      if (el.expandable.opened) this.activeExpandable = el.expandable
      el.addEventListener('expanding', () => {
        this.activeExpandable?.shrink(this.activeExpandable.duration, this.activeExpandable.el)
        this.activeExpandable = el.expandable
      })
    })
  }
}
