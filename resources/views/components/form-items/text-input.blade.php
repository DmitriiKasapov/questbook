@props(['type', 'name', 'placeholder' => '', 'message' => '', 'disabled' => false])

<div @class(['text-input form-item flex flex-col'])>
  @if ($slot->isNotEmpty())
    <label class="black" for={{ $name }}>{{ $slot }}</label>
  @endif
  <input
    id="{{ $name }}"
    type="{{ $type ?? 'text' }}"
    wire:model="{{ $name }}"
    @if ($placeholder)
      placeholder="{{ $placeholder }}"
    @endif
    {{ $disabled ? 'disabled' : '' }}
    @class(['bb-black pb-2', $errors->has($name) ? 'error' : ''])
    {{ $errors->has($name) ?? '' ? 'describedby='. $name . '-error' : '' }}
    {{ $errors->has($name) ?? '' ? 'aria-invalid="true"' : '' }}
  >
  @error ($name)
    <x-form-items.error-message :id="$name">
      {{ $message }}
    </x-form-items.error-message>
  @enderror
</div>
