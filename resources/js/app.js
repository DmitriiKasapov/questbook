import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

import './bootstrap';
import './main';
import * as CookieConsent from 'vanilla-cookieconsent';
import 'vanilla-cookieconsent/dist/css-components/base.css';
import 'vanilla-cookieconsent/dist/css-components/preferences-modal.css';

window.CookieConsent = CookieConsent
