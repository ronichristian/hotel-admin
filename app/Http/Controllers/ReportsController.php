<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\Role;
use App\User;
use App\Booking;
use App\GuestDetail;
use App\RoomCategory;
use App\BookingDetail;
use App\BookingPayment;
use App\ConfirmedBooking;
use App\Http\Resources\User as UserResources;
use App\Http\Resources\Room as RoomResources;
use App\Http\Resources\Booking as BookingResources;
use App\Http\Resources\BookingDetail as BookingDetailResources;
use App\Http\Resources\BookingPayment as BookingPaymentResources;
use App\Http\Resources\ConfirmedBooking as ConfirmedBookingResources;
use Carbon\Carbon;
use DateTime;
use Auth;
use DB;
use App\Notifications\ReservationConfirmed;
use Illuminate\Support\Facades\Mail;

class ReportsController extends Controller
{
    public function cash_room_reports()
    {
        $currentMonth = date('m');
        
        $room_reports = DB::table('booking_payments')
            ->join('bookings', 'bookings.id', '=', 'booking_payments.booking_id')
            ->join('booking_details', 'booking_details.booking_id', '=', 'booking_payments.booking_id')
            ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
            ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
            ->select('booking_details.room_no', 'room_categories.category_name', 'booking_payments.created_at', 'guest_details.last_name', 'guest_details.first_name', 'bookings.id', 'booking_payments.payment')
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->where('bookings.payment_mode', '=', 'cash')
            ->get();
        
        $total = DB::table('booking_payments')
            ->select(DB::raw('sum(booking_payments.payment) as remit'))
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->where('booking_payments.payment_mode', '=', 'cash')
            ->get();
        
        return [new BookingPaymentResources($room_reports), 'total' => $total];
    }

    public function tof_room_reports()
    {
        $currentMonth = date('m');
        
        $room_reports = DB::table('booking_payments')
            ->join('bookings', 'bookings.id', '=', 'booking_payments.booking_id')
            ->join('booking_details', 'booking_details.booking_id', '=', 'booking_payments.booking_id')
            ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
            ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
            ->select('booking_details.room_no', 'room_categories.category_name', 'booking_payments.created_at', 'guest_details.last_name', 'guest_details.first_name', 'bookings.id', 'booking_payments.payment')
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->where('bookings.payment_mode', '=', 'transfer of funds')
            ->get();
        
        $total = DB::table('booking_payments')
            ->select(DB::raw('sum(booking_payments.payment) as remit'))
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->where('booking_payments.payment_mode', '=', 'transfer of funds')
            ->get();
        
        return [new BookingPaymentResources($room_reports), 'total' => $total];
    }

    public function cash_month_room_report($monthNumber)
    {
        $currentMonth = $monthNumber;
        
        $room_reports = DB::table('booking_payments')
            ->join('bookings', 'bookings.id', '=', 'booking_payments.booking_id')
            ->join('booking_details', 'booking_details.booking_id', '=', 'booking_payments.booking_id')
            ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
            ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
            ->select('booking_details.room_no', 'room_categories.category_name', 'booking_payments.created_at', 'guest_details.last_name', 'guest_details.first_name', 'bookings.id', 'booking_payments.payment')
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->where('booking_payments.payment_mode', '=', 'cash')
            ->get();
        
        $total = DB::table('booking_payments')
            ->select(DB::raw('sum(booking_payments.payment) as remit'))
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->where('booking_payments.payment_mode', '=', 'cash')
            ->get();
        
        return [new BookingPaymentResources($room_reports), 'total' => $total];
    }

    // ----------------------------------------------------------------

    public function cash_bangquet_reports()
    {
        $currentMonth = date('m');
        
        $bangquet_reports = DB::table('bangquet_payments')
            ->join('bangquet_reservations', 'bangquet_reservations.id', '=', 'bangquet_payments.bangquet_id')
            ->join('services', 'services.id', '=', 'bangquet_reservations.venue')
            ->select('bangquet_reservations.event_name', 'bangquet_reservations.created_at', 'services.service_name', 'bangquet_payments.balance')
            ->whereRaw('MONTH(bangquet_payments.created_at) = ?',[$currentMonth])
            ->where('bangquet_reservations.payment_mode', '=', 'cash')
            ->get();
        
        $total = DB::table('bangquet_payments')
            ->select(DB::raw('sum(bangquet_payments.balance) as remit'))
            ->whereRaw('MONTH(bangquet_payments.created_at) = ?',[$currentMonth])
            ->where('bangquet_payments.payment_mode', '=', 'cash')
            ->get();
        
        return [new BookingPaymentResources($bangquet_reports), 'total' => $total];
    }

    public function tof_bangquet_reports()
    {
        $currentMonth = date('m');
        
        $bangquet_reports = DB::table('bangquet_payments')
            ->join('bangquet_reservations', 'bangquet_reservations.id', '=', 'bangquet_payments.bangquet_id')
            ->join('services', 'services.id', '=', 'bangquet_reservations.venue')
            ->select('bangquet_reservations.event_name', 'bangquet_reservations.created_at', 'services.service_name', 'bangquet_payments.balance')
            ->whereRaw('MONTH(bangquet_payments.created_at) = ?',[$currentMonth])
            ->where('bangquet_reservations.payment_mode', '=', 'transfer of funds')
            ->get();
        
        $total = DB::table('bangquet_payments')
            ->select(DB::raw('sum(bangquet_payments.balance) as remit'))
            ->whereRaw('MONTH(bangquet_payments.created_at) = ?',[$currentMonth])
            ->where('bangquet_payments.payment_mode', '=', 'transfer of funds')
            ->get();
        
        return [new BookingPaymentResources($bangquet_reports), 'total' => $total];
    }

    public function cash_month_bangquet_report($monthNumber)
    {
        $currentMonth = $monthNumber;
        
        $bangquet_reports = DB::table('bangquet_payments')
            ->join('bangquet_reservations', 'bangquet_reservations.id', '=', 'bangquet_payments.bangquet_id')
            ->join('services', 'services.id', '=', 'bangquet_reservations.venue')
            ->select('bangquet_reservations.event_name', 'bangquet_reservations.created_at', 'services.service_name', 'bangquet_payments.balance')
            ->whereRaw('MONTH(bangquet_payments.created_at) = ?',[$currentMonth])
            ->where('bangquet_reservations.payment_mode', '=', 'cash')
            ->get();
        
        $total = DB::table('bangquet_payments')
            ->select(DB::raw('sum(bangquet_payments.balance) as remit'))
            ->whereRaw('MONTH(bangquet_payments.created_at) = ?',[$currentMonth])
            ->where('bangquet_payments.payment_mode', '=', 'cash')
            ->get();
        
        return [new BookingPaymentResources($bangquet_reports), 'total' => $total];
    }
}
