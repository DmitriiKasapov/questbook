@extends('components.layouts.app')

@section('content')

<div class="container-grid">
  <div class="content">
    <x-picture
      :src="Vite::img('favicon.webp')"
      :fb="Vite::img('favicon.png')"
      alt="alt text"
    />
    <div class="font-mbold">Hello Dimitrii!</div>
    <span class="icon-user_home text-blue"></span>
  </div>
</div>

@stop
