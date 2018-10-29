<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::group([
	'prefix' => 'about',
	'namespace' => 'About',
], function () {

	Route::get('/', function () { 
		return view('about.index');
	})->name('about.index');
});

Route::group([
	'prefix' => 'gallery',
	'namespace' => 'Gallery',
], function () {

	Route::get('/', function () { 
		return view('gallery.index');
	})->name('gallery.index');
});

Route::group([
	'prefix' => 'event',
	'namespace' => 'Event',
], function () {

	Route::get('/', function () { 
		return view('event.index');
	})->name('event.index');
});

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

Route::group([
	'prefix' => 'contact',
	'namespace' => 'Contact',
], function () {

	Route::get('/', function () { 
		return view('contact.index');
	})->name('contact.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
        'prefix' => 'admin',
        'namespace' => 'admin',
        'middleware' => ['auth'],
    ], function () {

    Route::get('home', 'HomeController@index');
    Route::get('data/sosmed', 'HomeController@loadSosmed');
    Route::patch('/sosmed/{sosmed}', 'HomeController@editSosmed');

});