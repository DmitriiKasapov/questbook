{{-- Example argument:
  [
    'pictures' => [
      [
        'size' => 1024,
        'src' => 'webp image',
        'fb' => 'png/jpeg/jpg image'
      ],
      [
        'size' => 768,
        'src' => 'webp image',
        'fb' => 'png/jpeg/jpg image'
      ],
    ],
    'src' => 'webp image', //only required if no picture array,
    'fb' => 'png/jpeg/jpg image',
    'alt' => 'alt text'
  ]
--}}

@props([
  'fb',
  'alt',
  'src' => '',
  'class' => '',
  'pictures' => []
])

<picture>
  @if ($pictures)
    @foreach ($pictures as $picture)
      <source media="(min-width: {{ $picture['size'] }}px)" type="image/webp"
              srcset="{{ $picture['src'] }}"
      >
      <source media="(min-width: {{ $picture['size'] }}px)"
              srcset="{{ $picture['fb'] }}"
      >
    @endforeach
  @elseif ($src)
    <source type="image/webp" srcset="{{ $src }}">
  @endif
  <img src="{{ $fb }}" alt="{{ $alt }}" @class([ $class ])>
</picture>

