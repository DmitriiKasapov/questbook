@extends('layouts.app')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-2xl font-bold">Админ-панель: Истории</h1>

    <a href="{{ route('admin.stories.create') }}"
       class="inline-block mb-6 text-sm text-blue-600 hover:underline">
        + Добавить новую
    </a>

    {{-- Сетка карточек --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
        @foreach ($stories as $story)
            <div class="flex flex-col p-4 bg-white shadow rounded-xl">
                {{-- Обложка --}}
                @if ($story->cover_url)
                <div class="img-wrapper aspect-[4/5] flex justify-center items-center">
                    <img src="{{ $story->cover_url }}"
                         alt="cover"
                    class="object-cover w-full">
                </div>

                @endif

                {{-- Название и жанр --}}
                <h2 class="mb-1 text-lg font-semibold text-gray-800">{{ $story->title }}</h2>
                <div class="mb-2 text-sm text-gray-500">{{ $story->genre }}</div>

                {{-- Кнопки --}}
                <div class="flex gap-3 mt-auto">
                    <a href="{{ route('admin.stories.edit', $story) }}"
                       class="text-sm text-blue-600 hover:underline">Редактировать</a>

                    <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" onsubmit="return confirm('Удалить эту историю?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-sm text-red-500 hover:underline">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

