import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import path from 'path';

export default defineConfig({
  resolve: {
    alias: {
      '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.scss', 'resources/js/app.js', 'resources/js/codemirror.js'],
      refresh: true,
    }),
    viteStaticCopy({
      targets: [
        {
          src: 'resources/js/brython.min.js',
          dest: 'assets',
        },
        {
          src: 'resources/js/brython_stdlib.js',
          dest: 'assets',
        },
      ],
    }),
  ],
});
