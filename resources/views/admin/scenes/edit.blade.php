@extends('layouts.app')

@section('content')
<div class="content">
    <a href="{{ route('admin.stories.edit', $story) }}#branches"
       class="inline-block mb-4 text-sm text-blue-600 hover:underline">
        ← Назад к сюжету
    </a>

    <h1 class="mb-4 text-2xl font-bold">Редактировать сцену</h1>

    <form action="{{ route('admin.scenes.update', $scene) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- История (readonly) --}}
        <input type="hidden" name="story_id" value="{{ $story->id }}">
        <div class="mb-2 text-sm text-gray-600">
            История: <strong>{{ $story->title }}</strong>
        </div>

        {{-- Глава --}}
        <div>
            <label class="block mb-1 font-semibold">Ключ главы (chapter_key)</label>
            <input type="text" name="chapter_key"
                   value="{{ old('chapter_key', $scene->chapter_key) }}"
                   class="w-full p-2 border rounded" required>
        </div>

        {{-- Ветка --}}
        <div>
            <label class="block mb-1 font-semibold">Ветка (branch)</label>
            <input type="text" name="branch"
                   value="{{ old('branch', $scene->branch) }}"
                   class="w-full p-2 border rounded" required>
        </div>

        {{-- Номер --}}
        <div>
            <label class="block mb-1 font-semibold">Номер сцены (number)</label>
            <input type="number" name="number"
                   value="{{ old('number', $scene->number) }}"
                   class="w-full p-2 border rounded" required>
        </div>

        {{-- Текст сцены --}}
        <div>
            <label class="block mb-1 font-semibold">Текст сцены</label>
            <textarea name="content"
                      class="w-full p-2 border rounded"
                      required>{{ old('content', $scene->content) }}</textarea>
        </div>

        {{-- Выборы --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 font-semibold">Выбор 1 — текст</label>
                <input type="text" name="choice_1_text"
                       class="w-full p-2 border rounded"
                       value="{{ old('choice_1_text', $scene->choice_1_text) }}">

                <label class="block mt-2 text-sm text-gray-600">Код цели (пример: vvod:main:2)</label>
                <input type="text" name="choice_1_target_code"
                       class="w-full p-2 border rounded"
                       value="{{ old('choice_1_target_code', $scene->choice_1_target_code) }}">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Выбор 2 — текст</label>
                <input type="text" name="choice_2_text"
                       class="w-full p-2 border rounded"
                       value="{{ old('choice_2_text', $scene->choice_2_text) }}">

                <label class="block mt-2 text-sm text-gray-600">Код цели (пример: vvod:sekond:1)</label>
                <input type="text" name="choice_2_target_code"
                       class="w-full p-2 border rounded"
                       value="{{ old('choice_2_target_code', $scene->choice_2_target_code) }}">
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Сохранить изменения
        </button>
    </form>
</div>
@endsection
