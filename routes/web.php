<?php
use App\Sosmed;
use App\imageSlider;
use App\AboutContent;
use App\Category;
use App\SubCategory;
use App\Gallery;
use App\Event;
use App\ShopItem;
use Carbon\Carbon;

use Illuminate\Http\Request;

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
    $classes = AboutContent::where('is_class', '=', true)->get();
    $showcasedImage = Gallery::whereIsShowcase(true)->get();

    if(count($showcasedImage) > 0 && count($showcasedImage) >= 4 && count($showcasedImage) < 8){
        $showedImage = Gallery::whereIsShowcase(true)->paginate(4); 
    }
    else if(count($showcasedImage) > 0 && count($showcasedImage) == 8){
        $showedImage = $showcasedImage;
    }
    else {
        $showedImage = $showcasedImage;
    }

    $showcasedEvents = Event::orderBy('end_date', 'DESC')->paginate(2);
    foreach ($showcasedEvents as $event) {
        $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;

        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        $event->day = $startDate->format('D');
        $event->dayComplete = $startDate->format('l');
        $event->dayDate = $startDate->format('d');
        $event->month = $startDate->format('M');
        $event->startHour = $startDate->format('h:i A');
        $event->endHour = $endDate->format('h:i A');
    }

    // $introduction[0]->content = str_replace('\n', '<br>', $introduction[0]->content);
    // $introduction[0]->content = str_replace('\"', '"', $introduction[0]->content);

    return view('index')->with(compact('sosmed', 'imageSlider', 'introduction', 'classes', 'showedImage', 'showcasedEvents'));
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

        // $about[0]->content = str_replace('\n', '<br>', $about[0]->content);
        // $about[0]->content = str_replace('\"', '"', $about[0]->content);

        // for ($i=0; $i < count($classes); $i++) { 
            // $classes[$i]->content = str_replace('\n', '<br>', $classes[$i]->content);
            // $classes[$i]->content = str_replace('\"', '"', $classes[$i]->content);
        // }

        $showcasedImage = Gallery::whereIsShowcase(true)->get();

        if(count($showcasedImage) > 0 && count($showcasedImage) >= 4 && count($showcasedImage) < 8){
            $showedImage = Gallery::whereIsShowcase(true)->paginate(4); 
        }
        else if(count($showcasedImage) > 0 && count($showcasedImage) == 8){
            $showedImage = $showcasedImage;
        }
        else {
            $showedImage = $showcasedImage;
        }

		return view('about.index', compact('sosmed', 'about', 'classes', 'showedImage'));
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
        $categories = Category::with('subcategories')->whereType(1)->get();
        $gallery = Gallery::paginate(8);



		return view('gallery.index', compact('sosmed', 'categories', 'gallery'));
	})->name('gallery.index');

    Route::get('category/{category}', function(Request $request, Category $category){
        return $category->subcategories()->get();
    });

    Route::get('/all', function(){
        return $gallery = Gallery::paginate(8);

        return $gallery;
    });

    Route::get('/subcategory/{subcategory}', function(Request $request, SubCategory $subcategory){
        $gallery = Gallery::whereSubCategoryId($subcategory->id)->paginate(8);

        return $gallery;
    });
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
        $categories = Category::with('subcategories')->whereType(2)->get();
        $events = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->paginate(6);

        foreach ($events as $event) {
            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

		return view('event.index', compact('sosmed', 'categories', 'events'));
	})->name('event.index');

    Route::get('/past/all', function(){
        $events = Event::whereDate('end_date', '<', Carbon::today()->toDateString())->paginate(6);

        foreach ($events as $event) {
            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    });

    Route::get('/upcoming/all', function(){
        $events = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->paginate(6);

        foreach ($events as $event) {
            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    });

    Route::get('/past/subcategory/{subcategory}', function(Request $request, SubCategory $subcategory){
        $events = Event::whereDate('end_date', '<', Carbon::today()->toDateString())->whereSubCategoryId($subcategory->id)->paginate(6);

        foreach ($events as $event) {
            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    });

    Route::get('/upcoming/subcategory/{subcategory}', function(Request $request, SubCategory $subcategory){
        $events = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->whereSubCategoryId($subcategory->id)->paginate(6);

        foreach ($events as $event) {
            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    });

    Route::get('single/{event}', function(Request $request, Event $event){
        $sosmed = Sosmed::all();

        $event->kategori = SubCategory::find($event->sub_category_id)
        ->category()
        ->get()[0]->title;

        $event->poster = $event->poster()->get()->isEmpty()
        ? '/img/events1.jpg'
        : $event->poster()->get()[0]->image_path;

        $event->images = $event->images()->get();

        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        $event->day = $startDate->format('D');
        $event->dayDate = $startDate->format('d');
        $event->month = $startDate->format('M');
        $event->startHour = $startDate->format('h:i A');
        $event->endHour = $endDate->format('h:i A');

        return view('event.single', compact('sosmed', 'event'));
    });
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
        $categories = Category::with('subcategories')->whereType(3)->get();

        $items = ShopItem::whereIsDisplayed(true)->paginate(8);

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

		return view('shop.index', compact('sosmed', 'categories', 'items'));
	})->name('shop.index');

	Route::get('/item/{shopItem}', function (Request $request, ShopItem $shopItem) { 
        $sosmed = Sosmed::all();

        $shopItem->poster = $shopItem->poster()->get()->isEmpty()
        ? '/img/welcome-1.jpg'
        : $shopItem->poster()->get()[0]->image_path;

        $shopItem->price = number_format($shopItem->price, 2, ",", ".");

		return view('shop.item', compact('sosmed', 'shopItem'));
	})->name('shop.item');

    Route::get('/all', function () {
        $items = ShopItem::whereIsDisplayed(true)->paginate(8);

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");

        }

        return $items;
    });

    Route::get('/category/{category}', function (Request $request, Category $category) {
        $items = ShopItem::whereIsDisplayed(true)->whereCategoryId($category->id)->paginate(8);

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

        return $items;
    });

    Route::get('/subcategory/{subcategory}', function (Request $request, SubCategory $subcategory) {
        $items = ShopItem::whereIsDisplayed(true)->whereSubCategoryId($subcategory->id)->paginate(8);

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

        return $items;
    });

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
    	Route::patch('/update/profile/{profile}', 'ProfileController@update');

    	/*
    	|--------------------------------------------------------------------------
    	| A D M I N   A B O U T   G A L L E R Y   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/gallery', 'GalleryController@index')->name('admin.about.gallery');
    	Route::get('/data/gallery', 'GalleryController@loadGallery');
    	Route::patch('/update/gallery/{gallery}', 'GalleryController@update');

    	/*
    	|--------------------------------------------------------------------------
    	| A D M I N   A B O U T   C L A S S E S   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/class', 'ClassesController@index')->name('admin.about.classes');
    	Route::get('/data/class', 'ClassesController@loadClasses');
        Route::post('/add/class', 'ClassesController@store');
    	Route::patch('/update/class/{class}', 'ClassesController@update');
        Route::delete('/delete/class/{class}', 'ClassesController@destroy');
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
        Route::post('/add/category', 'CategoryController@store');
        Route::patch('/update/category/{category}', 'CategoryController@update');
        Route::delete('/delete/category/{category}', 'CategoryController@destroy');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   E V E N T   S U B C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/subcategory', 'SubcategoryController@index')->name('admin.event.subcategory');
        Route::get('/data/subcategory', 'SubcategoryController@loadSubcategory');
        Route::post('/add/subcategory', 'SubcategoryController@store');
        Route::patch('/update/subcategory/{subcategory}', 'SubcategoryController@update');
        Route::delete('/delete/subcategory/{subcategory}', 'SubcategoryController@destroy');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   E V E N T   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/list', 'ListController@index')->name('admin.event.list');
        Route::get('/data/list', 'ListController@loadEvent');
        Route::post('/add/list', 'ListController@store');
        Route::patch('/update/list/{event}', 'ListController@update');
        Route::delete('/delete/list/{event}', 'ListController@destroy');


        /*
        |--------------------------------------------------------------------------
        | A D M I N   E V E N T   I T E M   I M A G E   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/image/{param}', 'ImageController@index')->name('admin.event.image');
        Route::get('/data/image/{param}', 'ImageController@loadImageList');
        Route::post('/add/image', 'ImageController@store');
        Route::patch('/update/image/{eventImage}', 'ImageController@update');
        Route::delete('/delete/image/{eventImage}', 'ImageController@destroy');
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
        Route::post('/add/category', 'CategoryController@store');
        Route::patch('/update/category/{category}', 'CategoryController@update');
        Route::delete('/delete/category/{category}', 'CategoryController@destroy');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   S H O P   S U B C A T E G O R Y   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/subcategory', 'SubcategoryController@index')->name('admin.shop.subcategory');
        Route::get('/data/subcategory', 'SubcategoryController@loadSubcategory');
        Route::post('/add/subcategory', 'SubcategoryController@store');
        Route::patch('/update/subcategory/{subcategory}', 'SubcategoryController@update');
        Route::delete('/delete/subcategory/{subcategory}', 'SubcategoryController@destroy');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   S H O P   I T E M   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/list', 'ListController@index')->name('admin.shop.list');
        Route::get('/data/list', 'ListController@loadList');
        Route::post('/add/list', 'ListController@store');
        Route::patch('/update/list/{item}', 'ListController@patch');
        Route::delete('/delete/list/{item}', 'ListController@delete');


        /*
        |--------------------------------------------------------------------------
        | A D M I N   S H O P   I T E M   I M A G E   L I S T   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/image/{param}', 'ImageController@index')->name('admin.shop.image');
        Route::get('/data/image/{param}', 'ImageController@loadImageList');
        Route::post('/add/image', 'ImageController@store');
        Route::patch('/update/image/{shopImage}', 'ImageController@update');
        Route::delete('/delete/image/{shopImage}', 'ImageController@destroy');

    });
});