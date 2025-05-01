@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-2xl font-bold">Истории</h1>

    <a href="{{ route('admin.stories.create') }}" class="inline-block mb-4 text-blue-600">+ Добавить новую</a>

    <ul class="space-y-2">
        @foreach ($stories as $story)
            <li class="p-4 border rounded">
                @if ($story->cover_image)
                    <img src="{{ $story->cover_image }}" alt="cover" class="object-cover w-32 h-32 mb-2 rounded">
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
@endsection
