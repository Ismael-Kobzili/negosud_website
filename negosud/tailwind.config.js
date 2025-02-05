/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        burgundy: {
          50: 'rgb(var(--color-burgundy-50) / <alpha-value>)',
          100: 'rgb(var(--color-burgundy-100) / <alpha-value>)',
          200: 'rgb(var(--color-burgundy-200) / <alpha-value>)',
          300: 'rgb(var(--color-burgundy-300) / <alpha-value>)',
          400: 'rgb(var(--color-burgundy-400) / <alpha-value>)',
          500: 'rgb(var(--color-burgundy-500) / <alpha-value>)',
          600: 'rgb(var(--color-burgundy-600) / <alpha-value>)',
          700: 'rgb(var(--color-burgundy-700) / <alpha-value>)',
          800: 'rgb(var(--color-burgundy-800) / <alpha-value>)',
          900: 'rgb(var(--color-burgundy-900) / <alpha-value>)',
          950: 'rgb(var(--color-burgundy-950) / <alpha-value>)',
        },
      },
    },
  },
  plugins: [],
};