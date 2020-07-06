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

Route::get('/', 'PagesController@admin');
Route::get('/client', 'PagesController@index')->middleware('auth')->name('client');
Route::get('/reservation', 'PagesController@reservation')->middleware('auth');
Route::get('/reservation_detail/{id}', 'PagesController@reservation_detail')->name('reservation_detail');
Route::get('/room_detail/{id}', 'PagesController@room_detail')->name('room_detail');
Route::post('/all_available_rooms_by_date', 'PagesController@all_available_rooms_by_date');

Route::get('/reservation_sent/{id}', 'PagesController@reservation_sent')->name('reservation_sent');
Route::get('/booking_accepted/{id}', 'PagesController@booking_accepted')->name('booking_accepted');

Route::get('/admin', 'PagesController@admin');
Route::get('/dashboard', 'PagesController@dashboard')->middleware('auth')->name('dashboard');
Route::get('/admin_calendar', 'PagesController@admin_calendar')->middleware('auth')->name('admin_calendar');
Route::get('/admin_bangquet_reservation', 'PagesController@admin_bangquet_reservation')->middleware('auth')->name('admin_daily_room_services');
Route::get('/admin_rooms_status', 'PagesController@admin_rooms_status')->middleware('auth');
Route::get('/admin_rooms', 'PagesController@admin_rooms')->middleware('auth');
Route::get('/admin_services', 'PagesController@admin_services')->middleware('auth');
Route::get('/admin_halls', 'PagesController@admin_halls')->middleware('auth');
Route::get('/admin_bookings', 'PagesController@admin_bookings')->middleware('auth');
Route::get('/booking_detail/{id}', 'PagesController@booking_detail')->middleware('auth');

Route::get('/admin_room_reports', 'PagesController@admin_room_reports')->middleware('auth');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
});



