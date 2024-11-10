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

let theme = process.env.npm_config_theme;

if (theme) {
    require(`${__dirname}/themes/${theme}/webpack.mix.js`);
} else {
    require(`${__dirname}/webpack.mix.js`)
};