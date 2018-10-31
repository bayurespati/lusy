<?php
use App\Sosmed;
use App\imageSlider;
use App\AboutContent;

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
    $sosmed = Sosmed::all();
    $imageSlider = imageSlider::all();
    $introduction = AboutContent::where('is_class', '=', false)->get();

    $introduction[0]->content = str_replace('\n', '<br>', $introduction[0]->content);
    $introduction[0]->content = str_replace('\"', '"', $introduction[0]->content);

    return view('index')->with(compact('sosmed', 'imageSlider', 'introduction'));
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
        $sosmed = Sosmed::all();
        $about = AboutContent::where('is_class', '=', false)->get();
        $classes = AboutContent::where('is_class', '=', true)->get();

        $about[0]->content = str_replace('\n', '<br>', $about[0]->content);
        $about[0]->content = str_replace('\"', '"', $about[0]->content);

        for ($i=0; $i < count($classes); $i++) { 
            $classes[$i]->content = str_replace('\n', '<br>', $classes[$i]->content);
            $classes[$i]->content = str_replace('\"', '"', $classes[$i]->content);
        }

		return view('about.index', compact('sosmed', 'about', 'classes'));
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
        $sosmed = Sosmed::all();

		return view('gallery.index', compact('sosmed'));
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
        $sosmed = Sosmed::all();

		return view('event.index', compact('sosmed'));
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
        $sosmed = Sosmed::all();

		return view('shop.index', compact('sosmed'));
	})->name('shop.index');

	Route::get('/item', function () { 
        $sosmed = Sosmed::all();

		return view('shop.item', compact('sosmed'));
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
        $sosmed = Sosmed::all();

		return view('contact.index', compact('sosmed'));
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
        Route::patch('/category', 'CategoryController@patch');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   G A L L E R Y   S U B C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/subcategory', 'SubcategoryController@index')->name('admin.gallery.subcategory');
        Route::get('/data/subcategory', 'SubcategoryController@loadSubcategory');
        Route::patch('/subcategory', 'SubcategoryController@patch');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   G A L L E R Y   P H O T O   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/list', 'ListController@index')->name('admin.gallery.list');
        Route::get('/data/list', 'ListController@loadList');
        Route::patch('/list', 'ListController@patch');
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