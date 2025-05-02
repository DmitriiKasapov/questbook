@extends('layouts.app')

@section('content')
<div class="max-w-3xl p-6 mx-auto bg-white rounded shadow content">
    <a href="{{ route('admin.stories.edit', $story) }}#chapters"
       class="inline-block mb-4 text-sm text-blue-600 hover:underline">
        ← Назад к сюжету
    </a>

    <h1 class="mb-4 text-2xl font-bold">Добавить сцену</h1>

    <form action="{{ route('admin.scenes.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Скрытые поля истории и ветки --}}
        <input type="hidden" name="story_id" value="{{ $story->id }}">
        <input type="hidden" name="branch_id" value="{{ $branch->id }}">
        <input type="hidden" name="chapter_key" value="{{ $branch->chapter_key }}">
        <input type="hidden" name="branch" value="{{ $branch->title }}">

        {{-- Информация о привязке --}}
        <div class="text-sm text-gray-500">
            История: <strong>{{ $story->title }}</strong> |
            Глава: <strong>{{ $branch->chapter_key }}</strong> |
            Ветка: <strong>{{ $branch->title }}</strong>
        </div>

        {{-- Номер сцены --}}
        <div>
            <label class="block mb-1 font-semibold">Номер сцены в ветке</label>
            <input type="number" name="number" value="{{ old('number') }}" class="w-full p-2 border rounded" required>
        </div>

        {{-- Текст сцены --}}
        <div>
            <label class="block mb-1 font-semibold">Текст сцены</label>
            <textarea name="content" class="w-full p-2 border rounded" required>{{ old('content') }}</textarea>
        </div>

        {{-- Выборы перехода --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 font-semibold">Выбор 1</label>
                <input type="text" name="choice_1_text" value="{{ old('choice_1_text') }}" class="w-full p-2 border rounded">

                <div class="mt-2 text-sm text-gray-600">Целевая сцена (глава, ветка, номер)</div>
                <div class="flex gap-2 mt-1">
                    <select name="choice_1_target_chapter" class="p-2 border rounded">
                        <option value="">Глава</option>
                        @foreach($story->chapters as $ch)
                            <option value="{{ $ch->key }}" @selected(old('choice_1_target_chapter') == $ch->key)>
                                {{ $ch->title }}
                            </option>
                        @endforeach
                    </select>

                    <select name="choice_1_target_branch" class="p-2 border rounded">
                        <option value="">Ветка</option>
                        @foreach($story->branches as $br)
                            <option value="{{ $br->title }}" @selected(old('choice_1_target_branch') == $br->title)>
                                {{ $br->title }}
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="choice_1_target_number" value="{{ old('choice_1_target_number') }}"
                           class="w-16 p-2 border rounded" placeholder="№">
                </div>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Выбор 2</label>
                <input type="text" name="choice_2_text" value="{{ old('choice_2_text') }}" class="w-full p-2 border rounded">

                <div class="mt-2 text-sm text-gray-600">Целевая сцена (глава, ветка, номер)</div>
                <div class="flex gap-2 mt-1">
                    <select name="choice_2_target_chapter" class="p-2 border rounded">
                        <option value="">Глава</option>
                        @foreach($story->chapters as $ch)
                            <option value="{{ $ch->key }}" @selected(old('choice_2_target_chapter') == $ch->key)>
                                {{ $ch->title }}
                            </option>
                        @endforeach
                    </select>

                    <select name="choice_2_target_branch" class="p-2 border rounded">
                        <option value="">Ветка</option>
                        @foreach($story->branches as $br)
                            <option value="{{ $br->title }}" @selected(old('choice_2_target_branch') == $br->title)>
                                {{ $br->title }}
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="choice_2_target_number" value="{{ old('choice_2_target_number') }}"
                           class="w-16 p-2 border rounded" placeholder="№">
                </div>
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Сохранить сцену
        </button>
    </form>
</div>
@endsection
