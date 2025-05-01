@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-2xl font-bold">Сцены</h1>

    <a href="{{ route('admin.scenes.create') }}" class="inline-block mb-4 text-blue-600">+ Добавить сцену</a>
    <form method="GET" action="{{ route('admin.scenes.index') }}" class="mb-4">
        <label class="mr-2">Фильтр по типу:</label>
        <select name="type" onchange="this.form.submit()" class="p-1 border rounded">
            <option value="">Все</option>
            @foreach ($availableTypes as $type)
                <option value="{{ $type }}" @selected(request('type') == $type)>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </form>

    <ul class="space-y-2">
        @foreach ($scenes as $scene)
            <li class="p-4 border rounded">
                <div class="text-sm text-gray-500">ID: {{ $scene->id }}</div>
                <div class="font-semibold">История: {{ $scene->story->title ?? '—' }}</div>
                <div class="text-sm text-gray-600">Тип: {{ $scene->type }}</div>
                <div class="mt-2">{{ \Illuminate\Support\Str::limit($scene->content, 100) }}</div>

                <a href="{{ route('admin.scenes.edit', $scene) }}" class="text-sm text-blue-600">Редактировать</a>
                <form action="{{ route('admin.scenes.destroy', $scene) }}" method="POST" class="inline-block ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600" onclick="return confirm('Удалить эту сцену?')">
                        Удалить
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
