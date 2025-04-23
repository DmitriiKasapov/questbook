{{-- Available options as attributes to be written on the outer div:
  data-duration: animation duration in ms - default 400;
  data-mode: hover | click - default click;
  data-close: if specified attach close to close trigger;
  data-click-outside: close on clicks outside the element. Default false;
  data-check-top: scroll document if top of element goes outside the document view. Default true;
  data-opened: if element should start out as opened;
  data-disabled: if element should be expandable by the user;

  See expandable.js for code
--}}

@props([
  'duration' => '',
  'close_trigger' => '',
  'mode' => '',
  'class' => '',
  'id' => '',
  'opened' => false,
  'disabled' => false,
  'check_top' => false,
  'click_outside' => false
])

<div @class(['expandable', $class]) wire:ignore.self
  {{ $click_outside ? 'data-click-outside='.$click_outside : '' }}
  {{ $duration ? 'data-duration='.$duration : '' }}
  {{ $opened ? 'data-opened='.$opened : '' }}
  {{ $close_trigger ? 'data-close-trigger='.$close_trigger : '' }}
  {{ $mode ? 'data-mode='.$mode : '' }}
  {{ $check_top ? 'data-check-top='.$check_top : '' }}
  {{ $disabled ? 'tabindex="-1" data-disabled='.$disabled : '' }}>
  <button
    class="flex justify-between w-full expandable__trigger"
    type="button"
    {{ $opened ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
    {{ $id ? 'aria-controls='.$id : '' }}
    wire:ignore.self
  >{{ $trigger }}</button>
  <div {{ $id ? 'id='.$id : '' }} @class(['expandable__content']) {{ $opened ? '' : 'hidden' }} wire:ignore.self>
    <div>{{ $slot }}</div>
  </div>
</div>
