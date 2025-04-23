/**
 * Basic HTML example:
 *
 *  <div class="countdown" data-end_date="{{ mktime(0, 0, 0, 12, 10, 2023) }}">
      <div data-id="days">
        <div data-time="time">60</div>
        <div data-time="localisation">dni</div>
      </div>
      <div data-id="hours">
        <div data-time="time">03</div>
        <div data-time="localisation">ur</div>
      </div>
      <div data-id="min">
        <div data-time="time">15</div>
        <div data-time="localisation">min</div>
      </div>
      <div data-id="sec">
        <div data-time="time">10</div>
        <div data-time="localisation">sek</div>
      </div>
    </div>
 *
 */
export default class {
  constructor(el) {
    this.el = el;
    this.children = el.querySelectorAll('[data-id]');
    /* Used in conjunction with PHP's mktime() function */
    this.endDate = new Date( parseInt(el.dataset.end_date.toString().padEnd(13, '0')) ).getTime();
    this.time = {
      days: '00',
      hours: '00',
      min: '00',
      sec: '00'
    }

    this.localisation = {
      days: ['dni', 'dan', 'dni', 'dni'],
      hours: ['ur', 'ura', 'uri', 'ure'],
      min: ['min', 'min', 'min', 'min'],
      sec: ['sek', 'sek', 'sek', 'sek',]
    }

    this.timeInterval = setInterval(() => this.setTime(this.endDate), 100);
  }

  setTime ( date ) {
    const delta = ( date - ( new Date().getTime() )) / 1000
    this.time.sec = Math.floor(( delta ) % 60);
    this.time.min = Math.floor(( delta / 60 ) % 60 );
    this.time.hours = Math.floor((( delta ) / 3600 ) % 24 );
    this.time.days = Math.floor((( delta ) / 86400 ));
    this.setHtml(this.children)
  }

  setHtml( children ) {
    children.forEach(child => {
      const elements = child.querySelectorAll('[data-time]')
      elements.forEach(el => {
        el.innerText =
          el.dataset.time === 'time' ?
          this.time[child.dataset.id].toString().padStart(2, '0') :
          this.getLocalisation( child.dataset.id, this.time[el.dataset.time])
      })
    })
  }

  getLocalisation( id, time ) {
    switch( time ) {
      case 1: return this.localisation[id][time]
      case 2: return this.localisation[id][time]
      case (0 < time < 6): return this.localisation[id][time]
      default: return this.localisation[id][0]
    }
  }
}
