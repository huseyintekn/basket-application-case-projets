const mix = require('laravel-mix');
const PanelResourceAssets = 'resources/assets/admin/'
const PanelPublicAssets = 'public/assets/panel/'
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

mix.copy(PanelResourceAssets + 'fonts', PanelPublicAssets + 'fonts')
mix.copy(PanelResourceAssets + 'media', PanelPublicAssets + 'media')
mix.copy(PanelResourceAssets + 'icons', PanelPublicAssets + 'icons')
mix.js('resources/js/app.js', 'public/js', )
    .combine([
        PanelResourceAssets + 'vendors/jquery/jquery.js',
        PanelResourceAssets + 'vendors/bundle/bundle.js',
        PanelResourceAssets + 'vendors/popper/popper.min.js',
        PanelResourceAssets + 'vendors/popper/popper.min.js',
        PanelResourceAssets + 'js/app.min.js',
        PanelResourceAssets + 'js/dev.js',
    ], PanelPublicAssets + 'js/ht-panel.js')
    .styles([
        PanelResourceAssets + 'vendors/bundle/bundle.css',
        PanelResourceAssets + 'css/app.min.css',
    ],PanelPublicAssets + 'css/ht-panel.css')
    .sourceMaps();
mix.version();
