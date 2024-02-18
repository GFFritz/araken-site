/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    '*.{html,js,php}',
    './painel/**/*.{html,js,php}',
    './painel/*.{html,js,php}',
    './src/**/*.{html,js,php}'
  ],
  theme: {
    fontFamily: {
      sans: ['Segoe Ui', 'sans-serif']
    },
    extend: {
      container: {
        center: true,
        padding: '0',
        screens: {
          xs: '419px',
          md: '419px',
          lg: '419px',
          xl: '419px',
          '2xl': '419px',
          '3xl': '419px'
        },
      },
      colors: {
        primary: '#1B3A68',
        'primary-alt': '#1c4c8c'
      },
      boxShadow: {
        'button': '0px 3px 3px 0px #00000029',
      }
    },
  },
  plugins: [],
}

