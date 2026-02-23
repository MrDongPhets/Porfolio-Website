import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  server: {
    // Proxy /api calls to local PHP server (XAMPP/Laragon on port 80)
    proxy: {
      '/api': {
        target: 'http://portfolio.localhost',
        changeOrigin: true,
      },
    },
  },
  build: {
    outDir: 'dist',
    emptyOutDir: true,
  },
});
