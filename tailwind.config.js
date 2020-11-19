const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue'
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['sohne', ...defaultTheme.fontFamily.sans]
      }
    }
  },

  variants: {
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
    tableLayout: ['responsive', 'hover', 'focus']
  }

}
