@extends('layouts.app')

@section('content')
<a href="{{ route('admin.scenes.index') }}" class="inline-block mb-4 text-blue-600 hover:underline">
    ← Назад ко всем сценам
</a>
<h1 class="mb-4 text-2xl font-bold">Редактировать сцену (ID: {{ $scene->id }})</h1>

    <form action="{{ route('admin.scenes.update', $scene) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">История</label>
            <select name="story_id" class="w-full p-2 border" required>
                @foreach ($stories as $story)
                    <option value="{{ $story->id }}" @selected($scene->story_id == $story->id)>
                        {{ $story->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Тип</label>
            <input type="text" name="type" value="{{ old('type', $scene->type ?? '') }}" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Текст сцены</label>
            <textarea name="content" class="w-full p-2 border" rows="4">{{ $scene->content }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 1 (текст)</label>
            <input type="text" name="choice_1_text" class="w-full p-2 border" value="{{ $scene->choice_1_text }}">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 1 → ID сцены</label>
            <input type="number" name="choice_1_target_scene_id" class="w-full p-2 border" value="{{ $scene->choice_1_target_scene_id }}">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 2 (текст)</label>
            <input type="text" name="choice_2_text" class="w-full p-2 border" value="{{ $scene->choice_2_text }}">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Выбор 2 → ID сцены</label>
            <input type="number" name="choice_2_target_scene_id" class="w-full p-2 border" value="{{ $scene->choice_2_target_scene_id }}">
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Сохранить</button>
    </form>
    <form action="{{ route('admin.scenes.destroy', $scene) }}" method="POST" class="mt-8">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded" onclick="return confirm('Удалить эту сцену?')">
            Удалить сцену
        </button>
    </form>
@endsection
