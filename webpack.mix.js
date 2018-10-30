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

mix.js('resources/assets/js/app.js', 'public/js');


mix.styles([	
	'resources/assets/css/additional.css',
], 'public/css/admin.css');

mix.styles([
    'resources/assets/css/animation.css',
    'resources/assets/css/loading.css',
], 'public/css/animation.css');

mix.styles([	
	'resources/assets/lib/revolution/css/settings.css',
	'resources/assets/lib/revolution/css/layers.css',
	'resources/assets/lib/revolution/css/navigation.css',
	'resources/assets/lib/lib.css',	
	'resources/assets/css/style.css',
	'resources/assets/css/additional.css',
	'resources/assets/css/plugins.css',
	'resources/assets/css/navigation-menu.css',
	'resources/assets/css/shortcode.css',
	'resources/assets/css/custom.css',
], 'public/css/base.css');

mix.scripts([
	'resources/assets/js/jquery-1.12.4.min.js',
	'resources/assets/lib/lib.js',
	'resources/assets/lib/revolution/js/jquery.themepunch.tools.min.js',
	'resources/assets/lib/revolution/js/jquery.themepunch.revolution.min.js',
	'resources/assets/lib/revolution/js/extensions/revolution.extension.video.min.js',
	'resources/assets/lib/revolution/js/extensions/revolution.extension.slideanims.min.js',
	'resources/assets/lib/revolution/js/extensions/revolution.extension.layeranimation.min.js',
	'resources/assets/lib/revolution/js/extensions/revolution.extension.navigation.min.js',
	'resources/assets/js/functions.js',
], 'public/js/base.js');

mix.scripts([
	'resources/assets/js/html5/respond.min.js'
], 'public/js/html5.js');


mix.js([
    'resources/assets/js/vue-components/admin/home/main.js',
], 'public/js/admin/home.js');


mix.js([
    'resources/assets/js/vue-components/admin/about/profile/main.js',
], 'public/js/admin/about/profile.js');
mix.js([
    'resources/assets/js/vue-components/admin/about/classes/main.js',
], 'public/js/admin/about/classes.js');
mix.js([
    'resources/assets/js/vue-components/admin/about/gallery-showcase/main.js',
], 'public/js/admin/about/gallery_showcase.js');



