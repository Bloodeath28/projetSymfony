/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      fontFamily: {
        marvel: ['Marvel-Regular', 'sans-serif'],
    },
  },
},
  plugins: [],
}

