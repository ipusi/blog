let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.copy('resources/assets/js/magic-canvas.min.js','public/js');

mix.copy('resources/assets/sass/blog.css','public/css');
mix.copy('resources/assets/sass/timeline.css','public/css');
mix.copy('resources/assets/images','public/images');