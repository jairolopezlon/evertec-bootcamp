import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig( {
    plugins: [
        laravel( {
            input: [ 'resources/sass/app.scss', 'resources/ts/app.ts' ],
            refresh: true,
        } ),
        vue(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': '/resources/ts',
        },
    },
} );
