import { Expandable } from './expandable';

export class Select extends Expandable {
  constructor(el, selected, { list = 'ul', listItems = 'li', trigger = 'button', duration = 0, opened = false, deselect = false } = {}) {
    super(el, trigger, list, { duration: duration, clickOutside: true, opened: opened, checkTop: false })
    this.el = el;
    this.duration = duration
    this.trigger = el.querySelector(trigger)
    this.selectionElement = el.querySelector(selected);
    this.list = el.querySelector(list);
    this.listItems = this.list.querySelectorAll(listItems);
    this.defaultSelection = this.selectionElement.innerHTML;
    this.selected = new CustomEvent('selected', { detail: this.el });
    this.currentValue = null;
    this.currentSelection = null;
    this.keyStore = '';
    this.keyStoreTimeout;
    this.focusedItem = null;
    this.deselect = this.el.dataset?.deselect ? ( this.el.dataset.deselect === 'true' || parseInt(this.el.dataset.deselect) === 1 ? true : false ) : deselect;
    this.#init();
  }

  #handleSelect(item) {
    this.listItems.forEach(singleItem => {
      if(item != singleItem) {
        singleItem.classList.remove('selected')
        singleItem.ariaSelected = false
      }
    })
    this.selection(item)
    super.shrink(this.duration, this.el)
    this.el.classList.add('--selected')
  }

  #selectionHelper(item, input, label) {
    item.ariaSelected = true
    item.classList.add('selected');
    input.checked = true
    this.currentSelection = item
    this.currentValue = input.value
    this.selectionElement.innerHTML = label.innerHTML
  }

  #clearSelection() {
    this.listItems.forEach(item => {
      const input = item?.querySelector('input');
      input.checked = false
      item.ariaSelected = false
      item.classList.remove('selected')
      this.el.classList.remove('--selected')
    })
    this.currentSelection = null
    this.currentValue = null
    this.focusedItem = null
    this.selectionElement.innerHTML = this.defaultSelection
  }

  selection(item) {
    const input = item?.querySelector('input');
    const label = item?.querySelector('label');
    if (this.currentValue != null) {
      if (input.value === this.currentValue) {
        if (!this.deselect) return
        this.#clearSelection()
      } else {
        this.#selectionHelper(item, input, label)
      }
    } else {
      this.#selectionHelper(item, input, label)
    }
    this.el.dispatchEvent(new CustomEvent('change', { detail: {
      name: input.name,
      value: this.currentValue }
    }));
  }

  #handleBlur () {
    if (this.el.open) {
      super.shrink(this.duration, this.el)
      this.trigger.blur()
    } else {
      super.open(this.duration)
    }
  }

  #focusItem(item) {
    if(this.focusedItem) this.focusedItem.classList.remove('focused')
    item.focus()
    item.classList.add('focused')
    this.focusedItem = item
  }

  #moveSelection (event, item) {
    if (event.key === 'ArrowUp' ||  (event.key === "Tab" && event.shiftKey )) {
      item.previousElementSibling ? this.#focusItem(item.previousElementSibling) : this.#focusItem(this.listItems[this.listItems.length - 1]);
    } else {
      item.nextElementSibling ? this.#focusItem(item.nextElementSibling) : this.#focusItem(this.listItems[0]);
    }
  }

  #handleKeys(event) {
    if (event.key.length === 1) {
      this.keyStore = this.keyStore + event.key
      if (this.keyStoreTimeout) clearTimeout(this.keyStoreTimeout)
      this.keyStoreTimeout = setTimeout(() => {
        this.keyStore = ''
      }, 2000)

      const item = Object.entries(this.listItems).find(singleItem => {
        return singleItem[1].textContent.trim().toLowerCase().startsWith(this.keyStore.toLocaleLowerCase())
      })

      return item
    }
  }

  #handleListKeydown (event, item) {
    if(event.key === 'Enter' || event.key === "Space") {
      this.#handleSelect(item)
      this.#handleBlur()
      this.trigger.focus()
      return;
    }

    if (event.key === 'ArrowDown' || event.key === 'ArrowUp' || event.key === 'Tab') {
      event.preventDefault();
      this.#moveSelection(event, item)
    }

    if (event.key === 'Escape') {
      this.#handleBlur()
      this.trigger.focus()
    }

    else {
      const item = this.#handleKeys(event, item)
      if (item) this.#focusItem(item[1])
    }
  };

  #handleTriggerKeydown (event) {
    if (event.key === "Enter") {
      event.preventDefault()
      super.open(this.duration)
      setTimeout(() => {
        this.currentSelection ? this.currentSelection.focus() : this.listItems[0].focus()
      }, this.duration + 1)
    }
  }

  #addKeyListeners() {
    this.trigger.addEventListener('keydown', this.#handleTriggerKeydown.bind(this))
    this.listItems.forEach(item => {
      item.addEventListener('keydown', event => this.#handleListKeydown(event, item))
    });
  }

  #init() {
    this.listItems.forEach(item => {
      item.addEventListener('click', this.#handleSelect.bind(this, item))
      if(this.el.dataset?.initval === item.querySelector('input').value) this.#handleSelect(item)
    });
    this.trigger.addEventListener('click', () => {
      setTimeout(() => {
        this.currentSelection ? this.currentSelection.focus() : this.listItems[0].focus()
      }, this.duration + 1)
    })
    this.el.addEventListener('clearselection', this.#clearSelection.bind(this));
    this.#addKeyListeners();
  }
}


export class MinMaxSlider {
  constructor(el) {
    this.el = el;
    this.mininput = el.querySelector('.minval-input');
    this.maxinput = el.querySelector('.maxval-input');
    this.minslider = el.querySelector('.minval-slider');
    this.maxslider = el.querySelector('.maxval-slider');
    this.innerTrack = el.querySelector('.inner-track');
    this.min;
    this.max;
    this.currentMin;
    this.currentMax;
    this.#init();
  }

  #minInputChange(value) {
    if(parseFloat(value) >= parseFloat(this.currentMax)) this.#maxInputChange(value)
    this.currentMin = value;
    this.minslider.value = this.currentMin
    this.mininput.value = this.currentMin
    this.#setSliderWidth();
  }

  #maxInputChange(value) {
    if(parseFloat(value) <= parseFloat(this.currentMin)) this.#minInputChange(value)
    this.currentMax = value;
    this.maxslider.value = this.currentMax
    this.maxinput.value = this.currentMax
    this.#setSliderWidth();
  }

  #setSliderWidth() {
    this.innerTrack.style.left = `${(parseFloat(this.currentMin)) / (this.max - this.min) * 100}%`
    this.innerTrack.style.right = `${100 - ((parseFloat(this.currentMax)) / (this.max - this.min) * 100)}%`
  }

  #addListeners() {
    this.mininput.addEventListener('input', (e) => this.#minInputChange(e.target.value))
    this.minslider.addEventListener('input', (e) => this.#minInputChange(e.target.value))
    this.maxinput.addEventListener('input', (e) => this.#maxInputChange(e.target.value))
    this.maxslider.addEventListener('input', (e) => this.#maxInputChange(e.target.value))
  }

  #init() {
    this.min = parseInt(this.minslider.min)
    this.max = parseInt(this.maxslider.max)
    this.currentMin = this.min;
    this.currentMax = this.max;
    this.#setSliderWidth();
    this.#addListeners();
  }
}
