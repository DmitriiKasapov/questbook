@extends('layouts.app')

@section('content')
<div class="max-w-3xl px-4 py-6 mx-auto">
    @if (isset($story))
        <a href="{{ route('admin.stories.edit', $story) }}#scenes"
           class="inline-block mb-4 text-sm text-blue-600 hover:underline">
            ← Назад ко всем сценам истории
        </a>
    @endif

    <h1 class="mb-4 text-2xl font-bold">Добавить сцену</h1>

    <form action="{{ route('admin.scenes.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Привязка к истории --}}
        @if (!isset($story))
            <div>
                <label class="block mb-1 font-semibold">История</label>
                <select name="story_id" required class="w-full p-2 border rounded">
                    <option value="">— Выберите историю —</option>
                    @foreach ($stories as $s)
                        <option value="{{ $s->id }}" @selected(old('story_id') == $s->id)>
                            {{ $s->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <input type="hidden" name="story_id" value="{{ $story->id }}">
            <div class="mb-2 text-sm text-gray-600">
                История: <strong>{{ $story->title }}</strong>
            </div>
        @endif

        {{-- Привязка к ветке --}}
        @if (isset($branch))
            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
            <div class="mb-2 text-sm text-gray-500">
                Ветка: <strong>{{ $branch->title }}</strong>
            </div>
        @endif

        {{-- Тип сцены --}}
        <div>
            <label class="block mb-1 font-semibold">Тип</label>
            <select name="type" class="w-full p-2 border rounded" required>
                <option value="main" @selected(old('type') === 'main')>Основная</option>
                <option value="branch" @selected(old('type') === 'branch')>Ветка</option>
                <option value="ending" @selected(old('type') === 'ending')>Финал</option>
            </select>
        </div>

        {{-- Контент --}}
        <div>
            <label class="block mb-1 font-semibold">Текст сцены</label>
            <textarea name="content" class="w-full p-2 border rounded" required>{{ old('content') }}</textarea>
        </div>

        {{-- Выборы --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 font-semibold">Выбор 1</label>
                <input type="text" name="choice_1_text" class="w-full p-2 border rounded"
                       value="{{ old('choice_1_text') }}">
                <label class="block mt-2 text-sm text-gray-600">ID целевой сцены</label>
                <input type="number" name="choice_1_target_scene_id" class="w-full p-2 border rounded"
                       value="{{ old('choice_1_target_scene_id') }}">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Выбор 2</label>
                <input type="text" name="choice_2_text" class="w-full p-2 border rounded"
                       value="{{ old('choice_2_text') }}">
                <label class="block mt-2 text-sm text-gray-600">ID целевой сцены</label>
                <input type="number" name="choice_2_target_scene_id" class="w-full p-2 border rounded"
                       value="{{ old('choice_2_target_scene_id') }}">
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Сохранить сцену
        </button>
    </form>
</div>
@endsection
