@props(['id'])

<span aria-live="assertive" id="{{ $id }}-error" class="pl-1 mt-1 text-xs text-red">{{ $slot }}</span>