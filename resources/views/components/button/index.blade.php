@props([
  'action' => '',
  'id' => '',
  'class' => '',
  'height' => '',
  'white' => '',
  'link' => '',
  'icon' => '',
  'target' => '',
  'submit' => '',
  'disable' => false,
  'dataCC' => '',
  'onclick' => '',
])
<div class="btn-main relative p-[2px] rounded-4xl w-max {{ $height ? 'height' : 'h-[44px]' }} bg-linear-[116.57deg,#002E6E_0%,#00AEEF_83.33%]">
@if ($link)
<a
  href="{{ $link }}"

  @if ($id)
  id="{{ $id }}"
  @endif

 @if($target) target="{{ $target }}" @endif

  class="btn-main-body {{ $class ?? '' }} {{ $icon ? 'pr-[10px]' : 'pr-[20px]' }} {{ $white ? 'white' : 'dark' }} {{ $disable ? 'disable' : '' }}" wire:loading.class="disable" wire:loading.attr="disabled" >
@else
<button wire:loading.class="disable" wire:loading.attr="disabled" class="btn-main-body {{ $class ?? '' }} {{ $icon ? 'pr-[10px]' : 'pr-[20px]' }} {{ $white ? 'white' : 'dark' }} {{ $disable ? 'disable' : '' }}"

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

  <span class="main-bold btn-main-text">
    {{ $slot }}
  </span>
   @if($icon) <span class="{{ $icon }} btn-main-icon ml-[12px]"> </span> @endif
@if ($link)
</a>
@else
</button>
@endif
</div>