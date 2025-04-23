@if (!empty($title = $block->translatedInput('title')))
<h4 class="">{{ $title }}</h3>
@endif
@foreach ($block->children as $item)
  @if (!$item->input('hidden'))
    <a href="{{ $item->translatedInput('link') }}"
      class=""
      @if ($item->input('new_window') ?? false) target="_blank" @endif
    >
      <span class="{{ $item->input('icon') }}"></span>
      {{ $item->translatedInput('title') }}
    </a>
  @endif
@endforeach
