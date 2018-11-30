    <?php
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

Route::get('/','HomeController@index')->name('home');
Route::get('*','HomeController@index');
Route::post('member','HomeController@addMember');


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

    Route::get('/','AboutController@index')->name('about.index');

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

    Route::get('/','GalleryController@index')->name('gallery.index');

    Route::get('/all','GalleryController@getAll');

    Route::get('category/{category}','GalleryController@getCategory');

    Route::get('category/{category}','GalleryController@getCategory');

    Route::get('/subcategory/{subcategory}','GalleryController@getSubcategory');

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

    Route::get('/','EventController@index')->name('event.index');

    Route::get('/single/{event}','EventController@getSingle');

    Route::get('/past/all','EventController@getAllpast');

    Route::get('/upcoming/all','EventController@getAllUpcoming');

    Route::get('/past/subcategory/{subcategory}','EventController@getPastSubcategory');
    
    Route::get('/upcoming/subcategory/{subcategory}','EventController@getUpcomingSubcategory');

    Route::get('single/images/{event}','EventController@getSingleImage');

    Route::post('/registration/{event}', 'EventController@registration');

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

    Route::get('/','ShopController@index')->name('shop.index');

    Route::get('/item/{shopItem}','ShopController@getItems');

    Route::get('/item/images/{shopItem}','ShopController@getImageItems');

    Route::get('/all','ShopController@getAll');

    Route::get('/category/{category}','ShopController@getCategory');

    Route::get('/subcategory/{subcategory}','ShopController@getSubcategory');

    Route::post('/update/overseas/{shopItem}','ShopController@overseasInquiry');

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

    Route::get('/','ContactController@index')->name('contact.index');

    Route::post('contact_message','ContactController@message');

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
        | A D M I N   A B O U T   T I M E L I N E   R O U T E S
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/timeline', 'TimelineController@index')->name('admin.about.timeline');
        Route::get('/data/timeline', 'TimelineController@loadTimelines');
        Route::post('/add/timeline', 'TimelineController@store');
        Route::patch('/update/timeline/{timeline}', 'TimelineController@update');
        Route::delete('/delete/timeline/{timeline}', 'TimelineController@destroy');

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
        Route::get('/member', 'MemberController@member')->name('admin.bookkeeping.member');
        Route::get('/member-detail', 'MemberController@memberDetail');
        Route::get('/data/members', 'MemberController@loadMembers');
        Route::get('/data/teacher_student', 'MemberController@loadTeacherAndStudent');
        Route::get('/data/rank', 'MemberController@loadRank');
        Route::get('/data/class', 'MemberController@loadClass');
        Route::get('/data/subscription', 'MemberController@loadSubscription');
        Route::get('/data/region', 'MemberController@loadClassRegion');
        Route::post('/add/member', 'MemberController@addMember');
        Route::patch('/update/member/{member}', 'MemberController@updateMember');
        Route::delete('/delete/member/{member}', 'MemberController@deleteMember');

        Route::post('/add/rank', 'MemberController@addRank');
        Route::patch('/delete/rank', 'MemberController@deleteRank');
        Route::patch('/update/rank', 'MemberController@updateRank');

        Route::post('/add/subscription', 'MemberController@addSubscription');
        Route::delete('/delete/subscription/{subscription}', 'MemberController@deleteSubscription');

        Route::post('/add/class_region', 'MemberController@addClassRegion');
        Route::patch('/delete/class_region', 'MemberController@deleteClassRegion');

        Route::post('/add/class_member', 'MemberController@addClass');
        Route::delete('/delete/class_member/{member}/{class}', 'MemberController@deleteClass');

        /*
        |--------------------------------------------------------------------------
        | A D M I N   B O O K E P I N G   R E G I O N
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/region', 'RegionController@index')->name('admin.bookkeeping.region');
        Route::get('/data/region', 'RegionController@loadRegion');
        Route::post('/add/region', 'RegionController@addRegion');
        Route::patch('/update/region/{region}', 'RegionController@editRegion');
        Route::delete('/delete/region/{region}', 'RegionController@deleteRegion');


        /*
        |--------------------------------------------------------------------------
        | A D M I N   B O O K E P I N G   A P P L I C A N T   M E M B E R
        |--------------------------------------------------------------------------
        |
        */
        Route::get('/applicant-member', 'MemberController@applicant')->name('admin.bookkeeping.applicant_member');
        Route::get('/data/applicant-member', 'MemberController@loadApplicantMember');
        Route::patch('/update/applicant-member/{member}', 'MemberController@update');
        Route::delete('/delete/applicant-member/{member}/{class}', 'MemberController@destroy');


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