{{-- Docs: https://cookieconsent.orestbida.com/ --}}
{{-- Uncomment in layout.app --}}

<div id="cookie-modal" class="w-full py-6 bg-white px-7">
  <div class="mb-5">{!! __('cookies.description') !!}</div>
  <div class="flex gap-10">
    <button class="btn" data-cc="accept-all"><span>{{ __('cookies.accept_all') }}</span></button>
    <button class="btn" data-cc="accept-necessary"><span>{{ __('cookies.accept_necessary') }}</span></button>
    <button type="button" data-cc="show-preferencesModal">{{ __('cookies.settings') }}</button>
  </div>
</div>

@include('includes.scripts.cookies', [
  'gtag' => "gtag"
])

{{-- Example for lang file. 'settings_modal' is used in the script below and sets the cookie categories, 'description' and 'ok' is used in the cookies_prompt partial: --}}
{{-- return [
    'description' => 'Glasba je moja strast. Da bi lahko to strast lažje delila s teboj, bi želela, da potrdiš uporabo <a href="#" class="underline cc-link underlined">piškotkov</a>, saj bo na ta način lahko tvoja izkušnja personalizirana. Prosim, potrdi izbiro:',
    'accept_all' => 'Sprejmi vse',
    'accept_necessary' => 'Zavrni nenujne',
    'settings' => 'Nastavitve',
    'modal' => [
        'title' => 'Uporaba piškotkov',
        'save_settings' => 'Shrani',
        'accept_all' => 'Sprejmi vse',
        'accept_necessary' => 'Zavrni nenujne',
        'close' => 'Zapri',
        'sections' => [
            [
                'title' => 'Uporaba piškotkov',
                'description' => 'Glasba je moja strast. Da bi lahko to strast lažje delila s teboj, bi želela, da potrdiš uporabo <a href="#" class="underline cc-link underlined">piškotkov</a>, saj bo na ta način lahko tvoja izkušnja personalizirana.'
            ],
            [
                'title' => 'Nujno potrebni piškotki',
                'description' => 'Ti piškotki so bistveni za pravilno delovanje moje spletne strani. Brez teh piškotkov spletna stran ne bi delovala pravilno',
                'linkedCategory' => 'necessary'  // your cookie category. Keep value in English
            ],
            [
                'title' => 'Analitični piškotki',
                'description' => 'Ti piškotki omogočajo spletnemu mestu, da si zapomni izbire, ki ste jih naredili v preteklosti',
                'linkedCategory' => 'analytics',  // your cookie category. Keep value in English
                'cookieTable' => [
                    'caption' => 'Tabela piškotkov',
                    'headers' => [
                        'name' => 'Piškotek',
                        'desc' => 'Opis'
                    ],
                    'body' => [
                        [
                            'name' => '_ga',
                            'desc' => 'opis 1',
                        ],
                        [
                            'name' => '_gid',
                            'desc' => 'opis 2',
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Oglaševalski in ciljni piškotki',
                'description' => 'Ti piškotki zbirajo informacije o tem, kako uporabljate spletno mesto, katere strani ste obiskali in katere povezave ste kliknili. Vsi podatki so anonimizirani in jih ni mogoče uporabiti za identifikacijo',
                'linkedCategory' => 'ads'  // your cookie category. Keep value in English
            ],
            [
                'title' => 'Več informacij',
                'description' => 'Za kakršna koli vprašanja v zvezi z našo politiko o piškotkih in vašimi odločitvami, <a class="cc-link" href="#yourcontactpage">nam pišite</a>.',
            ]
        ]
    ]
]; --}}
