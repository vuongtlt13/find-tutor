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

//Route::get('/complete', 'MainController@completeInfo')->name('complete-info-index');
//Route::post('/complete', 'UserController@completeInfo')->name('complete-info');

Route::middleware(['auth.sentinel'])->group(function () {
    Route::get('/complete', 'MainController@completeInfo')->name('complete-info-index');
    Route::post('/complete', 'UserController@completeInfo')->name('complete-info');

    Route::get('/manage', 'MainController@manage')->name('manage');
    Route::post('/manage/create', 'UserController@createCourse')->name('add-course');

    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/profile', 'UserController@profile')->name('profile');

});