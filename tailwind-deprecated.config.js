/** @type {import('tailwindcss').Config} */

import defaultTheme from "tailwindcss/defaultTheme";
import plugin from "tailwindcss/plugin";

/* Extends grid-cols with auto-fills and auto-fits */
let gridAutoFills = {};
let i = 5;
while (i <= 75) {
  gridAutoFills[`auto-fill-${i * 10}`] = `repeat(auto-fill, minmax(${
    i * 10
  }px, 1fr))`;
  gridAutoFills[`auto-fit-${i * 10}`] = `repeat(auto-fit, minmax(${
    i * 10
  }px, 1fr))`;

  i += 1;
}

/* Helpers for custom grid container */
let containerGridHelpers = {};
for(let i = 1; i <= 12; i++) {
  containerGridHelpers[`.content-start-${i}`] = {
    gridColumnStart: `content-start ${i}`
  };
  containerGridHelpers[`.content-gap-${i}`] = {
    gridColumnStart: `content-gap ${i}`
  };
  containerGridHelpers[`.content-span-${i}`] = {
    gridColumnEnd: `span ${i} content-gap`
  }
  containerGridHelpers[`.content-span-gap-${i}`] = {
    gridColumnEnd: `span ${i} content-start`
  }
}

/* container paddings */
const containerPaddings = {
  zero: '12px',
  xxs: '18px',
  sm: '32px',
  md: '46px',
  lg: '50px',
  xl: '70px',
  '2xl': '70px',
  '3xl': '70px'
}

export default {
  content: require("fast-glob").sync([
    './resources/js/*.js',
    './resources/js/**/*.js',
    './resources/views/*.php',
    './resources/views/**/*.php',
    './resources/views/**/**/*.php',
    './resources/views/**/**/**/*.php',
    './lang/**/*.php',
  ]),
  theme: {
    screens: {
      zero: "0px",
      xxs: "375px",
      sm: "576px",
      md: "768px",
      lg: "912px",
      xl: "1024px",
      "2xl": "1280px",
      "3xl": "1536px",
    },
    fontFamily: {
      sans: [
        ["MyriadPro", ...defaultTheme.fontFamily.sans],
        {
          fontVariationSettings: '"wght" 400',
        },
      ],
      /* italic: [
        ["Poppins-Italic", ...defaultTheme.fontFamily.sans],
        {
          fontVariationSettings: '"ital" 1',
        },
      ],
      medium: [
        ["Poppins-Medium", ...defaultTheme.fontFamily.sans],
        {
          fontVariationSettings: '"wght" 500',
        },
      ],
      semibold: [
        ["Poppins-SemiBold", ...defaultTheme.fontFamily.sans],
        {
          fontVariationSettings: '"wght" 600',
        },
      ],
      bold: [
        ["Poppins-Bold", ...defaultTheme.fontFamily.sans],
        {
          fontVariationSettings: '"wght" 700',
        },
      ] */
    },
    extend: {
      fontSize: {
        '2xs': [
          '0.6875rem', {
            lineHeight: '0.875rem'
          }
        ]
      },
      colors: {
        // Change as needed
        transparent: "transparent",
        current: "currentColor",
        white: "#FFFFFF",
        basic: {
          100: "#F3F3F3",
          200: "#E5E5E2",
          300: "#B3B3B3",
          400: "#999999",
          500: "#898C8E",
          600: "#666666",
          700: "#4D4D4F",
          800: "#333333",
          900: "#4D4D4F"
        },
        primary: {
          DEFAULT: "#FF2427"
        },
        gold: "#857550",
        danger: "#FF2427",
        warning: "#DA8D00",
        success: "#3EAA19",
        info: "#107BBA",
        beige: "#F6F5F0",
        gray: "#686868",
        blue: "#3CB4E7",
        turquoise: "#00B1AA",
        violet: "#9A258F",
        pink: "#EC008C"
      },
      boxShadow: {
        light: '0px 4px 16px 0px rgba(0, 0, 0, 0.08)',
        small: '0px 4px 16px 0px rgba(0, 0, 0, 0.16)',
        medium: '0px 8px 24px 0px rgba(0, 0, 0, 0.16)'
      },
      gridTemplateColumns: gridAutoFills,
    },
  },
  plugins: [
    plugin(function({ addBase, addComponents, addUtilities, theme }) {
      let paddingsVar = {}
      for(let screenSize in containerPaddings) {
        paddingsVar[`@media (min-width: ${theme('screens.' + screenSize )})`] = {
          ':root': {
            '--padding-px': containerPaddings[screenSize]
          }
        }
      }
      addBase({
        ':root': {
          '--container-max-width': '1320px',
          '--gap': '0.5rem',
          '--vh': '1vh',
          [`@media (min-width: ${theme('screens.md' )})`]: {
            '--gap': '1.5rem'
          },

          [`@media (min-width: ${theme('screens.xl' )})`]: {
            '--gap': '2rem'
          }
        },
        ...paddingsVar
      })
      addComponents({
        // Examples
        /* '.btn': {
          padding: '9px 18px',
          borderRadius: '46px',
          fontFamily: 'RobotoCondensed-Bold',
          display: 'inline-flex',
          justifyContent: 'center',
          gap: '10px',
          transition: 'all 0.3s ease-in-out',
          overflow: 'hidden',
        },
        '.btn-blue': {
          backgroundColor: theme("colors.link.DEFAULT"),
          color: theme("colors.white"),
        }, */
      })
      addUtilities({
        '.animated-underline': {
          backgroundImage: 'linear-gradient(theme("colors.transparent"), theme("colors.transparent")), linear-gradient(theme("colors.current"), theme("colors.current"))',
          backgroundSize: '100% 0.1em, 0 0.1em',
          backgroundPosition: '100% calc(100% - 1px), 0 calc(100% - 1px)',
          backgroundRepeat: 'no-repeat',
          transition: 'background-size 0.4s 0.1s ease-out',
          '&.reverse': {
            backgroundPosition: '0% 100%, 100% 100%'
          }
        },
        '.flex-full': {
          flex: '0 1 100%'
        },

        /* Custom container based on a grid layout */
        '.container-grid': {
          '--max': 'calc((var(--container-max-width) - (var(--gap) * 11)) / 12)',
          display: 'grid',
          gridTemplateColumns:
            `minmax(0, 1fr)
            [outer-start]
            var(--padding-px)
            repeat(5, [content-start] minmax(0, var(--max)) [content-gap] var(--gap))
            [content-start]
            minmax(0, var(--max))
            [content-gap]
            calc(var(--gap) / 2)
            [half]
            calc(var(--gap) / 2)
            repeat(5, [content-start] minmax(0, var(--max)) [content-gap] var(--gap))
            [content-start] minmax(0, var(--max))
            [content-gap content-end]
            var(--padding-px)
            [outer-end]
            minmax(0, 1fr)`,
          gridAutoRows: 'auto',
          width: '100%'
        },

        /* Container grid helpers */
        '.full': {
          gridColumn: '1 / -1'
        },
        '.outer': {
          gridColumn: 'outer'
        },
        '.half-end': {
          gridColumnEnd: 'half'
        },
        '.half-start': {
          gridColumnStart: 'half'
        },
        '.content': {
          gridColumn: 'content'
        },
        '.column-start-half': {
          gridColumnStart: 'half'
        },
        ...containerGridHelpers,
      })
    })
  ],
};
