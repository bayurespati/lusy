    <?php
use App\Member;
use App\ApplicantList;
use App\ContactMessage;
use App\ShopInquiry;
use App\Sosmed;
use App\imageSlider;
use App\AboutContent;
use App\Category;
use App\SubCategory;
use App\Gallery;
use App\Event;
use App\ShopItem;
use App\imageConfig;
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
    $shopItems = ShopItem::whereIsShowcase(true)->get();
    $showcasedImage = Gallery::whereIsShowcase(true)->get();
    $eventBanner = imageConfig::find(1)->image_path === null 
    ? '/img/upcoming-event-bg.jpg'
    : imageConfig::find(1)->image_path;

    foreach ($shopItems as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/welcome-1.jpg'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

    if(
        count($showcasedImage) > 0 && 
        count($showcasedImage) >= 4 && count($showcasedImage) < 8){
        $showedImage = Gallery::whereIsShowcase(true)->paginate(4); 
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

    return view('index')->with(compact('sosmed', 'imageSlider', 'introduction', 'shopItems', 'showedImage', 'showcasedEvents', 'eventBanner'));
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
        $aboutBanner = imageConfig::find(2)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : imageConfig::find(2)->image_path;

        $showcasedImage = Gallery::whereIsShowcase(true)->get();

        if(
            count($showcasedImage) > 0 && 
            count($showcasedImage) >= 4 && count($showcasedImage) < 8){
            $showedImage = Gallery::whereIsShowcase(true)->paginate(4); 
        }
        else {
            $showedImage = $showcasedImage;
        }

		return view('about.index', compact('sosmed', 'about', 'classes', 'showedImage', 'aboutBanner'));
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
        $galleryBanner = imageConfig::find(3)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : imageConfig::find(3)->image_path;

		return view('gallery.index', compact('sosmed', 'categories', 'gallery', 'galleryBanner'));
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
        $upcomingEvents = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->paginate(6);
        $eventBanner = imageConfig::find(4)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : imageConfig::find(4)->image_path;

        $isEventsExist = count(Event::all()) > 0 
        ? true 
        : false;

        foreach ($upcomingEvents as $event) {
            $event->content = str_limit($event->content, 300);
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

		return view('event.index', compact('sosmed', 'categories', 'upcomingEvents', 'isEventsExist', 'eventBanner'));
	})->name('event.index');

    Route::get('/past/all', function(){
        $events = Event::whereDate('end_date', '<', Carbon::today()->toDateString())->paginate(6);

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

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
            $event->content = str_limit($event->content, 300);

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
            $event->content = str_limit($event->content, 300);

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
            $event->content = str_limit($event->content, 300);

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

        $eventBanner = imageConfig::find(4)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : imageConfig::find(4)->image_path;

        $event->kategori = SubCategory::find($event->sub_category_id)
        ->category()
        ->get()[0]->title;

        $event->poster = $event->poster()->get()->isEmpty()
        ? '/img/events1.jpg'
        : $event->poster()->get()[0]->image_path;

        $event->images = $event->images()->whereIsPoster(false)->paginate(8);

        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        $event->day = $startDate->format('D');
        $event->dayDate = $startDate->format('d');
        $event->month = $startDate->format('M');
        $event->startHour = $startDate->format('h:i A');
        $event->endHour = $endDate->format('h:i A');

        return view('event.single', compact('sosmed', 'event', 'eventBanner'));
    });

    Route::get('single/images/{event}', function(Request $request, Event $event){
        return $event->images()->whereIsPoster(false)->paginate(8);
    });

    Route::post('/registration/{event}', function(Request $request,Event $event){

        $applicantList = new ApplicantList;

        $applicantList->event_id = $event->id;
        $applicantList->name = $request->name;
        $applicantList->email = $request->email;
        $applicantList->phone = $request->phone;
        $applicantList->is_approve = false;

        $applicantList->save();

        return back();
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

        $shopBanner = imageConfig::find(5)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : imageConfig::find(5)->image_path;

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

		return view('shop.index', compact('sosmed', 'categories', 'items', 'shopBanner'));
	})->name('shop.index');

	Route::get('/item/{shopItem}', function (Request $request, ShopItem $shopItem) { 
        $sosmed = Sosmed::all();

        $shopBanner = imageConfig::find(5)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : imageConfig::find(5)->image_path;

        $shopItem->poster = $shopItem->poster()->get()->isEmpty()
        ? '/img/welcome-1.jpg'
        : $shopItem->poster()->get()[0]->image_path;

        $shopItem->images = $shopItem->images()->whereIsPoster(false)->paginate(4);

        $shopItem->price = number_format($shopItem->price, 2, ",", ".");

		return view('shop.item', compact('sosmed', 'shopItem', 'shopBanner'));
	})->name('shop.item');

    Route::get('item/images/{shopItem}', function(Request $request, ShopItem $shopItem){
        return $shopItem->images()->whereIsPoster(false)->paginate(4);
    });

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

    Route::post('/update/overseas/{shopitem}', function(Request $request, ShopItem $shopitem){

        $shopInquiry = new ShopInquiry;

        $shopInquiry->shop_item_id = $shopitem->id;
        $shopInquiry->buyer_name = $request->buyer_name;
        $shopInquiry->gender = $request->gender;
        $shopInquiry->email = $request->email;
        $shopInquiry->address = $request->address;
        $shopInquiry->city = $request->city;
        $shopInquiry->state_province = $request->state_province;
        $shopInquiry->postal_code = $request->postal_code;
        $shopInquiry->notes = $request->notes;
        $shopInquiry->quantity = $request->quantity;
        $shopInquiry->is_confirmed = 0;

        $shopInquiry->save();

        return back();
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

        $contactBanner = imageConfig::find(6)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : imageConfig::find(6)->image_path;

		return view('contact.index', compact('sosmed', 'contactBanner'));
	})->name('contact.index');

    Route::post('contact_message',function(Request $request){

        $contact_message = new ContactMessage;

        $contact_message->name = $request->contact_fname .' '. $request->contact_lname;
        $contact_message->phone = $request->contact_phone;
        $contact_message->email = $request->contact_email;
        $contact_message->message = $request->contact_message;
        $contact_message->is_replay = false;

        $contact_message->save();

        return back();
    });


});

