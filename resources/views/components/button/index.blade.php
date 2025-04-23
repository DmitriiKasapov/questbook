@props([
  'action' => '',
  'id' => '',
  'class' => '',
  'white' => '',
  'link' => '',
  'icon' => '',
  'target' => '',
  'submit' => '',
  'disable' => false,
  'dataCC' => '',
  'onclick' => '',
])
<div class="btn-main mt-[30px] relative p-[2px] rounded-4xl w-max bg-linear-[116.57deg,#002E6E_0%,#00AEEF_83.33%]">
@if ($link)
<a
  href="{{ $link }}"

  @if ($id)
  id="{{ $id }}"
  @endif

 @if($target) target="{{ $target }}" @endif

  class="btn-main-body inline-block py-[15px] px-[20px] rounded-4xl {{ $class ?? '' }} {{ $white ? 'bg-white' : 'bg-darkblue' }} {{ $disable ? 'disable' : '' }}" wire:loading.class="disable" wire:loading.attr="disabled" >
@else
<button wire:loading.class="disable" wire:loading.attr="disabled" class="btn-main-body {{ $class ?? '' }} {{ $white ? 'bg-white' : 'bg-darkblue' }} {{ $disable ? 'disable' : '' }}"

  @if ($id)
  id="{{ $id }}"
  @endif

  @if ($onclick)
    onclick="{{$onclick}}"
  @endif

  @if ($action)
  wire:click="{{ $action }}"
  @endif

  type="{{ $submit ? 'submit' : 'button' }}"

  >
@endif
  @if($icon) <span class="{{ $icon }} btn-main-icon"> </span> @endif
  <span class="btn-main-text">
    {{ $slot }}
  </span>
@if ($link)
</a>
@else
</button>
@endif
</div>