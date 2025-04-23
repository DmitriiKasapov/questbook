<!DOCTYPE html>

<html lang="{{ locale() }}">

<head>
  @include('includes.meta')
  @include('includes.scripts.top')
</head>

<body class="{{ $class ?? '' }} relative">
  <x-header/>

  <main class="flex-1">
    @yield('content')
    {{ $slot ?? '' }}
  </main>

  <x-footer/>
  @include('includes.scripts.app')
  <x-cookies/>
</body>

</html>
