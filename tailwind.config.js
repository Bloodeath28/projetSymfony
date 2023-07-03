/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      fontFamily: {
        Marvel: ['"Marvel-Regular"', 'sans-serif'],
    },
  },
  plugins: [],
}
}
