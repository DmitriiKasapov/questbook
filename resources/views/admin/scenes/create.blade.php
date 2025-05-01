@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-2xl font-bold">Добавить сцену</h1>

    <form action="{{ route('admin.scenes.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">История</label>
            <select name="story_id" class="w-full p-2 border" required>
                @foreach ($stories as $story)
                    <option value="{{ $story->id }}">{{ $story->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Тип</label>
            <input type="text" name="type" value="{{ old('type', $scene->type ?? '') }}" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Текст сцены</label>
            <textarea name="content" class="w-full p-2 border" rows="4"></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 1 (текст)</label>
            <input type="text" name="choice_1_text" class="w-full p-2 border">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 1 → ID сцены</label>
            <select name="choice_1_target_scene_id" class="w-full p-2 border">
                <option value="">— Выберите сцену —</option>
                @foreach ($allScenes as $existingScene)
                    <option value="{{ $existingScene->id }}">
                        [ID {{ $existingScene->id }}] {{ Str::limit($existingScene->content, 30) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 2 (текст)</label>
            <input type="text" name="choice_2_text" class="w-full p-2 border">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 2 → ID сцены</label>
            <select name="choice_1_target_scene_id" class="w-full p-2 border">
                <option value="">— Выберите сцену —</option>
                @foreach ($allScenes as $existingScene)
                    <option value="{{ $existingScene->id }}">
                        [ID {{ $existingScene->id }}] {{ Str::limit($existingScene->content, 30) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Сохранить</button>
    </form>
@endsection
