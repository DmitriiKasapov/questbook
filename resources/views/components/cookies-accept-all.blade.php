{{-- Docs: https://cookieconsent.orestbida.com/ --}}

{{-- Uncomment in layout.app --}}

<div id="cookie-modal" class="w-full py-6 bg-white px-7">
  <div class="mb-5">{{ __('cookies.description') }}</div>
  <div class="flex gap-10">
    <button class="btn" data-cc="accept-all"><span>{{ __('cookies.accept_all') }}</span></button>
  </div>
</div>

{{-- Example for lang file. 'settings_modal' is used in the script below and sets the cookie categories, 'description' and 'ok' is used in the cookies_prompt partial: --}}
{{-- return [
    'description' => 'Glasba je moja strast. Da bi lahko to strast lažje delila s teboj, bi želela, da potrdiš uporabo <a href="#" class="underline cc-link underlined">piškotkov</a>, saj bo na ta način lahko tvoja izkušnja personalizirana. Prosim, potrdi izbiro:',
    'accept_all' => 'Sprejmi vse',
    'accept_necessary' => 'Sprejmi nujne'
    'settings' => 'Nastavitve',
    'modal' => [
        'title' => 'Uporaba piškotkov',
        'save_settings' => 'Shrani',
        'accept_all' => 'Sprejmi vse',
        'reject_all' => 'Zavrni nenujne',
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
                cookieTable => [
                    caption => 'Tabela piškotkov',
                    headers => [
                        name => 'Piškotek',
                        desc => 'Opis'
                    ],
                    body => [
                        [
                            name => '_ga',
                            desc => 'opis 1',
                        ],
                        [
                            name => '_gid',
                            desc => 'opis 2',
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Oglaševalski in ciljni piškotki',
                'description' => 'Ti piškotki zbirajo informacije o tem, kako uporabljate spletno mesto, katere strani ste obiskali in katere povezave ste kliknili. Vsi podatki so anonimizirani in jih ni mogoče uporabiti za identifikacijo',
                linkedCategory: 'ads'  // your cookie category. Keep value in English
            ],
            [
                'title' => 'Več informacij',
                'description' => 'Za kakršna koli vprašanja v zvezi z našo politiko o piškotkih in vašimi odločitvami, <a class="cc-link" href="#yourcontactpage">nam pišite</a>.',
            ]
        ]
    ]
]; --}}


{{-- Uncomment to enable --}}

{{-- <script>
  window.addEventListener('DOMContentLoaded', function(){

    /**
     * All config. options available here:
     * https://cookieconsent.orestbida.com/reference/configuration-reference.html
    */
    CookieConsent.run({

        // root: 'body',
        // autoShow: true,
        // disablePageInteraction: true,
        // hideFromBots: true,
        // mode: 'opt-in',
        // revision: 0,

        cookie: {
            name: 'cc_cookie',
            // domain: location.hostname,
            // path: '/',
            // sameSite: "Lax",
            // expiresAfterDays: 365,
        },

        // https://cookieconsent.orestbida.com/reference/configuration-reference.html#guioptions
        guiOptions: {
            preferencesModal: {
                layout: 'box',
                equalWeightButtons: true,
                flipButtons: false
            }
        },

        onFirstConsent: ({cookie}) => {
            console.log('onFirstConsent fired',cookie);
        },

        onConsent: ({cookie}) => {
            if(CookieConsent.acceptedCategory('analytics')){
                // Analytics category enabled
                // Insert analytics code here
            }

            if(CookieConsent.acceptedService('Google Analytics', 'analytics')){
                // Google Analytics enabled
            }
        },

        onChange: ({changedCategories, changedServices}) => {
            console.log('onChange fired!', changedCategories, changedServices);
        },

        onModalReady: ({modalName}) => {
            console.log('ready:', modalName);
        },

        onModalShow: ({modalName}) => {
            console.log('visible:', modalName);
        },

        onModalHide: ({modalName}) => {
            console.log('hidden:', modalName);
        },

        categories: {
            necessary: {
                enabled: true,  // this category is enabled by default
                readOnly: true  // this category cannot be disabled
            },
            analytics: {
                autoClear: {
                    cookies: [
                        {
                            name: /^_ga/,   // regex: match all cookies starting with '_ga'
                        },
                        {
                            name: '_gid',   // string: exact cookie name
                        }
                    ]
                },

                // https://cookieconsent.orestbida.com/reference/configuration-reference.html#category-services
                services: {
                    ga: {
                        label: 'Google Analytics',
                        onAccept: () => {},
                        onReject: () => {}
                    },
                    youtube: {
                        label: 'Youtube Embed',
                        onAccept: () => {},
                        onReject: () => {}
                    },
                }
            },
            ads: {}
        },

        language: {
            default: 'en',
            translations: {
                en: {
                    consentModal: {
                        title: '',
                        description: '{{ __('cookies.description') }}',
                        acceptAllBtn: '{{ __('cookies.aceept_all') }}',
                        acceptNecessaryBtn: '{{ __('cookies.accept_necessary') }}',
                        showPreferencesBtn: '{{ __('cookies.settings') }}',
                        // closeIconLabel: 'Reject all and close modal',
                        // footer: `
                        //     <a href="#path-to-impressum.html" target="_blank">Impressum</a>
                        //     <a href="#path-to-privacy-policy.html" target="_blank">Privacy Policy</a>
                        // `,
                    },
                    preferencesModal: {
                        title: '{{ __("cookies.modal.title") }}',
                        acceptAllBtn: '{{ __("cookies.modal.accept_all") }}',
                        acceptNecessaryBtn: '{{ __("cookies.modal.reject_all") }}',
                        savePreferencesBtn: '{{ __("cookies.modal.save_settings") }}',
                        closeIconLabel: '{{ __("cookies.modal.close") }}',
                        // serviceCounterLabel: 'Service|Services',
                        sections: {!! json_encode(__("cookies.modal.blocks")) !!}
                    }
                }
            }
        }
    });
  });
</script> --}}
