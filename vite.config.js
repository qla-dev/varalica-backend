import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import { resolve } from 'node:path';

export default defineConfig({
    root: 'resources/landing',
    base: '/dist/',
    plugins: [react()],
    build: {
        outDir: '../../public/dist',
        emptyOutDir: true,
        rollupOptions: {
            input: resolve(process.cwd(), 'resources/landing/index.html'),
        },
    },
});
