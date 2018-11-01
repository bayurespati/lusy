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

    Route::get('home/sosmed', 'HomeController@sosmed')->name('admin.home.sosmed');
    Route::get('data/sosmed', 'HomeController@loadSosmed');
    Route::patch('home/edit/sosmed/{sosmed}', 'HomeController@editSosmed');

    Route::get('home/image-slider', 'HomeController@imageSlider')->name('admin.home.imageSider');
    Route::get('data/image-slider', 'HomeController@loadImageSlider');
    Route::post('home/add/image-slider', 'HomeController@addImageSlider');
    Route::delete('home/delete/image-slider/{imageSlider}', 'HomeController@deleteImageSlider');



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
    	| A D M I N   A B O U T   G A L L E R Y   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/gallery', 'GalleryController@index')->name('admin.about.gallery');
    	Route::get('/data/gallery', 'GalleryController@loadGallery');
    	Route::patch('/gallery', 'GalleryController@patch');

    	/*
    	|--------------------------------------------------------------------------
    	| A D M I N   A B O U T   C L A S S E S   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/class', 'ClassesController@index')->name('admin.about.classes');
    	Route::get('/data/class', 'ClassesController@loadClasses');
    	Route::patch('/class', 'ClassesController@patch');
    });



    /*
    |--------------------------------------------------------------------------
    | A D M I N   G A L L E R Y   R O U T E S
    |--------------------------------------------------------------------------
    |
    |  
    |
    */
    Route::group([
        'prefix' => 'gallery',
        'namespace' => 'Gallery',
        'middleware' => ['auth'],
    ], function() {

        /*
        |--------------------------------------------------------------------------
        | A D M I N   G A L L E R Y   C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/category', 'CategoryController@index')->name('admin.gallery.category');
        Route::get('/data/category', 'CategoryController@loadCategory');
        Route::post('/add/category', 'CategoryController@store');
        Route::patch('/update/category/{category}', 'CategoryController@update');
        Route::delete('/delete/category/{category}', 'CategoryController@destroy');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   G A L L E R Y   S U B C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/subcategory', 'SubcategoryController@index')->name('admin.gallery.subcategory');
        Route::get('/data/subcategory', 'SubcategoryController@loadSubcategory');
        Route::post('/add/subcategory', 'SubcategoryController@store');
        Route::patch('/update/subcategory/{subcategory}', 'SubcategoryController@update');
        Route::delete('/delete/subcategory/{subcategory}', 'SubcategoryController@destroy');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   G A L L E R Y   P H O T O   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/list', 'ListController@index')->name('admin.gallery.list');
        Route::get('/data/list', 'ListController@loadList');
        Route::post('/add/list', 'ListController@store');
        Route::patch('/update/list/{gallery}', 'ListController@update');
        Route::delete('/delete/list/{gallery}', 'ListController@destroy');
    });



    /*
    |--------------------------------------------------------------------------
    | A D M I N   E V E N T   R O U T E S
    |--------------------------------------------------------------------------
    |
    |  
    |
    */
    Route::group([
        'prefix' => 'event',
        'namespace' => 'Event',
        'middleware' => ['auth'],
    ], function() {

        /*
        |--------------------------------------------------------------------------
        | A D M I N   E V E N T   C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/category', 'CategoryController@index')->name('admin.event.category');
        Route::get('/data/category', 'CategoryController@loadCategory');
        Route::patch('/category', 'CategoryController@patch');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   E V E N T   S U B C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/subcategory', 'SubcategoryController@index')->name('admin.event.subcategory');
        Route::get('/data/subcategory', 'SubcategoryController@loadSubcategory');
        Route::patch('/subcategory', 'SubcategoryController@patch');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   E V E N T   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/list', 'ListController@index')->name('admin.event.list');
        Route::get('/data/list', 'ListController@loadList');
        Route::patch('/list', 'ListController@patch');
    });



    /*
    |--------------------------------------------------------------------------
    | A D M I N   S H O P   R O U T E S
    |--------------------------------------------------------------------------
    |
    |  
    |
    */
    Route::group([
        'prefix' => 'shop',
        'namespace' => 'Shop',
        'middleware' => ['auth'],
    ], function() {

        /*
        |--------------------------------------------------------------------------
        | A D M I N   S H O P   C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/category', 'CategoryController@index')->name('admin.shop.category');
        Route::get('/data/category', 'CategoryController@loadCategory');
        Route::patch('/category', 'CategoryController@patch');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   S H O P   S U B C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/subcategory', 'SubcategoryController@index')->name('admin.shop.subcategory');
        Route::get('/data/subcategory', 'SubcategoryController@loadSubcategory');
        Route::patch('/subcategory', 'SubcategoryController@patch');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   S H O P   I T E M   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/list', 'ListController@index')->name('admin.shop.list');
        Route::get('/data/list', 'ListController@loadList');
        Route::patch('/list', 'ListController@patch');
    });
});