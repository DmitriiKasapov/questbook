
@extends('layouts.app-main')

@section('title', 'Главная')

@section('content')

    <div class="content">

        <h1 class="mb-6 text-3xl font-bold text-center">Выбери историю</h1>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($stories as $story)
                <x-story-card :story="$story" />
            @endforeach
        </div>

    </div>


@endsection
