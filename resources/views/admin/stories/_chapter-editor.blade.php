@php
    $chapterScenesCount = 0;
    $chapterBranches = $story->branches->filter(fn($b) => $b->chapter_key === $chapter->key);
@endphp

<form action="{{ route('admin.chapters.update', $chapter) }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded shadow">
    @csrf
    @method('PUT')

    <div class="flex items-start justify-between">
        <h2 class="text-lg font-semibold">Редактировать главу: {{ $chapter->title }}</h2>
        <form action="{{ route('admin.chapters.destroy', $chapter) }}" method="POST"
              onsubmit="return confirm('Удалить главу?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-red-500 hover:underline">Удалить 🗑</button>
        </form>
    </div>

    <input type="hidden" name="story_id" value="{{ $story->id }}">

    <div>
        <label class="block font-bold">Название главы</label>
        <input type="text" name="title" value="{{ $chapter->title }}" required class="w-full p-2 border rounded">
    </div>

    <div>
        <label class="block font-bold">Контент</label>
        <textarea name="content" rows="4" class="w-full p-2 border rounded">{{ $chapter->content }}</textarea>
    </div>

    <div>
        <label class="block font-bold">Порядок</label>
        <input type="number" name="position" value="{{ $chapter->position }}" class="w-24 p-2 border rounded">
    </div>

    <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-600 rounded">Сохранить изменения</button>
</form>

{{-- Добавление ветки для этой главы --}}
<div class="my-4">
    <form action="{{ route('admin.branches.store') }}" method="POST" class="flex items-end gap-2">
        @csrf
        <input type="hidden" name="story_id" value="{{ $story->id }}">
        <input type="hidden" name="chapter_key" value="{{ $chapter->key }}">
        <div>
            <label class="block mb-1 text-sm">Название ветки</label>
            <input type="text" name="title" class="p-2 border rounded" placeholder="Новая ветка" required>
        </div>
        <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Добавить</button>
    </form>
</div>

{{-- Ветки и сцены этой главы --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
    @foreach ($chapterBranches as $branch)
        @php
            $chapterScenes = $branch->scenes->filter(fn($s) => $s->chapter_key === $chapter->key);
            $chapterScenesCount += $chapterScenes->count();
        @endphp

        <div class="flex flex-col p-3 border rounded bg-gray-50">
            <div class="flex items-center justify-between mb-2">
                <div class="font-semibold">{{ $branch->title }}</div>
                <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST"
                      onsubmit="return confirm('Удалить ветку?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-500 hover:underline">Удалить</button>
                </form>
            </div>

            <div class="mb-2 space-y-2">
                @foreach ($chapterScenes as $scene)
                    <div class="p-2 text-sm bg-white border rounded shadow-sm">
                        [{{ $scene->branch }}:{{ $scene->number }}]
                        <div class="text-xs text-gray-500">
                            {{ Str::limit($scene->content, 60) }}
                        </div>
                        <div class="text-[10px] text-gray-400">
                            {{ $scene->choice_1_target_code ?? '—' }} / {{ $scene->choice_2_target_code ?? '—' }}
                        </div>
                        <div class="flex gap-2 mt-1 text-xs">
                            <a href="{{ route('admin.scenes.edit', $scene) }}" class="text-blue-600 hover:underline">Редактировать</a>
                            <form action="{{ route('admin.scenes.destroy', $scene) }}" method="POST"
                                  onsubmit="return confirm('Удалить сцену?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Удалить</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('admin.scenes.create', ['story_id' => $story->id, 'branch_id' => $branch->id]) }}"
               class="inline-block mt-2 text-xs text-blue-600 hover:underline">
                + Добавить сцену
            </a>
        </div>
    @endforeach

    @if ($chapterScenesCount === 0)
        <div class="p-4 text-sm text-gray-500 bg-gray-100 rounded">
            Для этой главы пока нет сцен. Добавьте сцену вручную через нужную ветку.
        </div>
    @endif
</div>
