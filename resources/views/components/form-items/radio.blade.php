@props(['id', 'name', 'value', 'disabled' => false])

<div class="form-item radio">
  <input type="radio" id="{{ $id }}" name="{{ $name }}" value={{ $value }} {{ $disabled ? 'disabled' : '' }} class="visually-hidden" />
  <label for={{ $id }} class="flex items-baseline gap-2">
    <div>
      <div class="faux-radio"></div>
    </div>
    <div>
      {{ $slot }}
    </div>
  </label>
</div>
