let mix = require('laravel-mix');
// Imports

let options = {
    processCssUrls: false,
    autoprefixer: {
        browsers: ['last 3 versions', '> 1%'],
        cascade: true
    }
};
// Mix options

if (mix.inProduction()) {

    mix.version();
    // Generate with versioning / cache busting

    options.purifyCss = true;
    // Only compile required CSS
}

mix.options(options);
// Webpack plugin config

mix.sass('resources/assets/sass/app.scss', 'public/dist/css', { outputStyle: 'expanded' });
// Sass

mix.extract(['axios', 'jquery', 'sweetalert']);
// JS Vendor

mix.js('resources/assets/js/app.js', 'public/dist/js');
// JS App

mix.copy('node_modules/font-awesome/fonts', 'public/dist/fonts');
// Copy FA fonts to dist
