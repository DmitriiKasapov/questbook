<div class="relative">
  <swiper-container
    @class([$class ?? 'swiper-default', 'swiper'])
    slides-per-view="auto"
    navigation-next-el=".button-next-{{ $id }}"
    navigation-prev-el=".button-prev-{{ $id }}"
    pagination-el=".pagination-{{ $id }}"
    space-between="12"
    init="false"
    {{ $loop ?? '' ? 'loop' : null }}
    {{ $minwidth ?? '' ? 'data-minwidth='.$minwidth  : null }}
  >
    @foreach ($cards as $card)
      <x-dynamic-component :component="'swiper.cards.' . $component" :card="$card"/>
    @endforeach
  </swiper-container>
  <button class="button-prev-{{ $id }}">
    <span class="visaully-hidden">Previous slide</span>
  </button>
  <button class="button-next-{{ $id }}">
    <span class="visually-hidden">Next slide</span>
  </button>
  <div class="pagination-{{ $id }}"></div>
</div>
