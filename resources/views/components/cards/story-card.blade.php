<div class="overflow-hidden transition bg-white shadow-md hover:shadow-xl rounded-xl">
    {{-- Slika zgodbe --}}
    @if ($story->cover_image)
        <a href="{{ route('stories.show', $story) }}">
            <div class="img-wrapper aspect-[4/5] flex justify-center items-center">
                <img src="{{ asset('storage/' . $story->cover_image) }}"
                alt="{{ $story->title }}"
                class="object-cover w-full">
            </div>
        </a>
    @endif

    {{-- Informacije --}}
    <div class="p-4">
        <a href="{{ route('stories.show', $story) }}">
            <h2 class="mb-3 text-xl font-semibold text-gray-800 hover:underline">
                {{ $story->title }}
            </h2>
        </a>
        <p class="mb-2 text-sm text-gray-600">
            {{ $story->short_description ?? Str::limit($story->description, 100) }}
        </p>
        <div class="mb-5 text-xs text-gray-500">Žanr: {{ $story->genre }}</div>

        <div class="flex flex-wrap justify-between gap-5">
             {{-- Gumb на первую сцену --}}
            @php
                $firstScene = $story->scenes()->where('type', 'main')->orderBy('id')->first();
            @endphp
            <a href="{{ route('stories.show', $story) }}"
                class="px-3 py-1 text-sm text-gray-700 border border-blue-600 rounded hover:bg-gray-100">
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
</div>
