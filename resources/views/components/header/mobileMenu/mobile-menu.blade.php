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
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-40"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 max-h-40"
                    x-transition:leave-end="opacity-0 max-h-0"
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