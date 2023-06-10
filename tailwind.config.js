/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      keyframes: {
        'bounce-cart-icon': {

        }
      },
      animation: {
        'bounce-cart-icon': 'bounce .3s linear',
      }
    },
  },
  plugins: [],
}

