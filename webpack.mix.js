const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/src/apps/backend/app_backend.js', 'public/js')
    .js('resources/js/src/apps/frontend/app_frontend.js', 'public/js')
    .js('resources/js/src/apps/webrtc/app-webrtc.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
