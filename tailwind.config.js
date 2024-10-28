/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",  // Root PHP files
    "./src/**/*.{html,js,php}",
    "./pages/**/*.{html,js,php}",
    "./components/**/*.{html,js,php}",
    "./admin/**/*.{html,js,php}"  // Admin files
  ],
  theme: {
    extend: {
      colors: {
        'custom-bg': '#E5E5E5',
        'custom-blue': '#4A90E2',
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
