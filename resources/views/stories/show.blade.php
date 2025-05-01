@extends('layouts.app-main')

@section('title', $story->title)

@section('content')
<div class="content">
    <div class="max-w-3xl px-4 py-8 mx-auto">
        <a href="{{ route('stories.index') }}" class="inline-block mb-4 text-sm text-blue-500 hover:underline">
            ← Назад к списку
        </a>

        {{-- Заголовок --}}
        <h1 class="mb-4 text-3xl font-bold text-gray-800">{{ $story->title }}</h1>

        {{-- Обложка (если есть) --}}
        @if ($story->cover_image)
        <div class="block-center">
            <div class="img-wrapper max-w-[450px]">
                <img src="{{ asset('storage/' . $story->cover_image) }}"
                    alt="Обложка истории"
                    class="object-cover w-full mb-6 rounded-lg shadow">
            </div>
        </div>


        @endif

        {{-- Описание --}}
        <p class="mb-4 text-lg leading-relaxed text-gray-700">
            {{ $story->description }}
        </p>

        {{-- Жанр --}}
        <div class="mb-6 text-sm text-gray-500">Жанр: {{ $story->genre }}</div>

        {{-- Кнопка "Начать историю" --}}
        @if ($story->scenes()->exists())
            @php
                $firstScene = $story->scenes()->where('type', 'main')->orderBy('id')->first();
            @endphp

            <a href="{{ route('scenes.show', $firstScene->id) }}"
               class="inline-block px-6 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">
                Начать историю
            </a>
        @else
            <p class="text-sm text-red-500">У этой истории ещё нет сцен.</p>
        @endif
    </div>
</div>

@endsection
