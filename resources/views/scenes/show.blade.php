<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Scena</title>
</head>
<body>

    <h1>Scena</h1>

    <p>{{ $scene->content }}</p>

    @if ($scene->type === 'ending')
        {{-- Финальная сцена --}}
        <p><em>Конец истории.</em></p>

        <a href="{{ route('stories.index') }}">
            <button>Вернуться к историям</button>
        </a>
    @else
        {{-- Обычные выборы --}}
        @if ($scene->choice1Target)
            <a href="{{ route('scenes.show', $scene->choice1Target) }}">
                <button>{{ $scene->choice_1_text ?? 'Выбор 1' }}</button>
            </a>
        @endif

        @if ($scene->choice2Target)
            <a href="{{ route('scenes.show', $scene->choice2Target) }}">
                <button>{{ $scene->choice_2_text ?? 'Выбор 2' }}</button>
            </a>
        @endif
    @endif

    {{-- <br><br>
    <a href="{{ url()->previous() }}">← Nazaj</a> --}}

</body>
</html>
