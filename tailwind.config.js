const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: ["**/*.{html, js, php}", "**/**/*.{html, js, php}", "./index.php"],
  theme: {
    screens: {
      'xs': '361px',
      ...defaultTheme.screens,
    },
    extend: {
      colors: {
        'primary-color': '#0fa'
      }
    },
  },
  plugins: [],
}
