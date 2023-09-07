const mix = require('laravel-mix');
const path = require('path');
const LiveReloadPlugin = require('webpack-livereload-plugin');

require('laravel-mix-svg-sprite');

mix.copyDirectory('resources/fonts', 'dist/fonts');

mix.setPublicPath('dist');

mix.version();
mix.webpackConfig({
    plugins: [new LiveReloadPlugin()]
});

mix.sass('resources/scss/styles.scss', 'dist/css')
    .sass('resources/scss/gutenberg.scss', 'dist/css')
    .sass('resources/scss/admin.scss', 'dist/css')
    .options({
        processCssUrls: false
    });

mix.svgSprite('resources/svg', 'svg/icons.svg')

mix.js('resources/js/scripts.js', 'dist/js')
    .js('resources/js/block-example.js', 'dist/js')
    .js('resources/js/svg.js', 'dist/js')
    .js('resources/js/admin.js', 'dist/js')
    .webpackConfig({
        resolve: {
            modules: [
                'node_modules'
            ]
        },
        module: {
            rules: [
                {
                    test: /\.scss/,
                    enforce: 'pre',
                    loader: 'import-glob-loader'
                },
                {
                    test: /\.js/,
                    enforce: 'pre',
                    loader: 'import-glob-loader'
                }
            ]
        },
    });
