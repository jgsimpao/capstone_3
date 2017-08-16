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

Auth::routes();

Route::get('/', function() {
	return view('index');
});

Route::get('/home', function() {
	return view('home');
});

Route::get('/about', function() {
	return view('about');
});

Route::get('/rooms', 'RoomController@displayRooms');

Route::get('/rooms/{id}', 'RoomController@displayDetails');

Route::get('/reserve', 'ReservationController@displayReservations');

Route::get('/reserve/{id}', 'ReservationController@displayStatus');

Route::get('/contact', function() {
	return view('contact');
});

Route::post('/contact', 'ContactController@sendMessage');

Route::post('/edit/details/{id}', 'RoomController@editDetails');

Route::post('/add/reserve/{id}', 'ReservationController@addReserve');

Route::post('/approve/pending/{id}', 'ReservationController@approvePending');

Route::post('/reject/pending/{id}', 'ReservationController@rejectPending');

Route::post('/delete/reserve/{id}', 'ReservationController@deleteReserve');
