<?php
$menuItems = [
    [
        'label' => 'Produkti',
        'children' => [
            ['label' => 'Oracle ', 'url' => '#'],
            ['label' => 'Lenovo', 'url' => '#'],
            ['label' => 'Cloudflare', 'url' => '#'],
            ['label' => 'Fujitsu', 'url' => '#'],
        ],
    ],
    [
        'label' => 'Storitve',
        'children' => [
            ['label' => 'Svetovanje', 'url' => '#'],
            ['label' => 'Podpora', 'url' => '#'],
        ],
    ],
    [
        'label' => 'Rešitve',
        'children' => [
            ['label' => 'Svetovanje', 'url' => '#'],
            ['label' => 'Podpora', 'url' => '#'],
        ],
    ],
    [
        'label' => 'VIRI',
        'children' => [
            ['label' => 'Svetovanje', 'url' => '#'],
            ['label' => 'Podpora', 'url' => '#'],
        ],
    ],
    ['label' => 'O nas', 'url' => '#'],
    ['label' => 'Zaposlitev', 'url' => '#'],
];
?>
<header
  x-data="{ scrolled: false }"
  x-init="window.addEventListener('scroll', () => {
      scrolled = window.scrollY > 0
  })"
  :class="scrolled ? 'bg-darkblue shadow-header' : 'bg-transparent'"
  class="fixed top-0 left-0 w-full z-50 transition-all duration-300"
  >
  <div
  :class="scrolled ? 'py-[8px]' : 'py-[27px]'"
  class="max-w-[1920px] mx-auto pl-[70px] pr-6 flex justify-between items-center ease-linear duration-300"
  >

    <a href="/">
      <div
      :class="scrolled ? 'w-[133px]' : 'w-[187px]'"
      class="img-wrapper ease-linear duration-300">
          <img class="w-full object-cover" src="{{ Vite::asset('resources/images/Integralis-logo.svg') }}" alt="Integralis">
      </div>
    </a>

    <div class="gray-line mx-6"></div>

    <x-header.menu :items="$menuItems" />
    <div class="gray-line mx-6"></div>
    <div>
      <x-button link="#">
        KONTAKT
      </x-button>
    </div>

  </div>
</header>

