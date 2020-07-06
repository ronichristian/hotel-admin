<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;use App\Room;
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
// use App\Mail\SendMail;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = ['bookings.id', 'guest_details.last_name', 'guest_details.first_name', 'guest_details.,mi', 'guest_details.email_address', 'bookings.number_of_rooms', 'bookings.grand_total'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = DB::table('bookings')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->select('guest_details.email_address', 'guest_details.first_name', 'guest_details.last_name', 'guest_details.mi', 'bookings.viewed_status', 'bookings.grand_total', 'bookings.id', 'bookings.number_of_rooms', 'bookings.created_at')
        ->orderBy($columns[$column], $dir)
        ->distinct();

        if($searchValue){
            $query->where(function($query) use ($searchValue){
                $query->where('bookings.id', 'like', '%' . $searchValue . '%')->
                orWhere('guest_details.last_name', 'like', '%' . $searchValue . '%')->
                orWhere('guest_details.first_name', 'like', '%' . $searchValue . '%');
            });
        }
        $bookings = $query->paginate($length);
        return ['data' => $bookings, 'draw' => $request->input('draw')];
    }

    public function admin_bookings_details($id)
    {
        $booking_details = DB::table('bookings')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('room_categories', 'room_categories.id', '=', 'booking_details.room_cat_id')
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
                'bookings.number_of_rooms')
        ->where('booking_details.booking_id', '=', $id)
        ->get();
        return new BookingDetailResources($booking_details);
    }

    public function booking_detail($id)
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
                'bookings.paid_status',
                'booking_details.total',
                'booking_details.room_no',
                'bookings.number_of_rooms',
                'guest_details.first_name',
                'guest_details.last_name',
                'bookings.grand_total')
        ->where('booking_details.id', '=', $id)
        ->get();
        return new BookingDetailResources($booking_details);
    }

    public function available_rooms(Request $request)
    {
        $date_start = $request['check_in'];
        // $date_end = Carbon::parse($request['check_out']);
        $date_end = $request['check_out'];
        $rooms = DB::table('rooms')
        ->join('room_categories', 'room_categories.id', '=', 'rooms.room_cat_id')
        ->select('rooms.room_no', 'room_categories.category_name', 'rooms.room_cat_id', 'room_categories.room_rate')
        ->where('rooms.room_cat_id', '=', $request['room_cat_id'])
        ->whereNotIn('rooms.room_no', 
            function($query) use ($date_start, $date_end) {
            $query->from('booking_details')
             ->select('room_no')
             ->where('check_in', '<=', $date_end)
             ->where('check_out', '>=', $date_start)
             ->where('status', '!=', 'checkout');
         })
        ->get();

        if($rooms){
            return new RoomResources($rooms);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Make Reservation
    public function book_room(Request $request, GuestDetail $guest_detail)
    {
        $guest_detail = new GuestDetail;
        $guest_detail->last_name = $request['last_name'];
        $guest_detail->first_name = $request['first_name'];
        $guest_detail->mi = $request['mi'];
        $guest_detail->email_address = $request['email_address'];
        $guest_detail->address = $request['address'];
        $guest_detail->contact_number = $request['contact_number'];
        $guest_detail->purpose = $request['purpose'];
        $guest_detail->gender = $request['gender'];
        $guest_detail->nationality = $request['nationality'];
        $guest_detail->check_in_date = date('Y-m-d', strtotime($request['check_in']));
        $guest_detail->check_out_date = date('Y-m-d', strtotime($request['check_out']));
        $guest_detail->save();

        $guest_id = DB::table('guest_details')->orderBy('id',"DESC")->take(1)->value('id');

        $date_start = date('Y-m-d', strtotime($request['check_in']));
        $date_end = date('Y-m-d', strtotime($request['check_out']));
        $interval = Carbon::parse($date_end)->diffInDays($date_start);

        $bookings = new Booking;
        $bookings->guest_id = $guest_id;
        $bookings->number_of_rooms = $request['number_of_rooms'];
        $bookings->grand_total = $interval;
        $bookings->paid_status = 0;
        $bookings->viewed_status = 0;
        $bookings->save();

        for($i=0; $i < $request['number_of_rooms']; $i++)
        {   
            $booking_id = DB::table('bookings')->orderBy('id',"DESC")->take(1)->value('id');

            $booking_details = new BookingDetail;
    
            $booking_details->booking_id = $booking_id;
            $booking_details->room_cat_id = $request['room_cat_id'];
            $booking_details->room_no = 0;
            $booking_details->room_rate = $request['room_rate'];
            $booking_details->status = 'pending';
            $booking_details->check_in = date('Y-m-d', strtotime($request['check_in']));
            $booking_details->check_out = date('Y-m-d', strtotime($request['check_out']));
            $booking_details->nights = $interval;
            $booking_details->total = ($request['room_rate'] * $request['number_of_rooms']) * $interval;
            $booking_details->save();

            $grand_total = BookingDetail::where('booking_id', $booking_id)->sum('total');
            $bookings = Booking::findOrFail($booking_id);
            $bookings->grand_total = $grand_total;
            $bookings->save();

        }
        $booking_id = DB::table('bookings')->orderBy('id',"DESC")->take(1)->value('id');

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'admin');
        })->get();

        Notification::send($admins, new ReservationConfirmed($guest_detail));

        return ['bookings' => $bookings];
    }

    // Check In / Walkin In
    public function walk_in_reservation(Request $request, GuestDetail $guest_detail)
    {
        $guest_detail = new GuestDetail;
        $guest_detail->last_name = $request['last_name'];
        $guest_detail->first_name = $request['first_name'];
        $guest_detail->mi = $request['mi'];
        $guest_detail->email_address = $request['email_address'];
        $guest_detail->address = $request['address'];
        $guest_detail->contact_number = $request['contact_number'];
        $guest_detail->purpose = $request['purpose'];
        $guest_detail->gender = $request['gender'];
        $guest_detail->nationality = $request['nationality'];
        $guest_detail->check_in_date = date('Y-m-d', strtotime($request['check_in']));
        $guest_detail->check_out_date = date('Y-m-d', strtotime($request['check_out']));
        $guest_detail->save();

        $guest_id = DB::table('guest_details')->orderBy('id',"DESC")->take(1)->value('id');

        $date_start = date('Y-m-d', strtotime($request['check_in']));
        $date_end = date('Y-m-d', strtotime($request['check_out']));
        $interval = Carbon::parse($date_end)->diffInDays($date_start);

        $bookings = new Booking;
        $bookings->guest_id = $guest_id;
        $bookings->number_of_rooms = $request['number_of_rooms'];
        $bookings->grand_total = $interval;
        $bookings->paid_status = 0;
        $bookings->viewed_status = 0;
        $bookings->save();

        for($i=0; $i < $request['number_of_rooms']; $i++)
        {   
            $booking_id = DB::table('bookings')->orderBy('id',"DESC")->take(1)->value('id');

            $booking_details = new BookingDetail;
    
            $booking_details->booking_id = $booking_id;
            $booking_details->room_cat_id = $request['room_cat_id'];
            $booking_details->room_no = $request['room_no'];
            $booking_details->room_rate = $request['room_rate'];
            $booking_details->status = 'occupied';
            $booking_details->check_in = date('Y-m-d', strtotime($request['check_in']));
            $booking_details->check_out = date('Y-m-d', strtotime($request['check_out']));
            $booking_details->nights = $interval;
            $booking_details->total = ($request['room_rate']) * $interval;
            // $booking_details->total = ($request['room_rate'] * $request['number_of_rooms']) * $interval;
            $booking_details->save();

            $grand_total = BookingDetail::where('booking_id', $booking_id)->sum('total');
            $bookings = Booking::findOrFail($booking_id);
            $bookings->grand_total = $grand_total;
            $bookings->save();

            $accept_booking = new ConfirmedBooking;

            $accept_booking->booking_id = $booking_id;
            $accept_booking->room_cat_id = $request['room_cat_id'];
            $accept_booking->room_no = $request['room_no'];
            $accept_booking->room_rate = $request['room_rate'];
            $accept_booking->status = 'occupied';
            $accept_booking->check_in = date('Y-m-d', strtotime($request['check_in']));
            $accept_booking->check_out = date('Y-m-d', strtotime($request['check_out']));
            $accept_booking->nights = $interval;
            $accept_booking->total = ($request['room_rate']) * $interval;
            $accept_booking->save();

        }

        return ['bookings' => $bookings];
    }


    public function accept_booking(Request $request)
    {
        $date_start = date('Y-m-d', strtotime($request['check_in']));
        $date_end = date('Y-m-d', strtotime($request['check_out']));
        $interval = Carbon::parse($date_end)->diffInDays($date_start);

        $booking_detail_id = $request['booking_detail_id'];
        $booking_id = $request['booking_id'];

        $accept_booking = new ConfirmedBooking;

        $accept_booking->booking_id = $booking_id;
        $accept_booking->room_cat_id = $request['room_cat_id'];
        $accept_booking->room_no = $request['room_no'];
        $accept_booking->room_rate = $request['room_rate'];
        $accept_booking->status = 'reserved';
        $accept_booking->check_in = date('Y-m-d', strtotime($request['check_in']));
        $accept_booking->check_out = date('Y-m-d', strtotime($request['check_out']));
        $accept_booking->nights = $interval;
        $accept_booking->total = ($request['room_rate'] * $request['number_of_rooms']) * $interval;
        $accept_booking->save();

        $booking_details = BookingDetail::findOrFail($booking_detail_id);
        $booking_details->room_no = $request['room_no'];
        $booking_details->status = 'reserved';
        $booking_details->save();
        
        $guest = Booking::join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')->where('bookings.id', '=', $booking_id)->select('last_name', 'guest_details.email_address')->get();
       
        $to_name = $guest[0]['last_name'];
        $to_email = $guest[0]['email_address'];
        $data = array(
            'name' => $to_name, 
            'to' => $to_email,
            "body" => "A test mail",
            'page' =>  url('http://homestay.test/booking_accepted/'.$booking_id)
        );

        // Mail::send('dynamic_email_template', $data, function($message) use ($to_name, $to_email, $booking_id) {
        //     $message->to($to_email, $to_name)
        //     ->subject('Reservation Confirmation');
        //     $message->from('ronichristian.puno@cmu.edu.ph', 'CMU Homestay');
        // });

        return new BookingDetailResources($accept_booking);
    }

    public function check_out(Request $request)
    {
        // return $request;
        $date_start = $request['check_in'];
        $date_end = $request['check_out'];
        if(date('Y-m-d', strtotime(Carbon::now()->utc())) >= date('Y-m-d', strtotime($date_start)))
        {
            $check_out_time = Carbon::now(); 
            $check_out_date_time = date('Y-m-d h:i:s a', strtotime($check_out_time));

            $date_end = date('Y-m-d h:i:s pm', strtotime($date_end));
            // if($check_out_date_time <= $date_end)
            if($check_out_date_time)
            {
                $id = $request['id'];
                $booking_id = $request['booking_id'];
                DB::table('confirmed_bookings')
                ->where('booking_id', $booking_id)
                ->update(['status' => 'checkout']);

                $booking_details = BookingDetail::findOrFail($id);
                $booking_details->status = 'checkout';
                $booking_details->save();
                
                return new BookingDetailResources($booking_details);
            }
            else
            {
                return 1;
            }
        }
        else
        {
            return 0;
        } 
    }

    public function delete_booking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking_detail = DB::table('booking_details')->where('booking_id', '=', $id)->delete();
        $confirmed_bookings = DB::table('confirmed_bookings')->where('booking_id', '=', $id)->delete();
        $booking_payments = DB::table('booking_payments')->where('booking_id', '=', $id)->delete();

        if($booking->delete()){
            return new BookingResources($booking);
        }
    }

    public function check_in(Request $request)
    {
        $date_start = $request['check_in'];
        $date_end = $request['check_out'];
        
        if(date('Y-m-d', strtotime($date_start)) <= date('Y-m-d', strtotime(Carbon::now()->utc())))
        {
            $id = $request['id'];
            $booking_id = $request['booking_id'];
            
            $booking_details = BookingDetail::findOrFail($id);
            $booking_details->status = 'occupied';
            $booking_details->save();

            DB::table('confirmed_bookings')
            ->where('booking_id', $booking_id)
            ->update(['status' => 'occupied']);

            return new ConfirmedBookingResources($booking_details);
            
        }
        else
        {
            return 0;
        } 

    }

    public function cancel(Request $request)
    {
        $id = $request['id'];
        $booking_id = $request['booking_id'];
        $total = $request['total'];
        
        $booking_details = BookingDetail::findOrFail($id);
        $booking_details->status = 'cancelled';
        $booking_details->save();

        DB::table('confirmed_bookings')
        ->where('booking_id', $booking_id)
        ->update(['status' => 'cancelled']);

        // DB::table('bookings')
        // ->where('id', $booking_id)
        // ->update(['grand_total' => 'grand_total' - $total]);

        return new ConfirmedBookingResources($booking_details);
    }

    public function get_bookings()
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
                'bookings.paid_status',
                'guest_details.last_name',
                'guest_details.first_name')
        ->where('booking_details.status', '!=', 'cancelled')
        ->orderBy('booking_id', 'desc')
        ->get();

        return new BookingDetailResources($booking_details);
    }

    public function calculate($id)
    {
        $room_categories = RoomCategory::where('id', '=', $id)->get();
        $room_rate = $room_categories[0]->room_rate;
        $rooms = Room::where('room_cat_id', '=', $id)->get();
        
        return ['room_rate' => $room_rate, 'rooms' => $rooms];
    }

    public function payment(Request $request)
    {
        // return $request;
        $id = $request[0]['booking_id'];
        $payment = new BookingPayment;
        $payment->booking_id = $id;
        $payment->payment = $request[0]['payment'];
        $payment->amount_recieved = $request[0]['amount_recieved'];
        $payment->save();

        DB::table('bookings')
        ->where('id', $id)
        ->update(['paid_status' => 1]);

        return new BookingPaymentResources($payment);
    }

    public function update_payment(Request $request)
    {
        $id = $request->booking_id;

        $payment = new BookingPayment;

        DB::table('booking_payments')
            ->where('booking_id', $id)
            ->update(['payment' => $request->payment]);
        
        DB::table('bookings')
            ->where('id', $id)
            ->update(['grand_total' => $request->payment]);

        
        // DB::table('booking_details')
        //     ->where('booking_id', $id)
        //     ->update(['total' => $request->payment]);
        
        return new BookingPaymentResources($payment);
    }

    
    public function get_booking($id)
    {
        $booking = DB::table('bookings')
        ->join('guest_details', 'guest_details.id', '=', 'bookings.guest_id')
        ->select('guest_details.first_name', 'guest_details.last_name', 'guest_details.mi', 'bookings.grand_total', 'bookings.id', 'bookings.number_of_rooms', 'bookings.paid_status', 'bookings.created_at')
        ->where('bookings.id', '=', $id)
        ->distinct()
        ->get();

        return new BookingResources($booking);
    }

    public function updateCurrentBooking(Request $request)
    {
        $date_start = $request['check_in'];
        $date_end = $request['check_out'];
        $interval = Carbon::parse($date_end)->diffInDays($date_start);

        $booking_detail =  BookingDetail::findOrFail($request->booking_detail_id) ;

        $booking_detail->room_cat_id = $request['room_cat_id'];
        $booking_detail->room_no = $request['room_no'];
        $booking_detail->room_rate = $booking_detail->room_rate;
        $booking_detail->check_in = $request['check_in'];
        $booking_detail->check_out = $request['check_out'];
        $booking_detail->nights = $interval;
        $booking_detail->total = ($request['room_rate'] ) * $interval;
        $booking_detail->save();


        DB::table('confirmed_bookings')
            ->where('booking_id', $request->booking_id)
            ->update([
                'room_cat_id' => $request['room_cat_id'],
                'room_no' =>$request['room_no'],
                'room_rate' => $booking_detail->room_rate,
                'check_in' => $request['check_in'],
                'check_out' => $request['check_out'],
                'nights' => $interval,
                'total' => ($request['room_rate'] ) * $interval
            ]);

        DB::table('bookings')
            ->where('id', $request->booking_id)
            ->update([
                'grand_total' => ($request['room_rate'] ) * $interval
            ]);
        

        return new BookingDetailResources($booking_detail);
       
    }
}
