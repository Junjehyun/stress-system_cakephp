/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.php',
    './src/**/*.php',
    './webroot/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        jp: ['Kiwi Maru', 'Noto Sans Japanese', 'sans-serif'], // 日本語フォント
      },
    },
  },
  plugins: [],
}

