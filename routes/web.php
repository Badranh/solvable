<?php
//Index
Auth::routes();
Route::get('/', 'HomeController@index','workshop');
Route::get('/home', 'HomeController@home')->name('home')->middleware('auth','approved','workshop');

//Admin Routes
//View users waiting for approval
Route::get('/admin/approve','AdminController@getusers')->middleware('auth','admin','approved')->name('review');
//Approve a user
Route::post('/admin/approve','AdminController@approve')->middleware('auth','admin','approved');

//Workshop
//Create a workshop
Route::post('/workshop/create', 'WorkshopController@store')->name('workshop.create')->middleware('auth','approved','workshop');
//Join a workshop
Route::post('/workshop/join', 'UserController@joinWorkshop')->name('workshop.join')->middleware('auth','approved','workshop');
//Start a workshop
Route::post('/workshop/begin', 'WorkshopController@initialize')->name('workshop.begin')->middleware('auth','approved');
//Finish a workshop
Route::post('/workshop/end', 'WorkshopController@finalize')->name('workshop.end')->middleware('auth','approved');
//View current workshop
Route::get('/workshop', 'WorkshopController@view')->name('workshop.view')->middleware('auth','approved');
//View a workshop from history
Route::get('/workshop/view', 'WorkshopController@viewHistory')->name('workshop.history')->middleware('auth','approved','workshop');

//User
//Create workshop form
Route::get('/create', function () {
    return view('User/createworkshop');
})->middleware('auth','approved','workshop');
//Join workshop form
Route::get('/join', function () {
    return view('User/joinworkshop');
})->middleware('auth','approved','workshop');
//History form
Route::get('/history', 'UserController@history')->middleware('auth','approved','workshop');

//Card
//Create a card
Route::post('/card/create', 'UserController@createCard')->name('card.create')->middleware('auth','approved');
//Rate a card
Route::post('/card/rate', 'UserController@rateCard')->name('card.rate')->middleware('auth','approved');

//Errors
Route::get('/notadmin', function () {
    return view('notadmin');
})->name('notadmin');
Route::get('/notapproved', function () {
    return view('auth/not_approved');
})->name('not_approved');