<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\BookingDetail;
use App\RoomCategory;
use App\Rooms;
use Carbon\Carbon;
use Auth;
use DB;
use Calendar;

class PagesController extends Controller
{
    public function admin_create_accounts() 
    {
        return view('admin_side.admin_create_accounts');
    }

    public function index()
    {
        return view('client_side.index');
    }
    
    public function reservation()
    {
        return view('client_side.reservation');
    }

    public function reservation_detail($id)
    {
        $booking_details = DB::table('bookings')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('users', 'users.id', '=', 'bookings.user_id')
        ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
        ->select('room_categories.category_name', 
                'room_categories.room_rate',
                'booking_details.check_in', 
                'booking_details.check_out', 
                'booking_details.nights', 
                'booking_details.status', 
                'booking_details.total',
                'booking_details.room_no', 
                'bookings.number_of_rooms',
                'bookings.id')
        ->where('bookings.id', '=', $id)
        ->get();


        return view('client_side.reservation_detail', ['booking_details' => $booking_details]);
    }

    public function room_detail($id)
    {

        $room_detail = DB::table('rooms')
        ->join('room_categories', 'room_categories.id', '=', 'rooms.room_cat_id')
        ->select('rooms.room_cat_id', 'room_categories.category_name','room_categories.room_rate', 'room_categories.facilities', 'room_categories.persons', DB::raw('count(rooms.room_cat_id) as count_room'))
        ->groupBy('rooms.room_cat_id', 'room_categories.category_name', 'room_categories.room_rate', 'room_categories.facilities', 'room_categories.persons')
        ->where('rooms.room_cat_id', '=', $id)
        ->get();
        return view('client_side.room_detail',['room_detail' => $room_detail]);
    }

    public function all_available_rooms_by_date(Request $request)
    {
        $date_start = date('Y-m-d', strtotime($request['checkin_date']));
        $date_end = date('Y-m-d', strtotime($request['checkout_date']));
        $number_of_rooms = $request['number_of_rooms'];
        $number_of_guests = $request['number_of_guests'];
        $nights = Carbon::parse($date_end)->diffInDays($date_start);
        
        $rooms = DB::table('rooms')
        ->join('room_categories', 'room_categories.id', '=', 'rooms.room_cat_id')
        // ->select(DB::raw("count(rooms.room_cat_id) as count_room"), 'room_categories.room_rate', 'room_categories.persons', 'room_categories.category_name', 'room_categories.facilities', 'rooms.room_cat_id')
        ->select('room_categories.room_rate', 'room_categories.persons', 'room_categories.category_name', 'room_categories.facilities', 'rooms.room_cat_id')
        ->groupBy('rooms.room_cat_id', 'room_categories.persons', 'room_categories.room_rate', 'room_categories.category_name', 'room_categories.facilities', 'rooms.room_cat_id')
        ->where('room_categories.persons', '>=', $number_of_guests)
        // ->having('count_room', '>=', $number_of_rooms)
        ->whereNotIn('rooms.room_no', 
            function($query) use ($date_start, $date_end) {
            $query->from('booking_details')
             ->select('room_no')
             ->where('check_in', '<=', $date_end)
             ->where('check_out', '>=', $date_start)
             ->where('status', '!=', 'checkout');
        })
        ->orderBy('room_categories.room_rate', 'desc')
        ->distinct()
        ->get();
        

        return view('client_side.available_rooms', ['rooms' => $rooms, 'date_start' => $date_start, 'date_end' => $date_end, 'nights' => $nights, 'number_of_rooms' => $number_of_rooms]);
    }
    
    public function reservation_sent(Request $request, $id)
    {

        $details = DB::table('bookings')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
        ->select('guest_details.first_name',
                'guest_details.last_name',
                'guest_details.mi',
                'bookings.created_at')
        ->where('bookings.id', '=', $id)
        ->get();

        $header = "Your Reservation request has been sent. Please wait for the confirmation of your request, the confirmation will be sent to your email address.";
        $footer = "Your Reservation No. is ".$id.", and you are expected on the day of your arrival. 
        If you find necessary to cancel or change plans, please inform us before 2:00pm on your arrival date to avoid one night's room";

        return view('client_side.reservation_sent', ['details' => $details, 'footer' => $footer, 'header' => $header]);
    }

