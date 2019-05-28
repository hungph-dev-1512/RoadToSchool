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

Route::get('/', 'HomeController@index')->middleware(['locale']);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware(['locale'])->name('home');

Route::middleware('auth', 'verified', 'locale')->group(function () {
    Route::resource('users', 'User\UserController')->only('show', 'update');
    // ->middleware('selfaccount');
    Route::get('instructor_info/{id}', 'User\UserController@getInstructorInfo')->name('instructor_info');
    Route::resource('courses', 'User\CourseController')->only('index', 'show');
    Route::get('courses/{id}/lectures/{lectureId}', 'User\LectureController@show')->middleware('access_lecture');
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
    // Course Like
    Route::post('/courses/{courseId}/like/{userId}/changeStatus/{status}', 'User\CourseController@changeLikeStatus');
    // Change process Status
    Route::post('/lectures/{lectureId}/user/{userId}/changeProcessStatus', 'User\ProcessController@changeProcessStatus');
    Route::resource('quiz_results', 'User\QuizResultController')->only('store');
    Route::post('/quiz_results/storeNewResult', 'User\QuizResultController@storeNewResult');
    Route::post('/quiz_element_quiz_result/storeNewRecord', 'User\QuizElementzQuizResultController@storeNewRecord');
    Route::get('/courses/{id}/lectures/{lectureId}/getResult', 'User\LectureController@showQuizResult')->name('quiz.result')->middleware('access_lecture');
    Route::post('/courses/{courseId}/postAppreciate', 'User\CourseController@postAppreciate');
    Route::post('/conversations/store', 'User\ConversationController@store')->name('conversations.store');
    Route::post('/conversations/{conversationId}/storeNewMessage', 'User\ConversationController@storeNewMessage')->name('conversations.storeNewMessage');
    Route::post('/conversations/{conversationId}/changeConversationStatus', 'User\ConversationController@changeConversationStatus')->name('conversations.changeConversationStatus');
    Route::get('/courses/{userId}/my_course', 'User\CourseController@getMyCourse')->name('courses.my_course');
    Route::post('/categories/{categoryId}/getSubCategoryList', 'User\CategoryController@getSubCategoryList');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['access_page', 'is_admin', 'verified', 'locale']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/users/instructor_ranking', 'UserController@getInstructorRanking')->name('instructor_ranking');
    Route::get('/users/create_instructor', 'UserController@createNewInstructor')->name('users.create_instructor');
    Route::resource('users', 'UserController')->except('create', 'store', 'update');
    Route::post('users/{id}/updateUser', 'UserController@updateUser');
    Route::resource('specializes', 'SpecializeController')->except('create', 'show');
    Route::resource('categories', 'CategoryController')->except('create');
    Route::resource('courses', 'CourseController')->except('create', 'store');
    Route::post('courses/{id}/active', 'CourseController@acceptCourse')->name('active-course');
    Route::resource('bills', 'BillController')->only('index', 'create', 'show');
    Route::post('bills/status/update', 'BillController@updateStatus')->name('bills.updateStatus');
    Route::resource('permissions', 'PermissionController')->only('index', 'create', 'store');
    Route::post('/permissions/getPermission/{userId}', 'PermissionController@getPermission')->name('permissions.getPermission');
    Route::post('/permissions/updatePermission/{userId}', 'PermissionController@updatePermission')->name('permissions.updatePermission');
    Route::get('/lectures/requests', 'LectureController@getRequestList')->name('lectures.requests.index');
    Route::post('/lectures/postAccept', 'LectureController@acceptLectureRequest')->name('lectures.requests.accept');
    Route::get('/conversations/waiting', 'ConversationController@getWaitingList')->name('conversations.waiting');
    Route::post('/users/create_new_instructor', 'UserController@storeNewInstructor')->name('users.store_new_instructor');
});

Route::group(['namespace' => 'Instructor', 'prefix' => 'instructor', 'as' => 'instructor.', 'middleware' => ['access_page', 'verified', 'locale']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('courses', 'CourseController')->only('index', 'create', 'store', 'show');
    Route::get('courses/{courseId}/lectures/create', 'LectureController@create')->name('courses.lectures.create');
    Route::post('courses/{courseId}/lectures/store', 'LectureController@store')->name('courses.lectures.store');
});

Route::post('districts', 'User\DistrictController@getAllRecord');
Route::post('communes', 'User\CommuneController@getAllRecord');
Route::post('/youtube/getVideoDuration', 'Instructor\LectureController@getVideoDuration');
Route::get('/change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');