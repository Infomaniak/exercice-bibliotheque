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

mix.js('resources/js/app.js', 'public/js')
    .babel([
        'node_modules/angular/angular.js',
        //'node_modules/angular-route/angular-route.js',
        //'resources/js/angular/routing.js',
        'resources/js/angular/userModule.js',
        'resources/js/angular/bookModule.js',
        'resources/js/angular/authorModule.js',
        'resources/js/angular/modules.js',
    ], 'public/js/angular.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/dashboard/dashboard.scss', 'public/css')
    .styles('node_modules/semantic-ui/dist/semantic.css', 'public/css/semantic.css')
    .js('node_modules/semantic-ui/dist/semantic.js', 'public/js/semantic.js')
;
if (mix.inProduction()) {
    mix.version();
}
