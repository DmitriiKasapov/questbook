@extends('layouts.app')

@section('content')
<div class="max-w-4xl px-4 py-6 mx-auto">

    {{-- Глава --}}
    @if ($chapter)
        @if ($chapter->image)
            <img src="{{ asset('storage/' . $chapter->image) }}" class="w-full mb-6 rounded-xl">
        @endif

        @if ($chapter->content)
            <div class="mb-6 prose">
                {!! $chapter->content !!}
            </div>
        @endif
    @endif

    {{-- Музыка --}}
    @if ($chapter && $chapter->music)
        <audio autoplay loop controls class="mb-4">
            <source src="{{ asset('storage/' . $chapter->music) }}" type="audio/mpeg">
        </audio>
    @endif

    {{-- Сцена --}}
    @if ($scene)
        <div class="p-4 bg-white border rounded shadow">
            <div class="mb-2 text-lg font-semibold">Сцена #{{ $scene->id }}</div>
            <div class="mb-4">{{ $scene->content }}</div>

            @if ($scene->nextScenes()->count())
                <div class="mt-6 space-y-2">
                    @if ($scene->choice_1_text && $scene->choice_1_target_code)
                        @php
                            $target = \App\Models\Scene::findByCode($scene->choice_1_target_code, $scene->story_id);
                        @endphp
                        @if ($target)
                            <a href="{{ route('story.read', ['story' => $story->id, 'scene' => $target->id]) }}"
                            class="block px-4 py-2 text-blue-800 bg-blue-100 rounded hover:bg-blue-200">
                                {{ $scene->choice_1_text }}
                            </a>
                        @endif
                    @endif

                    @if ($scene->choice_2_text && $scene->choice_2_target_code)
                        @php
                            $target = \App\Models\Scene::findByCode($scene->choice_2_target_code, $scene->story_id);
                        @endphp
                        @if ($target)
                            <a href="{{ route('story.read', ['story' => $story->id, 'scene' => $target->id]) }}"
                            class="block px-4 py-2 text-green-800 bg-green-100 rounded hover:bg-green-200">
                                {{ $scene->choice_2_text }}
                            </a>
                        @endif
                    @endif
                </div>
            @else
                <div class="mt-6 text-gray-500">Конец сцены</div>
            @endif
        </div>
    @else
        <div class="text-gray-500">Нет доступных сцен.</div>
    @endif

</div>
@endsection
