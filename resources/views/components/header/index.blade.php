<header
    x-data="{ scrolled: false }"
    x-init="window.addEventListener('scroll', () => {
        scrolled = window.scrollY > 10;
    })"
    :class="scrolled ? 'px-4 py-2 shadow bg-white/90 backdrop-blur-md' : 'px-6 py-4 bg-white shadow-md'"
    class="fixed top-0 left-0 z-50 w-full transition-all duration-300"
>
    <div class="flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">QuestBook</a>

        @auth
            <div class="flex items-center gap-4">
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.panel') }}" class="text-sm text-gray-600 hover:text-blue-500">Админка</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-500 hover:text-red-700">Выйти</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">Войти</a>
        @endauth
    </div>
</header>
