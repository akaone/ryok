const { colors } = require('tailwindcss/defaultTheme');

module.exports = {
  theme: {
    colors: {
      ...colors,
      'pyellow': '#FCBC03',
      'pyellow-light': '#F7D675',
      'pyellow-lighter': '#ECF1C9',
      'pgreen': '#2F7283',
      'pindigo': '#1F1E41',
      'pindigo-light': '#2F3845',
      'pindigo-lighter': '#08254B',
      'pblue': '#2367B0',

      'gray-ef': 'rgba(239, 239, 239, 0.94)',
      'gray-77': '#777777',
      'gray-8e': 'hsla(0, 0%, 56%, 0.25)',
      'gray-33': '#333333',
    },
    fontFamily: {
        lato: ['Lato', 'sans-serif'],
        ryok: ['Racing Sans One'],
    },
  },
  variants: {},
  plugins: []
};
