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
    return view('home');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('users', 'User\UserController')->only('show', 'update');
    // ->middleware('selfaccount');
    Route::get('instructor_info/{id}', 'User\UserController@getInstructorInfo')->name('instructor_info');
    Route::resource('courses', 'User\CourseController')->only('index', 'show');
    Route::get('courses/{id}/lectures/{lectureId}', 'User\LectureController@show');
    Route::resource('cart_items', 'User\CartItemController')->only('index');
    Route::get('cart_items/checkout', 'User\BillController@getCheckout')->name('cart_items.checkout.get');
    Route::post('cart_items/checkout', 'User\BillController@postCheckout')->name('cart_items.checkout.post');
    Route::post('cart_items/create', 'User\CartItemController@createNewItem');
    Route::post('cart_items/{action}', 'User\CartItemController@changeStatus');
});

Route::post('districts', 'User\DistrictController@getAllRecord');
Route::post('communes', 'User\CommuneController@getAllRecord');