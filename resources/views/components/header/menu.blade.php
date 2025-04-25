@props([
  'class' => '',
  'items' => [],
  ])

<div
    x-data="{ openMenu: null }"
    @click.outside="openMenu = null"
    class="flex space-x-8 items-center {{ $class }}"
>
    @foreach($items as $item)
        <div class="relative">
            @if(isset($item['children']))
                <button
                    @click="openMenu === '{{ $item['label'] }}' ? openMenu = null : openMenu = '{{ $item['label'] }}'"
                    class="header-menu-item flex items-center gap-1 hover:text-blue {{ $item['active'] ? 'active' : '' }}"
                    type="button"
                >
                    <span class="menu-item-el main-bold text-gray">{{ $item['label'] }}</span>
                    <span class="menu-item-el w-[17px] h-[17px] icon-chevron_D text-blue text-[17px]"></span>
                    {{-- <svg class="w-4 h-4 transition-transform duration-200" :class="openMenu === '{{ $item['label'] }}' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg> --}}
                </button>

                <div
                    x-show="openMenu === '{{ $item['label'] }}'"
                    x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="header-submenu absolute left-[-20px] mt-4 py-2 bg-white shadow-lg rounded-xl w-40 z-50"
                >
                    @foreach($item['children'] as $child)
                        <a href="{{ $child['url'] ?? '#' }}" class="block font-mc-bold text-black px-[15px] py-[10px] hover:bg-lightgray hover:text-blue transition-all duration-300">{{ $child['label'] }}</a>
                    @endforeach
                </div>
            @else
                <a href="{{ $item['url'] ?? '#' }}" class="menu-item-link main-bold text-gray header-menu-item {{ $item['active'] ? 'active' : '' }}">{{ $item['label'] }}</a>
            @endif
        </div>
    @endforeach
</div>