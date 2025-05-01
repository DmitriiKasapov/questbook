@extends('components.layouts.app')

@section('content')

<div class="container-grid">
  <div class="content">
    123
  </div>
</div>

@stop
{{-- @extends('layouts.app')

@section('content')
<h1>Список историй</h1>

@if($stories->count())
    <ul>
      @foreach($stories as $story)
        <li>
            <h2>{{ $story->title }}</h2>
            <p>{{ $story->description }}</p>
            <small>Жанр: {{ $story->genre }}</small>
            <br>
            <a href="{{ route('stories.show', $story) }}">Читать историю</a>
        </li>
    @endforeach
    </ul>
@else
    <p>Историй пока нет.</p>
@endif
@endsection --}}
