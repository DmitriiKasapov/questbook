
@extends('layouts.app-main')

@section('title', 'Главная')

@section('content')

    <div class="content">
        <div class="pt-10 pb-20 hero">
            <div class="flex items-center gap-5">
                <div class="img-wrapper h-[400px] w-[37%] flex justify-center">
                    <img class="object-cover h-full" src="{{ asset('images/image.jpg') }}" alt="QuestBook - Potopi se v svet interaktivnih pripovedi">
                </div>
                <div class="hero-info w-[63%]">
                    <h1 class="mb-6 text-3xl font-bold text-center">QuestBook - Potopi se v svet interaktivnih pripovedi</h1>
                    <p>Dobrodošli v <b>QuestBook</b> - platformi, kjer zgodbe niso le za branje, temveč za doživetje. Vsaka zgodba je pustolovščina, v kateri si ti junak.</p>

                    <p>Sprejmi odločitve, izberi svojo pot in odkrij več možnih koncev - od zmagoslavnih zaključkov do nepričakovanih zasukov.</p>

                    <p>Naše interaktivne zgodbe so primerne za radovedne bralce, ljubitelje iger in vse, ki iščejo nekaj drugačnega.</p>

                    <p><b>Začni svojo pot takoj!</b></p>
                </div>
            </div>

        </div>

        <div class="pb-20">
           <h2 class="mb-6 text-3xl font-bold text-center">Izberite zgodbo</h2>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                @foreach ($stories as $story)
                    <x-story-card :story="$story" />
                @endforeach
            </div>
        </div>


    </div>


@endsection