    public function booking_accepted(Request $request, $id)
    {
        $bookings_details = DB::table('bookings')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
        ->select('room_categories.category_name', 
                'room_categories.room_rate',
                'booking_details.check_in', 
                'booking_details.check_out', 
                'booking_details.nights', 
                'booking_details.total',
                'bookings.grand_total',
                'bookings.id',
                'guest_details.first_name',
                'guest_details.last_name',
                'guest_details.mi')
        ->where('bookings.id', '=', $id)
        ->get();

        $details = DB::table('bookings')
        ->select('bookings.id', 'bookings.updated_at')
        ->where('bookings.id', '=', $id)
        ->get();

        $header = "Your Reservation request has been accepted. We have reserved the following accomodations for you";
        $footer = "Your Reservation No. is #".$id.", and you are expected on the day of your arrival. 
        If you find necessary to cancel or change plans, please inform us before 2:00pm on your arrival date to avoid one night's room";

        return view('admin_side.booking_accepted', ['bookings_details' => $bookings_details, 'footer' => $footer, 'header' => $header, 'details' => $details]);
    }



    public function admin()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $users = DB::table('role_user')->select(DB::raw("count(role_user.user_id) as count_users"))->where('role_user.role_id', '=', 2)->get();

        $reserved = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_reserved'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'reserved')->get();
        $occupied = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_occupied'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'occupied')->get();
        $pending = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_pending'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'pending')->get();
        $checkout = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_checkout'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'checkout')->get();



