import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
// SassMixin.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');
// if(SassMixin.inProduction()){
//     SassMixin.version(); 
// }

