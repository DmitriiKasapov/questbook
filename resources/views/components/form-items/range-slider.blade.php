@props(['name'])

<div class="range-slider form-item">
  <div class="flex items-center justify-between gap-3 mt-2">
    <label class="w-full">
      min
      <input type="number" id="{{ $name }}-min-input" class="minval-input" min="0" max="100" value="0">
    </label>
    <span class="mt-5">-</span>
    <label class="w-full">
      max
      <input type="number" id="{{ $name }}-max-input" class="maxval-input" min="0" max="100" value="100">
    </label>
  </div>
  <div class="relative w-full h-[0.625rem] mt-5 mb-4">
    <div class="absolute top-0 left-0 w-full h-full slider-faux-track">
      <div class="absolute top-0 h-full rounded-full full-track left-1 right-1 bg-gray-lines"></div>
      <div class="absolute top-0 h-full rounded-full inner-track left-1 right-1 bg-link"></div>
    </div>
    <input class="absolute top-0 left-0 w-full minval-slider" id="{{ $name }}-min-range" type="range" min="0" max="100" name="{{ $name }}" step="0.1" value="0">
    <input class="absolute top-0 left-0 w-full maxval-slider" id="{{ $name }}-max-range" type="range" min="0" max="100" name="{{ $name }}" step="0.1" value="100">
  </div>
</div>
