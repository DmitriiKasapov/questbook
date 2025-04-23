<meta charset="utf-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- favicon --}}
<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
<link rel="manifest" href="/favicon/site.webmanifest">
<link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#ef3b2d">
<link rel="shortcut icon" href="/favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#ef3b2d">
<meta name="msapplication-config" content="/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

{{-- custom meta --}}
@php
if (empty($meta['title'])) {
  $meta['title'] =  __('meta.title');
} else {
  $meta['title'] =  $meta['title'] . ' - ' . __('meta.title');
}
$meta['title'] = $meta['title'] ?? __('meta.title');
$meta['desc'] = $meta['desc'] ?? __('meta.desc');
$meta['keywords'] = $meta['keywords'] ?? __('meta.keywords');
$meta['img'] = $meta['img'] ?? (config('app.url') . Vite::img('favicon.png'));
@endphp

<title>{{ $meta['title'] }}</title>

{{-- title --}}
<meta name="title" content="{{ $meta['title'] }}">
<meta property="og:title" content="{{ $meta['title'] }}">
<meta property="twitter:title" content="{{ $meta['title'] }}">

{{-- desc --}}
<meta name="keywords" content="{{ $meta['keywords'] }}">
<meta name="description" content="{{ $meta['desc'] }}">
<meta property="og:description" content="{{ $meta['desc'] }}">
<meta property="twitter:description" content="{{ $meta['desc'] }}">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:card" content="summary_large_image">

{{-- image --}}
<meta property="og:image" content="{{ $meta['img'] }}">
<meta property="twitter:image" content="{{ $meta['img'] }}">

<link rel="canonical" href="{{ url()->current() }}" />
