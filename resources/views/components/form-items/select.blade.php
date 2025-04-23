{{-- Custom select
  It is able to listen to its own value changes (onchange) visible under event.detail - returns name and value.
  The data-value on the <li> gets automatically inserted as the value of the <input> element.
  Accepts data-initval, which will have the <li> item with the same value preselected.
  Whatever HTML was inside the <li> gets substituted into the .selected-value element.
  Selecting the same value twice will deselect it and the event.detail will be null, if data-deselect = true.

  Extends the expandable class/component. Omitted "click-outside", should always default to true.
  data-deselect: Default false. If selection should be able to be nullified.
--}}

@props([
  'name',
  'options',
  'class' => '',
  'initval' => '',
  'buttonText' => '',
  'deselect' => false,
  /* Extended Expandable features */
  'duration' => '',
  'closer' => '',
  'mode' => '',
  'opened' => false,
  'disabled' => false
])

<div @class(['form-item select relative', $class])
  {{ $duration ? 'data-duration='.$duration : '' }}
  {{ $opened ? 'data-opened='.$opened : '' }}
  {{ $closer ? 'data-closer='.$closer : '' }}
  {{ $mode ? 'data-mode='.$mode : '' }}
  {{ $disabled ? 'tabindex="-1" data-disabled='.$disabled : '' }}
  {{ $initval ? 'data-initval='.$initval : '' }}
  {{ $deselect ? 'data-deselect='.$deselect : '' }}
  x-on:change="$wire.{{ $name }} = event.detail.value"
  wire:ignore
>
  @if ($slot->isNotEmpty())
    <label for="{{ $name }}" class="label black">{{ $slot }}</label>
  @endif

  <div class="relative">
    <button
      class="select-button flex items-center justify-between gap-1 w-full"
      role="combobox"
      aria-expanded="false"
      aria-controls="{{ $name }}"
      aria-haspopup="listbox"
      type="button"
    ><span class="selected-value">{{ $buttonText }}</span><span class="icon-arrow_small_D"></span></button>

    <ul class="absolute bg-background-800 custom-scrollbar min-w-full" hidden role="listbox" id="{{ $name }}" wire:ignore>
      @foreach ($options as $key => $label)
        <li class="px-3 py-1" role="option" aria-selected="false" tabindex="0">
          <input type="radio" id="{{ "$name-$loop->index" }}" name="{{ $name }}" value={{ $key }} class="visually-hidden" />
          <label for={{ "$name-$loop->index" }}>
            {{ $label }}
          </label>
        </li>
      @endforeach
    </ul>
  </div>
</div>
