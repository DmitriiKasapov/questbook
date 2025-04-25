@props([
  'action' => '',
  'id' => '',
  'class' => '',
  'height' => '',
  'link' => '',
  'icon' => '',
  'target' => '',
  'submit' => '',
  'disable' => false,
 ])
<div class="btn-main w-max {{ $height ? $height : 'h-[44px]' }}">
@if ($link)
<a
  href="{{ $link }}"

  @if ($id)
  id="{{ $id }}"
  @endif

 @if($target) target="{{ $target }}" @endif

  class="main-button {{ $class ?? '' }} {{ $icon ? 'pr-[10px]' : 'pr-[20px]' }} {{ $disable ? 'disable' : '' }}" wire:loading.class="disable" wire:loading.attr="disabled" >
@else
<button wire:loading.class="disable" wire:loading.attr="disabled" class="main-button {{ $class ?? '' }} {{ $icon ? 'pr-[10px]' : 'pr-[20px]' }} {{ $disable ? 'disable' : '' }}"

  @if ($id)
  id="{{ $id }}"
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