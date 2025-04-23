@props(['name', 'message' => '', 'checked' => false, 'round' => false, 'disabled' => false])

<div class="flex items-baseline gap-2 form-item checkbox">
  <label @class(['checkbox-input shrink-0', 'rounded' => $round, $errors->has($name) ? 'border border-error' : ''])>
    <input type="checkbox" class="visually-hidden"
      id="{{ $name }}"
      wire:model="{{ $name }}"
      {{ $checked ? 'checked' : '' }}
      {{ $disabled ? 'disabled' : '' }}
      {{ $errors->has($name) ?? '' ? 'describedby='. $name . '-error' : '' }}
      {{ $errors->has($name) ?? '' ? 'aria-invalid="true"' : '' }}
    >
    <!-- Check icon -->
    <div class="clip-path"></div>

    <div class="text-lg checkbox-text">
      {{ $slot }}
    </div>
  </label>
  @error ($name)
    <x-form-items.error-message :id="$name">
      {{ $message }}
    </x-form-items.error-message>
  @enderror
  </div>
</div>
