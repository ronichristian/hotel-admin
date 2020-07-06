<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Dispaly Rooms
Route::get('/display_rooms', 'RoomsController@display_rooms');
Route::get('/get_all_rooms', 'RoomsController@get_all_rooms');
// Get Bookings 
Route::get('/bookings', 'ReservationController@index');
// Get Room Detail 
Route::get('/get_room_detail/{id}', 'RoomsController@get_room_detail');


// ---------------


// Display All Bookings
Route::get('admin_bookings', 'BookingsController@index');
// Display Booking Details
Route::get('admin_bookings_details/{id}', 'BookingsController@admin_bookings_details');
Route::get('booking_detail/{id}', 'BookingsController@booking_detail');
// Book a Room
Route::post('book_room', 'BookingsController@book_room');
Route::post('walk_in_reservation', 'BookingsController@walk_in_reservation');
// Accept Booking 
Route::post('accept_booking', 'BookingsController@accept_booking');
// Check In Booking
Route::put('check_in', 'BookingsController@check_in');
// Check Out Booking 
Route::put('check_out', 'BookingsController@check_out');
// Cancel Booking
Route::put('cancel', 'BookingsController@cancel');
// Get Available Rooms 
Route::post('available_rooms', 'BookingsController@available_rooms');
// Get Available Rooms 
Route::delete('delete_booking/{id}', 'BookingsController@delete_booking');


// Display Room Types
Route::get('display_room_types', 'RoomsController@display_room_types');
// Store Room Type
Route::post('room', 'RoomsController@store');
// Update Room Type
Route::put('room', 'RoomsController@store');
// Delete Room Type
Route::delete('room/{id}', 'RoomsController@destroy');


// Add Room Number
Route::post('add_room_number', 'RoomsController@add_room_number');
// Get Rooms By ID
Route::get('get_rooms/{id}', 'RoomsController@get_rooms');
// Delete Room Number
Route::delete('delete_room_number/{id}', 'RoomsController@delete_room_number');


// Display Services Types
Route::get('display_services', 'ServicesController@index');
// Store Service Type
Route::post('service', 'ServicesController@store');
// Update Service Type
Route::put('service', 'ServicesController@store');
// Delete Service Type
Route::delete('service/{id}', 'ServicesController@destroy');


// Display Other Charges
Route::get('get_other_charges', 'ServicesController@get_other_charges');
// Add Other Charge
Route::post('charge', 'ServicesController@add_charge');
// Edit Other Charges
Route::put('charge', 'ServicesController@add_charge');
// Delete Other Charges
Route::delete('charge/{id}', 'ServicesController@delete_charge');



// Get Rooms Status
Route::get('room_status', 'RoomsController@room_status');
// Admin Calculate
Route::get('calculate/{id}', 'BookingsController@calculate');


// Payment
Route::post('payment', 'BookingsController@payment');
// Update Payment 
Route::post('update_payment', 'BookingsController@update_payment');
// Get Rooms Status
Route::get('get_booking/{id}', 'BookingsController@get_booking');


// Room Reports
Route::get('room_reports', 'ReportsController@room_reports');
// Specific Room Reports
Route::get('specific_room_reports', 'ReportsController@specific_room_reports');
// Room Reports By Month
Route::get('month_room_report/{id}', 'ReportsController@month_room_report');
// Get all specific booking details
Route::get('get_bookings', 'BookingsController@get_bookings');
// Get Current Booking
Route::put('updateCurrentBooking', 'BookingsController@updateCurrentBooking');



// Get Current Booking
Route::get('get_venues', 'BangquetController@index');
// Store Bangquet Reservation
Route::post('reserve_bangquet', 'BangquetController@store');
// Store Bangquet Reservation
Route::get('get_bangquet_reservations', 'BangquetController@get_bangquet_reservations');
// Get Rooms Status
Route::get('get_bangquet_reservation/{id}', 'BangquetController@get_bangquet_reservation');
// Get Rooms Status
Route::put('bangquetReservationUpdate', 'BangquetController@bangquetReservationUpdate');

// Bangquet Payment
Route::post('bangquet_payment', 'BangquetController@bangquet_payment');

