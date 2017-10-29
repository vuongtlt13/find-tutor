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

Route::get('/', 'MainController@index')->name('index');
Route::get('/findtutor', 'MainController@findTutor')->name('find-tutor');
Route::get('/login', 'MainController@login')->name('login');
Route::get('/register', 'MainController@register')->name('register');

Route::post('/login', 'UserController@login')->name('authentication');
Route::post('/register', 'UserController@register')->name('registration');

Route::get('/search', 'UserController@search')->name('search');
Route::get('/manage/search', 'UserController@tutorSearch')->name('tutor-search');
Route::get('/getinfo', 'UserController@getAdminInfo')->name('get-admin-info');

//Route::get('/complete', 'MainController@completeInfo')->name('complete-info-index');
//Route::post('/complete', 'UserController@completeInfo')->name('complete-info');

Route::middleware(['auth.sentinel'])->group(function () {
    Route::get('/complete', 'MainController@completeInfo')->name('complete-info-index');
    Route::post('/complete', 'UserController@completeInfo')->name('complete-info');

    Route::get('/manage', 'MainController@manage')->name('manage');
    Route::post('/manage/create', 'CourseController@createCourse')->name('add-course');
    Route::post('/manage/update', 'CourseController@updateCourse')->name('update-course');
    Route::post('/manage/delete', 'CourseController@deleteCourse')->name('delete-course');
    Route::post('/manage/changestatus', 'CourseController@changeStatus')->name("change-status");

    Route::post('/admin-manage/changestatus', 'UserController@changeStatus')->name("change-status-admin");

    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/profile', 'UserController@profile')->name('profile');


});