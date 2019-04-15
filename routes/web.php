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
//    Route::get('/pusher/getComment', function(Illuminate\Http\Request $request) {
//        event(new App\Events\GetCommentFromPusherEvent($request));
//
//        return redirect()->back();
//    });
    Route::post('courses/{courseId}/pusher/postComment', 'User\CourseController@postCommentToPusher')->name('courses.postCommentToPusher');
    Route::post('courses/{courseId}/pusher/replyComment/{parentCommentId}', 'User\CourseController@postReplyCommentToPusher')->name('courses.comment.postReplyCommentToPusher');
//    Route::post('courses/{id}/postComment', 'User\CourseController@createNewComment')->name('courses.comment.store');
//    Route::post('courses/{id}/replyComment/{commentId}', 'User\CourseController@replyComment')->name('courses.comment.store_reply');
    Route::resource('notifications', 'User\NotificationController')->only('index');
    Route::post('notifications/{id}/changeStatus', 'User\NotificationController@changeStatus');
    Route::post('discussions/pusher/pushNewDiscussion', 'User\DiscussionController@createNewDiscussion');
    Route::post('lectures/{lectureId}/pusher/postComment', 'User\LectureController@postCommentToPusher')->name('lectures.postCommentToPusher');
    Route::post('lectures/{lectureId}/pusher/replyLectureComment/{parentCommentId}', 'User\LectureController@postReplyLectureCommentToPusher')->name('lectures.comment.postReplyCommentToPusher');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/users/instructor_ranking', 'UserController@getInstructorRanking')->name('instructor_ranking');
    Route::resource('users', 'UserController')->except('create', 'store', 'update');
    Route::post('users/{id}/updateUser', 'UserController@updateUser');
    Route::resource('specializes', 'SpecializeController')->except('create', 'show');
    Route::resource('categories', 'CategoryController')->except('create');
    Route::resource('courses', 'CourseController')->except('create', 'store');
    Route::get('courses/{id}/active', 'CourseController@active')->name('active-course');
    Route::resource('bills', 'BillController')->only('index', 'create', 'show');
    Route::post('bills/status/update', 'BillController@updateStatus');
});

Route::post('districts', 'User\DistrictController@getAllRecord');
Route::post('communes', 'User\CommuneController@getAllRecord');