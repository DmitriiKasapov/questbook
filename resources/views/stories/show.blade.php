<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $story->title }}</title>
</head>
<body>
  <a href="{{ route('stories.index') }}">Назад к списку</a>
    <h1>{{ $story->title }}</h1>
    <p class="mb-4">{{ $story->description }}</p>
    <small>Жанр: {{ $story->genre }}</small>
    <br>
    @if ($story->scenes()->exists())
        @php
            $firstScene = $story->scenes()->orderBy('id')->first();
        @endphp

        <a href="{{ route('scenes.show', $firstScene->id) }}">
            <button>Начать историю</button>
        </a>
    @else
        <p>У этой истории ещё нет сцен.</p>
    @endif

</body>
</html>
