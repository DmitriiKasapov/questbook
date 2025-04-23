@if (!empty($title = $block->translatedInput('title')))
<h4 class="">{{ $title }}</h4>
@endif
<div class="">
  <x-video :video="$block->input('yt_id')" class=""/>
</div>