        return view('admin_side.index', [
            'reserved' => $reserved,
            'occupied' => $occupied,
            'pending' => $pending,
            'checkout' => $checkout, 
            'users' => $users]
        );
    }

    public function admin_room_bookings()
    {
        $booking_details = DB::table('bookings')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->select('room_categories.category_name', 
                'room_categories.room_rate', 
                'booking_details.room_cat_id',
                'booking_details.id', 
                'booking_details.booking_id',
                'booking_details.room_cat_id', 
                'booking_details.check_in',
                'booking_details.check_out',
                'booking_details.nights',
                'booking_details.status',
                'booking_details.total',
                'booking_details.room_no',
                'bookings.number_of_rooms',
                'guest_details.last_name',
                'guest_details.first_name')
        ->where('booking_details.status', '!=', 'cancelled')
        ->orderBy('booking_id', 'desc')
        ->get();
        
        $events = [];
        $data = $booking_details;
        $color = '';
        if($data->count()) {
            foreach ($data as $key => $value) {
                
                if($value->status == 'occupied'){
                    $color = '#0275d8';
                }else if($value->status == 'reserved'){
                    $color = '#5cb85c';
                }else if($value->status == 'checkout'){
                    $color = '#d9534f';
                }else if($value->status == 'pending'){
                    $color = '#f0ad4e';
                }
               
                $events[] = Calendar::event(
                    $value->booking_id,
                    true,
                    new \DateTime($value->check_in),
                    new \DateTime($value->check_out.' +1 day'),
                    null,
	                [ 
                        'color' => $color,
                        'title' => 'Room No. (' . $value->room_no . ')' . ' - '.  $value->last_name . ', ' . $value->first_name ,
                        'url' => '#',
                        // 'url' => 'booking_detail/'.$value->booking_id,
	                ]
                );
            }
        }
        $calendar = Calendar::addEvents($events)
                ->setOptions([
                    'firstDay' => 1,
                    'editable'    => true,
                    'selectable'  => true,
                    'defaultView' => 'agendaWeek',
                    'minTime' => '05:00:00',
                    'maxTime' => '22:00:00',
                ])
                ->setCallbacks([
                    'eventClick' => 'function(event) {  $("#bookingDetail").modal(); }',
                ]);
        $room_categories = RoomCategory::all();
        return view('admin_side.admin_room_bookings', ['calendar' => $calendar, 'room_categories' => $room_categories]);
    }

    public function admin_bangquet_reservation()
    {
        $booking_details = DB::table('bookings')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->select('room_categories.category_name', 
                'room_categories.room_rate', 
                'booking_details.room_cat_id',
                'booking_details.id', 
                'booking_details.booking_id',
                'booking_details.room_cat_id', 
                'booking_details.check_in',
                'booking_details.check_out',
                'booking_details.nights',
                'booking_details.status',
                'booking_details.total',
                'booking_details.room_no',
                'bookings.number_of_rooms',
                'guest_details.last_name',
                'guest_details.first_name')
        ->where('booking_details.status', '!=', 'cancelled')
        ->orderBy('booking_id', 'desc')
        ->get();
        
        $events = [];
        $data = $booking_details;
        $color = '';
        if($data->count()) {
            foreach ($data as $key => $value) {
                
                if($value->status == 'occupied'){
                    $color = '#0275d8';
                }else if($value->status == 'reserved'){
                    $color = '#5cb85c';
                }else if($value->status == 'checkout'){
                    $color = '#d9534f';
                }else if($value->status == 'pending'){
                    $color = '#f0ad4e';
                }
               
                $events[] = Calendar::event(
                    $value->booking_id,
                    true,
                    new \DateTime($value->check_in),
                    new \DateTime($value->check_out.' +1 day'),
                    null,
	                [ 
                        'color' => $color,
                        'title' => 'Room No. (' . $value->room_no . ')' . ' - '.  $value->last_name . ', ' . $value->first_name ,
                        'url' => '#',
                        // 'url' => 'booking_detail/'.$value->booking_id,
	                ]
                );
            }
        }
        $calendar = Calendar::addEvents($events)
                ->setOptions([
                    'firstDay' => 1,
                    'editable'    => true,
                    'selectable'  => true,
                    'defaultView' => 'agendaWeek',
                    'minTime' => '05:00:00',
                    'maxTime' => '22:00:00',
                ])
                ->setCallbacks([
                    'eventClick' => 'function(event) {  $("#bookingDetail").modal(); }',
                ]);
        $room_categories = RoomCategory::all();
        return view('admin_side.admin_bangquet_reservation', ['calendar' => $calendar, 'room_categories' => $room_categories]);
    }

    public function admin_rooms()
    {
        return view('admin_side.admin_rooms');
    }

    public function admin_services()
    {
        return view('admin_side.admin_services');
    }

    public function admin_halls()
    {
        return view('admin_side.admin_halls');
    }

    public function admin_rooms_status()
    {
        return view('admin_side.admin_rooms_status');
    }

    public function admin_bookings()
    {
        return view('admin_side.admin_bookings');
    }

    public function booking_detail($id)
    {
        DB::table('bookings')
        ->where('bookings.id', $id)
        ->update(['viewed_status' => 1]);

        $booking_details = DB::table('bookings')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->select('room_categories.category_name', 
                'room_categories.room_rate', 
                'booking_details.room_cat_id',
                'booking_details.id', 
                'booking_details.booking_id',
                'booking_details.room_cat_id', 
                'booking_details.check_in',
                'booking_details.check_out',
                'booking_details.nights',
                'booking_details.status',
                'booking_details.total',
                'booking_details.room_no',
                'bookings.number_of_rooms',
                'guest_details.last_name',
                'guest_details.first_name')
        ->where('bookings.id', '=', $id)
        ->get();
        $get_date = DB::table('bookings')->select('bookings.created_at', 'bookings.id')->where('bookings.id', '=', $id)->get();
        $get_grand_total = DB::table('bookings')->select('bookings.grand_total')->where('bookings.id', '=', $id)->get();
        $date = date('m/d/Y', strtotime($get_date[0]->created_at));
        $grand_total = $get_grand_total[0]->grand_total;

        $booking = DB::table('bookings')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->select('guest_details.first_name', 'guest_details.last_name', 'guest_details.mi', 'bookings.grand_total', 'bookings.id', 'bookings.number_of_rooms', 'bookings.paid_status', 'bookings.created_at')
        ->where('bookings.id', '=', $id)
        ->distinct()
        ->get();
        $booking_id = $booking[0]->id;
        $guest_name = $booking[0]->last_name . ', ' . $booking[0]->first_name . ' ' . $booking[0]->mi . '.';
        $grand_total = $booking[0]->grand_total;

        return view('admin_side.admin_booking_detail', ['booking_id' => $booking_id, 'guest_name' => $guest_name, 'grand_total' => $grand_total, 'booking' => $booking, 'booking_details' => $booking_details, 'grand_total' => $grand_total, 'date' => $date]);
    }

    public function admin_room_reports()
    {
        return view('admin_side.admin_room_reports');
    }

    public function admin_bangquet_reports()
    {
        return view('admin_side.admin_bangquet_reports');
    }
    

}
