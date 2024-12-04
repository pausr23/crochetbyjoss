/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            'dm-sans': ['"DM Sans"', 'sans-serif'], 
        },
    },
},
  plugins: [],
}

