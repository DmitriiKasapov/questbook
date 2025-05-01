@extends('layouts.app')

@section('content')
<div class="max-w-5xl px-4 py-6 mx-auto" x-data="{ tab: 'main' }">
    <h1 class="mb-6 text-2xl font-bold">Редактировать историю</h1>

    {{-- Табы --}}
    <div class="flex gap-4 mb-6 border-b">
        <button @click="tab = 'main'" :class="tab === 'main' ? 'font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-500'">
            Основное
        </button>
        <button @click="tab = 'branches'" :class="tab === 'branches' ? 'font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-500'">
            Сюжет
        </button>
    </div>

    {{-- Основное --}}
    <div x-show="tab === 'main'" x-transition>
        @include('admin.stories._form', ['story' => $story])
    </div>

    {{-- Сюжет (ветки + сцены) --}}
    <div x-show="tab === 'branches'" x-transition>
        {{-- Добавить ветку --}}
        <div class="mb-6">
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
                            <div class="text-[10px] text-gray-400">
                                branch_id: {{ $scene->branch_id }} {{-- debug --}}
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

                {{-- Добавить сцену --}}
                <a href="{{ route('admin.scenes.create', ['story_id' => $story->id, 'branch_id' => $branch->id]) }}"
                   class="inline-block mt-2 text-xs text-blue-600 hover:underline">
                    + Добавить сцену
                </a>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
