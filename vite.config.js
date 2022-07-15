/*import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});*/

import laravel from 'laravel-vite-plugin'
import {defineConfig} from 'vite'
 
export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel([
            'resources/js/app.js',
            'resources/css/app.css',
        ]),
       {
           name: 'blade',
           handleHotUpdate({ file, server }) {
               if (file.endsWith('.blade.php')) {
                   server.ws.send({
                       type: 'full-reload',
                       path: '*',
                   });
               }
           },
       }
    ],
})