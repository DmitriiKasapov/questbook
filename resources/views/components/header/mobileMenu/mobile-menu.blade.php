@props([
  'items' => []
  ])

<div x-data="{ openIndex: null }" class="header_mobileMenu_mobile-menu px-6 w-full">
    @foreach($items as $index => $item)
        <div>
            @if(isset($item['children']))
                <button
                    @click="openIndex === {{ $index }} ? openIndex = null : openIndex = {{ $index }}"
                    class="mobile-menu-item flex items-center w-full px-3 py-4 relative cursor-pointer text-white {{ $item['active'] ? 'active' : '' }}"
                >
                    <span class="menu-item-el main-bold text-white">{{ $item['label'] }}</span>
                    <span class="menu-item-el w-[17px] h-[17px] icon-chevron_D text-blue text-[17px]"></span>
                </button>

                <div
                x-show="openIndex === {{ $index }}"
                    x-transition:enter="transition-all ease-out duration-800"
                    x-transition:enter-start="max-h-0 opacity-0"
                    x-transition:enter-end="max-h-96 opacity-100"
                    x-transition:leave="transition-all ease-in duration-400"
                    x-transition:leave-start="max-h-96 opacity-100"
                    x-transition:leave-end="max-h-0 opacity-0"
                    x-cloak
                    class="overflow-hidden pl-3"
                >
                    @foreach($item['children'] as $child)
                        <a href="{{ $child['url'] ?? '#' }}" class="mobile-submenu-el block px-3 py-[14px] text20 text-white">
                            {{ $child['label'] }}
                        </a>
                    @endforeach
                </div>
            @else
                <a href="{{ $item['url'] ?? '#' }}" class="menu-item-link block px-3 py-4 main-bold text-white {{ $item['active'] ? 'active' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endif
        </div>
    @endforeach
</div>
