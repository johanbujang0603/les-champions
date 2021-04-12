const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    // if tailwind installed
    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.config.js')
            // require("@tailwindcss/jit"),
        ]
    })
    .scripts(['resources/js/functions.js', 'resources/js/script.js', 'resources/js/ajax.js'], 'public/js/scripts.js')
    .sourceMaps()
    .options({
        hmrOptions: {
            host: 'localhost',
            port: 3000,
        }
    })
    .webpackConfig({
        devServer: {
            host: '0.0.0.0',
            port: 3000,
        },
    });
