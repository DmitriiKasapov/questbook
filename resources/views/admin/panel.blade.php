@extends('layouts.app')

@section('content')
<div class="content">
        <h1 class="mb-4 text-2xl font-bold">Админ-панель</h1>

    <div x-data="{ tab: 'stories' }">
        <nav class="mb-4 space-x-4">
            <button @click="tab = 'stories'" :class="tab === 'stories' ? 'font-bold underline' : ''">Истории</button>
            <button @click="tab = 'scenes'" :class="tab === 'scenes' ? 'font-bold underline' : ''">Сцены</button>
        </nav>

        {{-- Таб Истории --}}
        <div x-show="tab === 'stories'">
            <h1 class="mb-4 text-2xl font-bold">Истории</h1>

            <a href="{{ route('admin.stories.create') }}" class="inline-block mb-4 text-blue-600">+ Добавить новую</a>

            <ul class="space-y-2">
                @foreach ($stories as $story)
                    <li class="p-4 border rounded">
                        @if ($story->cover_image)
                        <div class="img-wrapper max-w-[300px]">
                            @if ($story->cover_url)
                                <img src="{{ $story->cover_url }}" alt="cover">
                            @endif
                        </div>

                        @endif
                        <div class="text-lg font-semibold">{{ $story->title }}</div>
                        <div class="text-sm text-gray-600">{{ $story->genre }}</div>
                        <a href="{{ route('admin.stories.edit', $story) }}" class="text-sm text-blue-600">Редактировать</a>
                        <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600" onclick="return confirm('Удалить эту историю?')">
                                Удалить
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Таб Сцены --}}
        <div x-show="tab === 'scenes'" x-data="{ selectedType: '' }">
        <a href="{{ route('admin.scenes.create') }}" class="text-blue-600">+ Добавить сцену</a>

        <div class="mt-4 mb-2">
            <label>Фильтр по типу:</label>
            <select x-model="selectedType" class="p-1 border">
                <option value="">— все типы —</option>
                <option value="main">Основная</option>
                <option value="branch">Ветка</option>
                <option value="ending">Финал</option>
            </select>
        </div>

        <ul class="space-y-2">
            @foreach ($scenes as $scene)
                <li x-show="!selectedType || '{{ $scene->type }}' === selectedType" class="p-3 border rounded">
                    <div class="font-semibold">
                        Сцена #{{ $scene->id }} [{{ $scene->type }}] — {{ $scene->story->title ?? '—' }}
                    </div>
                    <div class="text-sm">{{ Str::limit($scene->content, 100) }}</div>
                    <div class="mt-1 text-sm">
                        Выборы:
                        <br>1 → {{ $scene->choice_1_target_scene_id }}
                        <br>2 → {{ $scene->choice_2_target_scene_id }}
                    </div>
                    <a href="{{ route('admin.scenes.edit', $scene) }}" class="text-sm text-blue-600">Редактировать</a>
                </li>
            @endforeach
        </ul>
    </div>
    </div>
</div>

@endsection
