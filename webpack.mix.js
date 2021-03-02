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
  .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
  // 'resources/vendor/jquery/jquery.min.js',
  'resources/vendor/jquery-ui/jquery-ui.min.js',
  'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
  'resources/vendor/svg-inject/svginject.js',
  // 'resources/js/sb-admin-2.min.js', // Moved to general.js
  'resources/vendor/chart.js/Chart.js',
  // 'resources/js/demo/chart-area-demo.js',
  // 'resources/js/demo/chart-pie-demo.js',
  // 'resources/js/demo/chart-bar-demo.js',
  'resources/vendor/dropzone/dropzone.js',
], 'public/js/vendor.js');

mix.js([
  'resources/js/general.js',
  'resources/js/sliders.js',
  'resources/js/dropzones.js',
], 'public/js/all.js').babel('public/js/all.js', 'public/js/all.js');

mix.babel([
  'resources/js/admin.js',
], 'public/js/admin.js');

// Add here if needs node (eg: env.process.ENV variables)
mix.js('resources/js/paymentez-add-card.js', 'public/js')
mix.js('resources/js/paymentez-checkout.js', 'public/js')
mix.js('resources/js/paymentez-checkout-product-plans.js', 'public/js')
// mix.js('resources/js/admin.js', 'public/js')


mix.browserSync({
  proxy: process.env.MIX_SENTRY_DSN_PUBLIC,
  // host: process.env.MIX_SENTRY_DSN_PUBLIC,
  files: [
    'public/**/*',
    'resources/**/*'
  ]
});
