<?php


/*
|--------------------------------------------------------------------------
| A U T H   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');



/*
|--------------------------------------------------------------------------
| H O M E   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::get('/', function () {
    return view('index');
})->name('home');



/*
|--------------------------------------------------------------------------
| A B O U T   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::group([
	'prefix' => 'about',
	'namespace' => 'About',
], function () {

	Route::get('/', function () { 
		return view('about.index');
	})->name('about.index');
});



/*
|--------------------------------------------------------------------------
| G A L L E R Y   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::group([
	'prefix' => 'gallery',
	'namespace' => 'Gallery',
], function () {

	Route::get('/', function () { 
		return view('gallery.index');
	})->name('gallery.index');
});



/*
|--------------------------------------------------------------------------
| E V E N T   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::group([
	'prefix' => 'event',
	'namespace' => 'Event',
], function () {

	Route::get('/', function () { 
		return view('event.index');
	})->name('event.index');
});



/*
|--------------------------------------------------------------------------
| S H O P   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::group([
	'prefix' => 'shop',
	'namespace' => 'Shop',
], function () {

	Route::get('/', function () { 
		return view('shop.index');
	})->name('shop.index');

	Route::get('/item', function () { 
		return view('shop.item');
	})->name('shop.item');

});



/*
|--------------------------------------------------------------------------
| C O N T A C T   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::group([
	'prefix' => 'contact',
	'namespace' => 'Contact',
], function () {

	Route::get('/', function () { 
		return view('contact.index');
	})->name('contact.index');
});



/*
|--------------------------------------------------------------------------
| A D M I N   R O U T E S
|--------------------------------------------------------------------------
|
|  
|
*/
Route::group([
        'prefix' => 'admin',
        'namespace' => 'admin',
        'middleware' => ['auth'],
    ], function () {

    Route::get('home', 'HomeController@index');
    Route::get('data/sosmed', 'HomeController@loadSosmed');
    Route::patch('/sosmed/{sosmed}', 'HomeController@editSosmed');



    /*
    |--------------------------------------------------------------------------
    | A D M I N   A B O U T   R O U T E S
    |--------------------------------------------------------------------------
    |
    |  
    |
    */
    Route::group([
    	'prefix' => 'about',
    	'namespace' => 'About',
    	'middleware' => ['auth'],
    ], function() {

    	/*
    	|--------------------------------------------------------------------------
    	| A D M I N   A B O U T   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/profile', 'ProfileController@index')->name('admin.about.profile');
    	Route::get('/data/profile', 'ProfileController@loadProfile');
    	Route::patch('/profile', 'ProfileController@patch');

    	/*
    	|--------------------------------------------------------------------------
    	| A D M I N   G A L L E R Y   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/gallery', 'GalleryController@index')->name('admin.about.gallery');
    	Route::get('/data/gallery', 'GalleryController@loadGallery');
    	Route::patch('/gallery', 'GalleryController@patch');

    	/*
    	|--------------------------------------------------------------------------
    	| A D M I N   C L A S S E S   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/classes', 'ClassesController@index')->name('admin.about.classes');
    	Route::get('/data/classes', 'ClassesController@loadClasses');
    	Route::patch('/classes', 'ClassesController@patch');
    });
});