/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./views/*.{php,html,js}"],
  theme: {
    colors: {
    },
  },
  plugins: [require("daisyui")],
}