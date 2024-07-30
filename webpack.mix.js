const mix = require('laravel-mix');
const { vite } = require('laravel-mix-vite');

mix.js('resources/js/app.js', 'public/js')
   .vue()
   .sass('resources/sass/app.scss', 'public/css')
   .vite();
