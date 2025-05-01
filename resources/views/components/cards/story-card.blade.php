<div class="overflow-hidden transition bg-white shadow-md rounded-xl hover:shadow-lg">
    {{-- Slika zgodbe --}}
    @if ($story->cover_image)
        <a href="{{ route('stories.show', $story) }}">
            <img src="{{ asset('storage/' . $story->cover_image) }}"
                 alt="Обложка"
                 class="object-cover w-full h-48">
        </a>
    @endif

    {{-- Informacije --}}
    <div class="p-4">
        <a href="{{ route('stories.show', $story) }}">
            <h2 class="mb-1 text-xl font-semibold text-gray-800 hover:underline">
                {{ $story->title }}
            </h2>
        </a>
        <p class="mb-2 text-sm text-gray-600">
            {{ $story->short_description ?? Str::limit($story->description, 100) }}
        </p>
        <div class="mb-3 text-xs text-gray-500">Жанр: {{ $story->genre }}</div>

        {{-- Gumb на первую сцену --}}
        @php
            $firstScene = $story->scenes()->where('type', 'main')->orderBy('id')->first();
        @endphp
        <a href="{{ route('stories.show', $story) }}"
            class="px-3 py-1 text-sm text-gray-700 border border-gray-300 rounded hover:bg-gray-100">
            Подробнее
        </a>
        @if ($firstScene)
            <a href="{{ route('scenes.show', $firstScene) }}"
               class="inline-block px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
               Читать
            </a>
        @else
            <span class="text-sm text-gray-400">Черновик</span>
        @endif
    </div>
</div>
