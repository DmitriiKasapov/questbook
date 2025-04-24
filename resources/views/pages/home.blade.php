<?php
$heroBanner = [
  'img' => Vite::asset('resources/images/banner-home.jpg'),
  'imgmin' => Vite::asset('resources/images/banner-home-min.jpg'),
  'title' => 'Tehnologija  je v središču vsega, kar počnemo.',
  'text' => 'Digitalna preobrazba je neprekinjeno potovanje. Ni treba, da ste na tej poti sami. Povezani skupaj presezimo vaše največje izzive. Prepustite nam, da vam pokažemo popolno pot za vaše podjetje.',
  'btn_link' => '#',
  'btn_text' => 'RAZIŠČITE VEČ',
  'btn_icon' => 'icon-arrow_R',
];
?>
@extends('components.layouts.app')

@section('content')

<x-banners.hero :content="$heroBanner" />

<div class="container-grid">
  <div class="content">

  </div>
</div>

@stop
