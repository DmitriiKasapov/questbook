@extends('layouts.app')

@section('content')
@php
    $chapters = $story->chapters->sortBy('position');
    $initialChapterKey = request()->get('chapter') ?? $chapters->first()?->key ?? 'new';
@endphp

<div
    x-data="{
        tab: 'main',
        activeChapter: '{{ $initialChapterKey }}'
    }"
    x-init="
        const params = new URLSearchParams(window.location.search);
        if (window.location.hash.startsWith('#chapters')) {
            tab = 'chapters';
        } else if (params.has('chapter')) {
            tab = 'chapters';
        }
        $watch('tab', value => history.replaceState(null, null, '#' + value));
    "
    class="max-w-5xl px-4 py-6 mx-auto"
>
    <h1 class="mb-6 text-2xl font-bold">Редактировать историю</h1>

    <div class="flex gap-4 mb-6 border-b">
        <button @click="tab = 'main'" :class="tab === 'main' ? 'font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-500'">
            Основное
        </button>
        <button @click="tab = 'chapters'" :class="tab === 'chapters' ? 'font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-500'">
            Сюжет
        </button>
    </div>

    <div x-show="tab === 'main'" x-transition>
        @include('admin.stories._form', ['story' => $story])
    </div>

    <div x-show="tab === 'chapters'" x-transition>
        @include('admin.stories.story-chapters', ['story' => $story, 'activeChapterKey' => $initialChapterKey])
    </div>
</div>
@endsection
