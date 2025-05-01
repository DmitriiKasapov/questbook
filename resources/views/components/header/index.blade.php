<header class="flex items-center justify-between px-6 py-4 bg-white shadow-md">
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
</header>
