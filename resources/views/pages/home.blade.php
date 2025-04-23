@extends('components.layouts.app')

@section('content')

<div class="container-grid">
  <div class="content">
    <x-picture
      :src="Vite::img('favicon.webp')"
      :fb="Vite::img('favicon.png')"
      alt="alt text"
    />
    <h1>Hello Dimitrii!</h1>
  </div>
</div>

@stop
