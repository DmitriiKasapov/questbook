/**
 * Call one or more functions on a breakpoint
 * @param {String} breakpoint Breakpoint number (in pixels)
 * @param {String} triggerOn Determine when to trigger: either on 'desktop' or 'mobile'
 * @param {Function[]} actions Array of one or more functions
 * @returns {void}
 */

export function triggerOnWindowBreak(breakpoint, actions, triggerOn = 'mobile') {
  let screenBreak

  // Set screen above or below breakpoint for event to take place
  if (triggerOn === 'desktop') {
    screenBreak = window.matchMedia(`(min-width: ${breakpoint}px)`)
  } else {
    screenBreak = window.matchMedia(`(max-width: ${breakpoint}px)`)
  }

  // Attach listener
  screenBreak.addEventListener('change', function(event) {
    if (event.target.matches) {
      actions.forEach( function(action) {
        action()
      })
    }
  })

  // Call functions
  if (screenBreak.matches) {
    actions.forEach(function(action) {
      action()
    })
  }
}

/**
 * Append uploaded file name(s)
 * @param {String} inputId Id of the input with type='file'
 * @param {String} nameHolder Selector for element where span elements with file name are appended
 * @returns {void}
 */

export function appendUploadName(inputId, nameHolder) {
  document.getElementById(inputId).addEventListener('change', function() {
    let loadedFiles = [
      ...document.getElementById(inputId).files
    ]
    if (loadedFiles) {
      document.querySelector(nameHolder).classList.add('active')

      loadedFiles.forEach((file) => {
        let fileNameEl = document.createElement('span')
        let fileNameText = document.createTextNode(file.name)
        fileNameEl.appendChild(fileNameText)
        document.querySelector(nameHolder).appendChild(fileNameEl)
      })
    }
  })
}

/**
 * A promise. Await element to appear before moving to the next line of code.
 * Returns the element it was waiting to appear.
 * Use in async ... await functions.
 * @param {String} selector CSS selector of the element.
 * @returns {HTMLElement}
 */

export function elementAppear(selector) {
  return new Promise(resolve => {
      if (document.querySelector(selector)) return resolve(document.querySelector(selector))
      const observer = new MutationObserver(mutations => {
          if (document.querySelector(selector)) {
              resolve(document.querySelector(selector))
              observer.disconnect()
          }
      })

      observer.observe(document.body, {
          childList: true,
          subtree: true
      })
  })
}

/**
 * Helper function to set CSS custom properties (CSS variables) to :root or defined element.
 * @param {String} CSSproperty Name of CSS custom property / variable i.e. --variable.
 * @param {String} value CCS value the custom property takes on.
 * @param {HTMLElement} el HTML element to append the value to. If empty defaults to documentElement
 */

export function setCSSProperty(CSSproperty, value, el = null) {
  el ?
    el.style.setProperty(CSSproperty, value) :
    document.documentElement.style.setProperty(CSSproperty, value)
}


/**
 * Function to get the offset of an element compared to document
 * @param {HTMLElement} el HTML element to be evaluated
 * @returns {object}
 */

export function elementOffset(el) {
  const rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  return {
    top: rect.top + scrollTop,
    left: rect.left + scrollLeft,
    bottom: rect.bottom + scrollTop,
    right: rect.right + scrollLeft
  };
}
