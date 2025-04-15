module.exports = {
  content: [
    './resources/js/**/*.{js,ts,vue}', 
    './resources/views/**/*.blade.php',
    './storage/framework/views/*.php', 
  ],
  theme: {
    extend: {
      colors: {
        primary: '#4F46E5', 
        secondary: '#10B981',
        accent: '#F59E0B', 
        background: '#F9FAFB',
        dark: '#1F2937', 
        light: '#E5E7EB', 
        highlight: '#F3F4F6',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

