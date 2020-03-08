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

//TEST ROUTES REMOVE WHEN DONE!
Route::get('/test', function () {
    return view('test');
});

//Index
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home')->name('home')->middleware('auth','approved');

//Admin Routes
Route::get('/admin/approve','AdminController@getusers')->middleware('auth','admin','approved')->name('review');
Route::post('/admin/approve','AdminController@approve')->middleware('auth','admin','approved');

//Workshop
Route::post('/workshop/create', 'WorkshopController@store')->name('workshop.create')->middleware('auth','approved');
Route::post('/workshop/join', 'UserController@joinWorkshop')->name('workshop.join')->middleware('auth','approved');
Route::post('/workshop/begin', 'WorkshopController@initialize')->name('workshop.begin')->middleware('auth','approved');
Route::get('/workshop', 'WorkshopController@view')->name('workshop.view')->middleware('auth','approved');

//User
Route::get('/create', function () {
    return view('User/createworkshop');
})->middleware('auth','approved');
Route::get('/join', function () {
    return view('User/joinworkshop');
})->middleware('auth','approved');

//Card
Route::post('/card/create', 'UserController@createCard')->name('card.create')->middleware('auth','approved');
Route::post('/card/rate', 'UserController@rateCard')->name('card.rate')->middleware('auth','approved');

//Errors
Route::get('/notadmin', function () {
    return view('notadmin');
})->name('notadmin');
Route::get('/notapproved', function () {
    return view('auth/not_approved');
})->name('not_approved');