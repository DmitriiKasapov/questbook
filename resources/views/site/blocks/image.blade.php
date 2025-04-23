@if (!empty($title = $block->translatedInput('title')))
<h4 class="fixed-title-style mb-4 top-border">{{ $title }}</h4>
@endif
<div class="image-with-text">
  <x-picture
    class="image"
    :src="$block->image('image', 'default', ['fm' => 'webp', 'w' => 850])"
    :fb="$block->image('image', 'default', ['fm' => 'jpg', 'w' => 850])"
    :alt="$block->imageAltText('image')"
  />
  @if (!empty($text = $block->translatedInput('text')))
    <div class="text">
      <div class="bg-white">
        {!! $text !!}
      </div>
    </div>
  @endif
</div>
