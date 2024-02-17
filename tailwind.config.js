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
      sans: ['DM Sans', 'sans-serif'],
      'montserrat': ['Montserrat', 'sans-serif']
    },
    extend: {
      container: {
        center: true,
        padding: '0',
        screens: {
          xs: '419px',
          md: '640px',
          lg: '1211px',
        },
      },
    },
  },
  plugins: [],
}

