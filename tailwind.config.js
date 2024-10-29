/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./auth/**/*.{php,html,js}",
    "./resources/**/*.{php,html,js}",
    "./*.php",
  ],
  theme: {
    extend: {
      colors: {
        'custom-bg': '#f3f4f6',
        'custom-blue': '#3b82f6',
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
