{{-- <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtag }}"></script>  --}}
<script defer>
window.dataLayer = window.dataLayer || [];
function gtag(){ dataLayer.push(arguments); }
gtag('consent', 'default', {
  'ad_storage': 'denied',
  'ad_user_data': 'denied',
  'ad_personalization': 'denied',
  'analytics_storage': 'denied'
});
gtag('js', new Date());
gtag('config', {{ $gtag ?? '' }});
window.addEventListener('livewire:navigated', function () {
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
      name: "cc_cookie",
      // domain: location.hostname,
      // path: '/',
      // sameSite: "Lax",
      // expiresAfterDays: 365,
    },

    // https://cookieconsent.orestbida.com/reference/configuration-reference.html#guioptions
    guiOptions: {
      preferencesModal: {
        layout: "box",
        equalWeightButtons: false,
        flipButtons: false,
      },
    },

    onFirstConsent: ({ cookie }) => {
      console.log("onFirstConsent fired", cookie);
    },

    onConsent: ({ cookie }) => {
      if (CookieConsent.acceptedCategory("analytics")) {
        gtag('consent', 'update', {
          'analytics_storage': 'granted'
        });
      }

      if (CookieConsent.acceptedCategory('marketing')) {
        gtag('consent', 'update', {
          'ad_storage': 'granted',
          'ad_user_data': 'granted',
          'ad_personalization': 'granted'
        });
        gtag('event', 'ad_storage_true');
      }
    },

    onChange: ({ changedCategories, changedServices }) => {
      if (CookieConsent.acceptedCategory('analytics')) {
        gtag('consent', 'update', {
          'analytics_storage': 'granted'
        });
      } else {
        gtag('consent', 'update', {
          'analytics_storage': 'denied'
        });
      }

      if (CookieConsent.acceptedCategory('ads')) {
        gtag('consent', 'update', {
          'ad_storage': 'granted',
          'ad_user_data': 'granted',
          'ad_personalization': 'granted'
        });
        gtag('event', 'ad_storage_true');
      } else {
        gtag('consent', 'update', {
          'ad_storage': 'denied',
          'ad_user_data': 'denied',
          'ad_personalization': 'denied'
        });
      }
    },

    /* onModalReady: ({ modalName }) => {
      console.log("ready:", modalName);
    },

    onModalShow: ({ modalName }) => {
      console.log("visible:", modalName);
    },

    onModalHide: ({ modalName }) => {
      console.log("hidden:", modalName);
    }, */

    categories: {
      necessary: {
        enabled: true, // this category is enabled by default
        readOnly: true, // this category cannot be disabled
      },
      analytics: {
        autoClear: {
          cookies: [
            {
              name: /^_ga/, // regex: match all cookies starting with '_ga'
            },
            {
              name: "_gid", // string: exact cookie name
            },
          ],
        },

        // https://cookieconsent.orestbida.com/reference/configuration-reference.html#category-services
        /* services: {
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
                } */
      },
      marketing: {},
    },

    language: {
      default: "en",
      translations: {
        en: {
          consentModal: {
            title: "",
            description: '{{ __("cookies.description") }}',
            acceptAllBtn: '{{ __("cookies.accept_all") }}',
            acceptNecessaryBtn: '{{ __("cookies.accept_necessary") }}',
            showPreferencesBtn: '{{ __("cookies.settings") }}',
            // closeIconLabel: 'Reject all and close modal',
            // footer: `
            //     <a href="#path-to-impressum.html" target="_blank">Impressum</a>
            //     <a href="#path-to-privacy-policy.html" target="_blank">Privacy Policy</a>
            // `,
          },
          preferencesModal: {
            title: '{{ __("cookies.modal.title") }}',
            acceptAllBtn: '{{ __("cookies.modal.accept_all") }}',
            acceptNecessaryBtn: '{{ __("cookies.modal.accept_necessary") }}',
            savePreferencesBtn: '{{ __("cookies.modal.save_settings") }}',
            closeIconLabel: '{{ __("cookies.modal.close") }}',
            // serviceCounterLabel: 'Service|Services',
            sections: {!! json_encode(__("cookies.modal.sections")) !!}
          },
        },
      },
    },
  });
});
</script>