Route::post('member', function(Request $request) {

    $date = explode('/', str_replace(' ', '', $request->date_of_birth) );
    $date_of_birth = $date[2].'-'.$date[0].'-'.$date[1];

    $member = new Member;
    $member->name = $request->name;
    $member->gender = $request->gender;
    $member->place_of_birth = $request->place_of_birth;
    $member->date_of_birth = $date_of_birth;

    $member->email = $request->email;
    $member->telephone = $request->telephone;
    $member->mobile = $request->mobile;
    $member->fax = $request->fax;

    $member->is_approve = false;
    $member->is_active = false;
    $member->class_id = $request->class_id;
    $member->save();

    return back();

    // dd(
        // $request->name,
        // $request->email,
        // $request->fax,
        // $request->telephone,
        // $request->mobile,
        // $request->place_of_birth,
        // $request->date_of_birth,
        // $request->gender,
        // $request->class_id
    // );

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
        'namespace' => 'Admin',
        'middleware' => ['auth'],
    ], function () {

    Route::get('home/sosmed', 'HomeController@sosmed')->name('admin.home.sosmed');
    Route::get('data/sosmed', 'HomeController@loadSosmed');
    Route::patch('home/edit/sosmed/{sosmed}', 'HomeController@editSosmed');

    Route::get('home/image-slider', 'HomeController@imageSlider')->name('admin.home.imageSider');
    Route::get('data/image-slider', 'HomeController@loadImageSlider');
    Route::post('home/add/image-slider', 'HomeController@addImageSlider');
    Route::delete('home/delete/image-slider/{imageSlider}', 'HomeController@deleteImageSlider');

    Route::get('home/image-config','ImageConfigController@index');
    Route::get('data/image-config','ImageConfigController@loadImageConfig');
    Route::patch('home/update/image-config/{imageConfig}', 'ImageConfigController@update');


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
    	| A D M I N   A B O U T   C L A S S E S   P R O F I L E   R O U T E S
    	|--------------------------------------------------------------------------
    	|
    	*/
    	Route::get('/class', 'ClassesController@index')->name('admin.about.classes');
    	Route::get('/data/class', 'ClassesController@loadClasses');
        Route::post('/add/class', 'ClassesController@store');
    	Route::patch('/update/class/{class}', 'ClassesController@update');
        Route::delete('/delete/class/{class}', 'ClassesController@destroy');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   A B O U T   S H O W C A S E   G A L L E R Y
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/showcase', 'GalleryController@index')->name('admin.about.gallery_showcase');
        Route::get('/data/showcase', 'GalleryController@loadGallery');
        Route::patch('/update/showcase/{gallery}', 'GalleryController@update');


        /*
        |--------------------------------------------------------------------------
        | A D M I N   A B O U T   G A L L E R Y   P R O F I L E   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/shop-showcase', 'ShopShowcaseController@index')->name('admin.about.shop_showcase');
        Route::get('/data/shop-showcase', 'ShopShowcaseController@loadShop');
        Route::patch('/update/shop-showcase/{shopItem}', 'ShopShowcaseController@update');

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
        Route::get('/list/image/{param}', 'ImageController@index')->name('admin.event.image');
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
        Route::get('/list/image/{param}', 'ImageController@index')->name('admin.shop.image');
        Route::get('/data/image/{param}', 'ImageController@loadImageList');
        Route::post('/add/image', 'ImageController@store');
        Route::patch('/update/image/{shopImage}', 'ImageController@update');
        Route::delete('/delete/image/{shopImage}', 'ImageController@destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | A D M I N   B O O K K E P I N G   R O U T E S
    |--------------------------------------------------------------------------
    |
    |  
    |
    */
    Route::group([
        'prefix' => 'bookkeeping',
        'namespace' => 'Bookkeeping',
        'middleware' => ['auth'],
    ], function() {

        /*
        |--------------------------------------------------------------------------
        | A D M I N   B O O K E P I N G   O V E R S E A S   I N Q U I R Y
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/overseas', 'OverseasController@index')->name('admin.bookkeeping.overseas');
        Route::get('/data/overseas', 'OverseasController@loadOverseas');


        /*
        |--------------------------------------------------------------------------
        | A D M I N   B O O K E P I N G   P O T E N T I A L   O V E R S E A S   I N Q U I R Y
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/potential', 'OverseasController@potential')->name('admin.bookkeeping.potential');
        Route::get('/data/potential', 'OverseasController@loadPotentialOverseas');
        Route::patch('/update/potensial/{shopInquiry}', 'OverseasController@update');
        Route::delete('/delete/potensial/{shopInquiry}', 'OverseasController@destroy');


        /*
        |--------------------------------------------------------------------------
        | A D M I N   B O O K E P I N G    M E S S A G E
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/message', 'MessageController@index')->name('admin.bookkeeping.potential');
        Route::get('/data/message', 'MessageController@loadMessage');
        Route::patch('/replay/message/{contactMessage}', 'MessageController@sendMail');


        /*
        |--------------------------------------------------------------------------
        | A D M I N    A P P L I C A N T    E V E N T    L I S T
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/applicant-event', 'ApplicantEventController@index')->name('admin.bookeeping.applicant');
        Route::get('/data/applicant-event', 'ApplicantEventController@loadApplicantEvent');


        Route::get('/applicant-event/list/{param}', 'ApplicantEventController@list');
        Route::get('/data/applicant-event/list/{event}', 'ApplicantEventController@loadApplicantList');
        Route::patch('/update/applicant-event/list/{applicantList}', 'ApplicantEventController@update');
        Route::delete('/delete/applicant-event/list/{applicantList}', 'ApplicantEventController@destroy');

    });
});