/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        'brand-primary': '#0BCCB4',
        'brand-dark': '#09A896',
        'brand-light': '#E6FAF8',
        'brand-glow': '#5FE3D0',
        'brand-accent': '#7322FC',
      },
      fontFamily: {
        sans: [
          '-apple-system',
          'BlinkMacSystemFont',
          'SF Pro Display',
          'SF Pro Text',
          'Helvetica Neue',
          'Helvetica',
          'Arial',
          'sans-serif',
        ],
      },
      boxShadow: {
        'glow': '0 0 30px rgba(11, 204, 180, 0.3)',
        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.1)',
      },
      container: {
        center: true,
        padding: '1rem',
      }
    },
  },
  plugins: [],
};
