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

/*
 |--------------------------------------------------------------------------
 | P U B L I C  J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.js('resources/assets/js/app.js', 'public/js');



/*
 |--------------------------------------------------------------------------
 | A D M I N   C S S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.styles([	
	'resources/assets/css/bootstrap.min.css',
	'resources/assets/css/additional.css',
], 'public/css/admin.css');



/*
 |--------------------------------------------------------------------------
 | A N I M A T I O N   C S S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.styles([
    'resources/assets/css/animation.css',
    'resources/assets/css/loading.css',
], 'public/css/animation.css');



/*
 |--------------------------------------------------------------------------
 | C R O P P I E   C S S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.styles([	
	'resources/assets/css/croppie.min.css.map',
], 'public/css/croppie.css');



/*
 |--------------------------------------------------------------------------
 | B A S E   C S S
 |--------------------------------------------------------------------------
 |
 |
 */
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



/*
 |--------------------------------------------------------------------------
 | C R O P P I E   J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.scripts([
	'resources/assets/js/croppie.min.js',
], 'public/js/croppie.js');



/*
 |--------------------------------------------------------------------------
 | B A S E   J S
 |--------------------------------------------------------------------------
 |
 |
 */
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



/*
 |--------------------------------------------------------------------------
 | H T M L   5   J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.scripts([
	'resources/assets/js/html5/respond.min.js'
], 'public/js/html5.js');



/*
 |--------------------------------------------------------------------------
 | A D M I N  H O M E   J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.js([
    'resources/assets/js/vue-components/admin/home/sosmed/main.js',
], 'public/js/admin/sosmed.js');

mix.js([
    'resources/assets/js/vue-components/admin/home/image-slider/main.js',
], 'public/js/admin/slider.js');




/*
 |--------------------------------------------------------------------------
 | A D M I N   A B O U T   J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.js([
    'resources/assets/js/vue-components/admin/about/profile/main.js',
], 'public/js/admin/about/profile.js');
mix.js([
    'resources/assets/js/vue-components/admin/about/classes/main.js',
], 'public/js/admin/about/classes.js');
mix.js([
    'resources/assets/js/vue-components/admin/about/gallery-showcase/main.js',
], 'public/js/admin/about/gallery_showcase.js');



/*
 |--------------------------------------------------------------------------
 | A D M I N   G A L L E R Y   J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.js([
    'resources/assets/js/vue-components/admin/gallery/category/main.js',
], 'public/js/admin/gallery/categories.js');
mix.js([
    'resources/assets/js/vue-components/admin/gallery/subcategory/main.js',
], 'public/js/admin/gallery/subcategories.js');
mix.js([
    'resources/assets/js/vue-components/admin/gallery/list/main.js',
], 'public/js/admin/gallery/list.js');



/*
 |--------------------------------------------------------------------------
 | A D M I N   E V E N T   J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.js([
    'resources/assets/js/vue-components/admin/event/category/main.js',
], 'public/js/admin/event/categories.js');
mix.js([
    'resources/assets/js/vue-components/admin/event/subcategory/main.js',
], 'public/js/admin/event/subcategories.js');
mix.js([
    'resources/assets/js/vue-components/admin/event/list/main.js',
], 'public/js/admin/event/list.js');
mix.js([
    'resources/assets/js/vue-components/admin/event/image/main.js',
], 'public/js/admin/event/image.js');



/*
 |--------------------------------------------------------------------------
 | A D M I N   S H O P   J S
 |--------------------------------------------------------------------------
 |
 |
 */
mix.js([
    'resources/assets/js/vue-components/admin/shop/category/main.js',
], 'public/js/admin/shop/categories.js');
mix.js([
    'resources/assets/js/vue-components/admin/shop/subcategory/main.js',
], 'public/js/admin/shop/subcategories.js');
mix.js([
    'resources/assets/js/vue-components/admin/shop/list/main.js',
], 'public/js/admin/shop/list.js');
mix.js([
    'resources/assets/js/vue-components/admin/shop/image/main.js',
], 'public/js/admin/shop/image.js');


