<?php
$menuItems = [
    [
      'active' => true,
      'label' => 'Produkti',
      'children' => [
          ['label' => 'Oracle ', 'url' => '#'],
          ['label' => 'Lenovo', 'url' => '#'],
          ['label' => 'Cloudflare', 'url' => '#'],
          ['label' => 'Fujitsu', 'url' => '#'],
      ],
    ],
    [
      'active' => false,
      'label' => 'Storitve',
      'children' => [
          ['label' => 'Svetovanje', 'url' => '#'],
          ['label' => 'Podpora', 'url' => '#'],
      ],
    ],
    [
      'active' => false,
      'label' => 'Rešitve',
      'children' => [
          ['label' => 'Svetovanje', 'url' => '#'],
          ['label' => 'Podpora', 'url' => '#'],
      ],
    ],
    [
      'active' => false,
      'label' => 'VIRI',
      'children' => [
          ['label' => 'Svetovanje', 'url' => '#'],
          ['label' => 'Podpora', 'url' => '#'],
      ],
    ],
    [
      'active' => false,
      'label' => 'O nas',
      'url' => '#'
    ],
    [
      'active' => false,
      'label' => 'Zaposlitev',
      'url' => '#'],
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
  class="max-w-[1920px] mx-auto xl:pl-[70px] sm:pl-6 pl-5 sm:pr-6 pr-5 flex justify-between items-center ease-linear duration-300"
  >

    <a href="/">
      <div
      :class="scrolled ? 'w-[133px]' : 'md:w-[187px] w-[165px]'"
      class="img-wrapper ease-linear duration-300">
          <img class="w-full object-cover" src="{{ Vite::asset('resources/images/Integralis-logo.svg') }}" alt="Integralis">
      </div>
    </a>

    <div class="gray-line"></div>

    <x-header.menu :items="$menuItems" class="max-xl:hidden" />
    <div class="gray-line max-xl:hidden"></div>
    <div class="max-xl:hidden">
      <x-button link="#">
        KONTAKT
      </x-button>
    </div>
    <div class="burger-icon cursor-pointer xl:hidden">
      <span class="icon-hamburger_menu text-blue hover:text-lightblue transition-all duration-300"></span>
    </div>
  </div>
</header>

