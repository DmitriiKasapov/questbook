<div
  {{ $attributes->merge(['class' => 'modal']) }}
  role="document"
  @if ($openbtns ?? '')
    data-openbtns="{{ $openbtns }}"
  @endif
  hidden
>
  <div class="modal-background absolute bg-blue-dark"></div>
  <div class="modal-body-wrapper">
    <div class="modal-body bg-white" role="dialog">
      <div class="modal-header flex items-center justify-between pt-5 px-5 pb-4">
        {{ $title }}
        <button class="modal-close iconC icon-close shadow-focus"></button>
      </div>
      <div class="modal-main">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>
