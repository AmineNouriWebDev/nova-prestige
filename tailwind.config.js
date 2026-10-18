/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    './public/**/*.php',
    './app/**/*.php',
    './public/assets/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        grotesk: ['Space Grotesk', 'sans-serif'],
        inter: ['Inter', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      colors: {
        'np-bg': 'rgb(var(--np-bg) / <alpha-value>)',
        'np-surface': 'rgb(var(--np-surface) / <alpha-value>)',
        'np-text': 'rgb(var(--np-text) / <alpha-value>)',
        'np-text-muted': 'rgb(var(--np-text-muted) / <alpha-value>)',
        'np-primary': 'rgb(var(--np-primary) / <alpha-value>)',
        'np-accent': 'rgb(var(--np-accent) / <alpha-value>)',
        'np-border': 'rgb(var(--np-border) / <alpha-value>)',
      },
      animation: {
        'spin-slow': 'spin 3s linear infinite',
        'pulse-slow': 'pulse 3s ease-in-out infinite',
        'marquee': 'marquee 30s linear infinite',
        'marquee-reverse': 'marquee-reverse 30s linear infinite',
        'counter': 'counter 1.5s ease-out forwards',
        'stroke-draw': 'stroke-draw 1.5s ease-out forwards',
        'shine': 'shine 0.6s ease-in-out',
        'slide-up': 'slide-up 0.6s ease-out forwards',
        'fade-in': 'fade-in 0.5s ease-out forwards',
      },
      keyframes: {
        marquee: { '0%': { transform: 'translateX(0)' }, '100%': { transform: 'translateX(-50%)' } },
        'marquee-reverse': { '0%': { transform: 'translateX(-50%)' }, '100%': { transform: 'translateX(0)' } },
        'slide-up': { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
        'fade-in': { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
        'shine': { '0%': { left: '-100%' }, '100%': { left: '125%' } },
        'stroke-draw': { '0%': { strokeDashoffset: '1000' }, '100%': { strokeDashoffset: '0' } },
      },
      backdropBlur: { xs: '2px' },
      transitionTimingFunction: { 'bounce-out': 'cubic-bezier(0.34, 1.56, 0.64, 1)' },
    },
  },
  plugins: [],
};
