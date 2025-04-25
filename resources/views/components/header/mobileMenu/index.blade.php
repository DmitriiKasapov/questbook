@props([
  'class' => '',
  'items' => []
  ])
<div x-data="{ mobileOpen: false }" class="header_mobileMenu relative {{ $class }}">
  <!-- Hamburger gumb -->

    <button @click="mobileOpen = true" class="xl:hidden cursor-pointer">
      <span class="icon-hamburger_menu text-blue hover:text-lightblue transition-all duration-300"></span>
    </button>



  <!-- Overlay -->
  <div
      x-show="mobileOpen"
      x-transition.opacity
      class="fixed inset-0 bg-[rgba(0,0,0,0.5)] z-40"
      @click="mobileOpen = false"
      x-cloak
  ></div>

  <!-- Mobilni meni -->
  <div
      x-show="mobileOpen"
      x-transition:enter="transition ease-in-out duration-300"
      x-transition:enter-start="translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transition ease-in-out duration-300"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="translate-x-full"
      @click.outside="mobileOpen = false"
      class="fixed top-0 right-0 sm:w-[375px] w-full h-full bg-darkblue z-50 p-6 shadow-lg overflow-y-auto max-h-screen hide-scrollbar"
      x-cloak
  >
      <!-- Križec -->
      <div class="flex items-center pt-[26px] pb-[30px]">
        <div class="gray-line"></div>
        <button @click="mobileOpen = false" class="cursor-pointer">
          <span class="icon-close_circle text-blue hover:text-lightblue transition-all duration-300"></span>
        </button>
      </div>


      <!-- Meni z akordeonom -->
      <x-header.mobileMenu.mobile-menu :items="$items" />

      <div class="pt-4 pb-[36px] mt-4 border-t border-gray flex justify-between gap-5">
        <div >
          <a href="tel:+014703400" class="text-blue hover:text-lightblue transition-all duration-300 flex items-center gap-2 py-3">
            <span class="icon-phone"></span>
            <span>01 470 34 00</span>
          </a>
          <a href="mailto:info@integralis.si" class="text-blue hover:text-lightblue transition-all duration-300 flex items-center gap-2 py-3">
            <span class="icon-email"></span>
            <span>info@integralis.si</span>
          </a>
        </div>
        <div class="social-icons flex gap-[10px]">
          <a href="#">
            <span class="icon-ln_circle"></span>
          </a>
          <a href="#">
            <span class="icon-fb_circle"></span>
          </a>
        </div>
      </div>
  </div>
</div>
