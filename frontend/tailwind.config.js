/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      keyframes: {
        appear: {
          "0%": { opacity: 0 },
          "100%": { opacity: 1 },
        },
        disappear: {
          "0%": { opacity: 1 },
          "100%": { opacity: 0 },
        },
        rainbow: {
          '0%': { 'color': 'red' },
          '14%': { 'color': 'orange' },
          '28%': { 'color': 'yellow' },
          '42%': { 'color': 'green' },
          '56%': { 'color': 'aqua' },
          '70%': { 'color': 'blue' },
          '84%': { 'color': 'purple' },
          '100%': { 'color': 'red' }
        },
        rotate: {
          '0%': { 'transform': 'rotate(0deg)' },
          '100%': { 'transform': 'rotate(360deg)' },
        },
        hurueru: {
          '0%': { 'transform': 'translate(0px, 0px) rotateZ(0deg)' },
          '25%': { 'transform': 'translate(10px, 6px) rotateZ(1deg)' },
          '50%': { 'transform': 'translate(0px, 2px) rotateZ(0deg)' },
          '75%': { 'transform': 'translate(4px, 0px) rotateZ(-1deg)' },
          '100%': { 'transform': 'translate(0px, 0px) rotateZ(0deg)' },
        },
      },
      animation: {
        appear: "appear 1.5s ease 2s 1 forwards",
        disappear: "disappear 3s ease 0s 1 forwards",
        rainbow: "rainbow 1s infinite",
        rotate: "rotate 1s linear infinite",
        huruhuru: "hurueru 1s infinite"
      },
    },
  },
  plugins: [],
};
