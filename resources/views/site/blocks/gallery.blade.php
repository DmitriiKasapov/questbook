@php
$images = [];
foreach ($block->imageObjects('square') as $media) {
  $images[] = [
    'src' => $block->image('square', 'default', ['fm' => 'webp', 'w' => 240], media: $media),
    'fb' => $block->image('square', 'default', ['fm' => 'jpg', 'w' => 240], media: $media),
    'alt' => $media->alt_text,
  ];
}
@endphp

@if (!empty($title = $block->translatedInput('title')))
<h4 class="">{{ $title }}</h4>
@endif
<x-gallery :$images />
