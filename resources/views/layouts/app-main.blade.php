<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'QuestBook' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="body">

        {{-- Header --}}
        @include('components.header.index')

        {{-- Контент --}}
        <main class="main">
            @yield('content')
        </main>

        {{-- Футер (по желанию) --}}
        <footer class="py-4 text-sm text-center text-gray-500 bg-white border-t">
            &copy; {{ date('Y') }} QuestBook
        </footer>

</body>
</html>
