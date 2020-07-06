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
    public function room_reports()
    {
        $currentMonth = date('m');
        
        $room_reports = DB::table('booking_payments')
            ->join('bookings', 'bookings.id', '=', 'booking_payments.booking_id')
            ->join('booking_details', 'booking_details.booking_id', '=', 'booking_payments.booking_id')
            ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
            ->select('booking_payments.created_at', 'guest_details.last_name', 'guest_details.first_name', 'bookings.id', 'booking_payments.payment')
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->get();
        
        $total = DB::table('booking_payments')
        ->select(DB::raw('sum(booking_payments.payment) as remit'))
        ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
        ->get();
        
        return [new BookingPaymentResources($room_reports), 'total' => $total];
    }

    public function month_room_report($monthNumber)
    {
        $currentMonth = $monthNumber;
        
        $room_reports = DB::table('booking_payments')
            ->join('bookings', 'bookings.id', '=', 'booking_payments.booking_id')
            ->join('booking_details', 'booking_details.booking_id', '=', 'booking_payments.booking_id')
            ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
            ->select('booking_payments.created_at', 'guest_details.last_name', 'guest_details.first_name', 'bookings.id', 'booking_payments.payment')
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->get();
        
        $total = DB::table('booking_payments')
        ->select(DB::raw('sum(booking_payments.payment) as remit'))
        ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
        ->get();
        
        return [new BookingPaymentResources($room_reports), 'total' => $total];
    }

    public function specific_room_reports()
    {
        $currentMonth = date('m');
        
        $specific_room_reports = DB::table('booking_payments')
            ->join('bookings', 'bookings.id', '=', 'booking_payments.booking_id')
            ->join('booking_details', 'booking_details.booking_id', '=', 'booking_payments.booking_id')
            ->join('room_categories', 'booking_details.room_cat_id', '=', 'room_categories.id')
            ->select('category_name', DB::raw('sum(booking_details.total) as total_cost'))
            ->groupBy('category_name', 'total')
            ->distinct()
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->get();
        
        
        $total = DB::table('booking_payments')
            ->select(DB::raw('sum(booking_payments.payment) as remit'))
            ->whereRaw('MONTH(booking_payments.created_at) = ?',[$currentMonth])
            ->get();
        
        return [new BookingPaymentResources($specific_room_reports), 'total' => $total];
    }
}
