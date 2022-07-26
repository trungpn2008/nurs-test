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
mix.webpackConfig({
    externals: {
        "jquery": "jQuery"
    }
});
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/footer.scss', 'public/css')
    .sass('resources/sass/head.scss', 'public/css')
    .sass('resources/sass/banner.scss', 'public/css')
    .sass('resources/sass/column.scss', 'public/css')
    .sass('resources/sass/event.scss', 'public/css')
    .sass('resources/sass/consultation.scss', 'public/css')
    .sass('resources/sass/manager-introduction.scss', 'public/css')
    .sass('resources/sass/notice.scss', 'public/css')
    .sass('resources/sass/column-detail.scss', 'public/css')
    .sass('resources/sass/post.scss', 'public/css')
    .sass('resources/sass/qa.scss', 'public/css')
    .sass('resources/sass/info-user.scss', 'public/css')
;
