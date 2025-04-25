@props([
  'class' => '',
  'content' => [],
])
<div class="banners_hero banner-hero relative h-max min-h-[720px]  {{ $class }}">
  <div class="max-sm:hidden absolute z-[1] left-0 right-0 w-100% h-[245px] bg-linear-[180deg,#000000,rgba(0,0,0,0)]">

  </div>
  <div class="absolute top-0 bottom-0 left-0 right-0">
    <div class="ing-wrapper h-full w-full">
      <x-picture
        class="w-full h-full object-cover"
        src="{{ $content['img'] }}"
        fb=""
        alt="{{ $content['title'] }}"
        :pictures="[
          [
            'size' => 567.99 ,
            'src' => $content['img'],
            'fb' => '',
          ],
          [
            'size' => 0,
            'src' => $content['imgmin'],
            'fb' =>'',
          ],
        ]"
      />
    </div>
  </div>
  <div class="container-grid relative">
    <div class="content md:content-start-2 md:content-span-7 sm:content-span-8 md:pt-[220px] pt-[164px] md:pb-[360px] pb-[228px]">
      <h1 class="big-title text-shadow-header text-blue mb-6">{{ $content['title'] }}</h1>
      <p class="text-white text-shadow-header mb-6">{{ $content['text'] }}</p>

      <x-button
        link="{{ $content['btn_link'] }}"
        icon="{{ $content['btn_icon'] }}"
        height="h-[52px]"
        >
        {{ $content['btn_text'] }}
      </x-button>

  </div>

</div>