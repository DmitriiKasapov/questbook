@php
    $chapters = $story->chapters->sortBy('position');
@endphp

<div
    x-data="{ activeChapter: '{{ $activeChapterKey ?? ($chapters->first()?->key ?? 'new') }}' }"
    x-init="$watch('tab', value => history.replaceState(null, null, '?tab=' + value + '&chapter={{ $initialChapterKey }}'))"
    x-cloak
>
    {{-- Табы глав --}}
    <div class="flex flex-wrap gap-2 mb-4">
        @foreach ($chapters as $chapter)
            <button @click="activeChapter = '{{ $chapter->key }}'"
                    :class="activeChapter === '{{ $chapter->key }}' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'"
                    class="px-3 py-1 rounded">
                {{ $chapter->title }}
            </button>
        @endforeach

        {{-- + Новая --}}
        <button @click="activeChapter = 'new'"
                :class="activeChapter === 'new' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800'"
                class="px-3 py-1 rounded">
            + Новая
        </button>
    </div>

    {{-- Форма новой главы --}}
    <div x-show="activeChapter === 'new'" x-transition>
        <form action="{{ route('admin.chapters.store') }}" method="POST" enctype="multipart/form-data"
              class="max-w-xl p-4 space-y-6 bg-white rounded shadow">
            @csrf
            <input type="hidden" name="story_id" value="{{ $story->id }}">

            <div>
                <label class="block font-bold">Название главы</label>
                <input type="text" name="title" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-bold">Контент (вступление)</label>
                <textarea name="content" rows="4" class="w-full p-2 border rounded"></textarea>
            </div>

            <div>
                <label class="block font-bold">Картинка главы</label>
                <input type="file" name="image" accept="image/*" class="mt-1">
            </div>

            <div>
                <label class="block font-bold">Музыка (mp3)</label>
                <input type="file" name="music" accept="audio/*" class="mt-1">
            </div>

            <div>
                <label class="block font-bold">Порядок (0 = первая)</label>
                <input type="number" name="position" value="0" class="w-24 p-2 border rounded">
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Сохранить главу</button>
        </form>
    </div>

    {{-- Отображение глав --}}
    @foreach ($chapters as $chapter)
        <div x-show="activeChapter === '{{ $chapter->key }}'" x-transition class="space-y-6">
            @include('admin.stories._chapter-editor', ['chapter' => $chapter, 'story' => $story])
        </div>
    @endforeach
</div>
