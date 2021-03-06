const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        main: {
          blue: '#0081cc',
          darkBlue: '#0061a7',
        },
      },
    },
  },

  plugins: [require('@tailwindcss/forms')],
}
