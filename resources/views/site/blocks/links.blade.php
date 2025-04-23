<div class="flex flex-col gap-3 my-5">
  @foreach ($block->children as $item)
    <a href="{{ $item->translatedInput('link') }}" class="text-primary-dark iconBefore left link-text">
      <span class="c-icon {{ $item->input('icon') }}"></span>
      <span class="underline-c">{{ $item->translatedInput('title') }}</span>
    </a>
  @endforeach
</div>
