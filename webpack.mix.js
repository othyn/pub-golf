let mix = require('laravel-mix');

mix.options({
    purifyCss: true,
    processCssUrls: false,
    autoprefixer: {
        browsers: ['last 3 versions', '> 1%'],
        cascade: true
    }
});
// Webpack plugin config

if (mix.inProduction()) {
    mix.version();
}
// If in prod, generate versioning / cache busting

mix.sass('resources/assets/sass/app.scss', 'public/dist/css', { outputStyle: 'expanded' });
// Sass

mix.extract(['axios', 'jquery']);
// JS Vendor

mix.js('resources/assets/js/app.js', 'public/dist/js');
// JS App

mix.copy('node_modules/font-awesome/fonts', 'public/dist/fonts');
// Copy FA fonts to dist
