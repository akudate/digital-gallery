/** @type {import('tailwindcss').Config} */
export default {
  content: [],
  theme: {
    extend: {},
  },
  plugins: [],
}
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js",
      "./node_modules/tw-elements/dist/js/**/*.js",
    ],
    theme: {
      extend: {},
    },
    plugins: [
        require('flowbite/plugin'),
        require("tw-elements/dist/plugin.cjs"),
    ],
  }
