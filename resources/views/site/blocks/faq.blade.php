@if (!empty($title = $block->translatedInput('title')))
<h3 class="faq-title-style mb-4 top-border">{{ $title }}</h3>
@endif
<div class="c-accordion">
  @foreach ($block->children as $item)
    <x-expandable
      class="mb-4 border"
      :id="'accordion-' . $loop->iteration"
    >
      @slot('trigger')
        {{ $item->translatedInput('title') }}
      @endslot
      {!! $item->translatedInput('text') !!}
    </x-expandable>
  @endforeach
</div>







