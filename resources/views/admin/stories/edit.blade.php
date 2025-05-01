@extends('layouts.app')

@section('content')
<div class="content" x-data="{ tab: location.hash === '#scenes' ? 'scenes' : 'main' }">
    <h1 class="mb-4 text-2xl font-bold">Uredi zgodbo: {{ $story->title }}</h1>

    {{-- Navigacija zavihkov --}}
    <div class="flex gap-4 mb-6 border-b">
        <button @click="tab = 'main'" :class="tab === 'main' ? 'font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-500'">
            Основное
        </button>
        <button @click="tab = 'scenes'" :class="tab === 'scenes' ? 'font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-500'">
            Сцены
        </button>
        <button @click="tab = 'branches'" :class="tab === 'branches' ? 'font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-500'">
            Сюжет
        </button>
    </div>

    {{-- Zavihek: Osnovno --}}
    <div x-show="tab === 'main'" x-transition>
        @include('admin.stories._form', ['story' => $story])
    </div>

    {{-- Таб "Сцены" --}}
    <div x-show="tab === 'scenes'" x-transition>
        <div class="mb-4">
            <a href="{{ route('admin.scenes.create', ['story_id' => $story->id]) }}"
            class="inline-block px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                + Добавить сцену
            </a>
        </div>

        {{-- Список сцен --}}
        @if ($story->scenes->count())
            <ul class="space-y-2">
                @foreach ($story->scenes as $scene)
                    <li class="p-3 bg-white border rounded">
                        <div class="text-sm font-semibold text-gray-700">
                            #{{ $scene->id }} [{{ $scene->type }}] – {{ Str::limit($scene->content, 80) }}
                        </div>
                        <div class="mb-2 text-xs text-gray-500">
                            1 → {{ $scene->choice_1_target_scene_id }} |
                            2 → {{ $scene->choice_2_target_scene_id }}
                        </div>
                        <div class="flex gap-3 text-sm">
                            <a href="{{ route('admin.scenes.edit', $scene) }}" class="text-blue-600 hover:underline">Редактировать</a>
                            <form action="{{ route('admin.scenes.destroy', $scene) }}" method="POST"
                                onsubmit="return confirm('Удалить эту сцену?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Удалить</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="text-sm text-gray-500">Нет сцен для этой истории.</div>
        @endif
    </div>
    {{-- Таб: Сюжет --}}
    <div x-show="tab === 'branches'" x-transition>
        {{-- Форма добавления новой ветки --}}
        <div class="mb-4">
            <form action="{{ route('admin.branches.store') }}" method="POST" class="flex items-end gap-2">
                @csrf
                <input type="hidden" name="story_id" value="{{ $story->id }}">
                <div>
                    <label class="block mb-1 text-sm">Название ветки</label>
                    <input type="text" name="title" class="p-2 border rounded" placeholder="Новая ветка" required>
                </div>
                <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Добавить</button>
            </form>
        </div>

        {{-- Канбан-сетка --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($story->branches as $branch)
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

                    {{-- Сцены этой ветки --}}
                    <div class="mb-2 space-y-2">
                        @foreach ($branch->scenes as $scene)
                            <div class="p-2 text-sm bg-white border rounded shadow-sm">
                                #{{ $scene->id }} [{{ $scene->type }}]
                                <div class="text-xs text-gray-500">
                                    {{ Str::limit($scene->content, 60) }}
                                </div>
                                <div class="flex gap-2 mt-1">
                                    <a href="{{ route('admin.scenes.edit', $scene) }}" class="text-xs text-blue-600 hover:underline">Редактировать</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Кнопка добавить сцену --}}
                    <a href="{{ route('admin.scenes.create', ['story_id' => $story->id, 'branch_id' => $branch->id]) }}"
                    class="inline-block mt-auto text-xs text-blue-600 hover:underline">
                        + Добавить сцену
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
