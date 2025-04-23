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
  <div class="max-w-[1920px] mx-auto pl-[70px] pr-6 py-[26px] flex justify-between items-center">
      <a href="/">
        <div class="img-wrapper">
           <img src="{{ Vite::asset('resources/images/Integralis-logo.svg') }}" alt="Integralis">
        </div>
      </a>

      <x-header.menu :items="$menuItems" />

      <div>
        <x-button link="#">
          KONTAKT
        </x-button>
      </div>

  </div>
</header>

