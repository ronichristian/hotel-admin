<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;use App\Room;
use App\Role;
use App\User;
use App\Services;
use App\BangquetPayment;
use App\BangquetReservation;
use App\Http\Resources\User as UserResources;
use App\Http\Resources\Room as RoomResources;
use App\Http\Resources\Services as ServicesResources;
use App\Http\Resources\BangquetPayment as BangquetPaymentResources;
use App\Http\Resources\BangquetReservation as BangquetReservationResources;
use Carbon\Carbon;
use DateTime;
use Auth;
use DB;
use App\Notifications\ReservationConfirmed;
use Illuminate\Support\Facades\Mail;

class BangquetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Services::where('rentable', '=', 1)->get();
        return new ServicesResources($venues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date_of_event = date('Y-m-d H:i:s', strtotime($request['start_time']));

        $bangquet_reservation = $request->isMethod('put') ? BangquetReservation::findOrFail($request->id) : new BangquetReservation;

        $bangquet_reservation->event_name = $request['event_name'];
        $bangquet_reservation->engager_name = $request['engager_name'];
        $bangquet_reservation->address = $request['address'];
        $bangquet_reservation->company = $request['company'];
        $bangquet_reservation->company_address = $request['company_address'];
        $bangquet_reservation->venue = $request['venue'];
        $bangquet_reservation->status = 'occupied';
        $bangquet_reservation->paid_status = 0;
        $bangquet_reservation->phone_number = $request['phone_number'];
        $bangquet_reservation->email_address = $request['email_address'];
        $bangquet_reservation->date_of_event = $date_of_event;
        $bangquet_reservation->start_time = $date_of_event;
        $bangquet_reservation->end_time = $request['end_time'];
        $bangquet_reservation->no_of_pax = $request['no_of_pax'];
        $bangquet_reservation->motif = $request['motif'];
        $bangquet_reservation->payment_mode = "unpaid";
        $bangquet_reservation->save();

        // $bangquet_id = DB::table('bangquet_reservations')->orderBy('id',"DESC")->take(1)->value('id');

        // $bangquet_payment = New BangquetPayment;
        // $bangquet_payment->bangquet_id = $request['bangquet_id'];
        // $bangquet_payment->total_payable = $request['total_payable'];
        // $bangquet_payment->amount = $request['amount'];
        // $bangquet_payment->balance = $request['balance'];
        // $bangquet_payment->save();

        return new BangquetReservationResources($bangquet_reservation);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_bangquet_reservations()
    {
        $bangquet_reservation = DB::table('bangquet_reservations')
        ->join('services', 'services.id', '=', 'bangquet_reservations.venue')
        ->select('bangquet_reservations.id', 
                'bangquet_reservations.event_name', 
                'bangquet_reservations.engager_name', 
                'bangquet_reservations.address',
                'bangquet_reservations.company', 
                'bangquet_reservations.company_address',
                'bangquet_reservations.venue', 
                'bangquet_reservations.status',
                'bangquet_reservations.phone_number',
                'bangquet_reservations.email_address',
                'bangquet_reservations.date_of_event',
                'bangquet_reservations.start_time',
                'bangquet_reservations.end_time',
                'bangquet_reservations.no_of_pax',
                'bangquet_reservations.motif',
                'services.service_name',
                'bangquet_reservations.paid_status',
                'bangquet_reservations.payment_mode')
        ->orderBy('id', 'desc')
        ->get();

        return new BangquetReservationResources($bangquet_reservation);
    }

    public function get_bangquet_reservation($id)
    {
        $bangquet_reservation = DB::table('bangquet_reservations')
        ->select('bangquet_reservations.id', 
                'bangquet_reservations.event_name', 
                'bangquet_reservations.engager_name', 
                'bangquet_reservations.address',
                'bangquet_reservations.company', 
                'bangquet_reservations.company_address',
                'bangquet_reservations.venue', 
                'bangquet_reservations.status',
                'bangquet_reservations.phone_number',
                'bangquet_reservations.email_address',
                'bangquet_reservations.date_of_event',
                'bangquet_reservations.start_time',
                'bangquet_reservations.end_time',
                'bangquet_reservations.no_of_pax',
                'bangquet_reservations.motif',
                'bangquet_reservations.paid_status',
                'bangquet_reservations.payment_mode')
        ->where('id', '=', $id)
        ->orderBy('id', 'desc')
        ->get();

        return new BangquetReservationResources($bangquet_reservation);
    }

    public function bangquetReservationUpdate(Request $request)
    {
        $date_of_event = date('Y-m-d H:i:s', strtotime($request['date_of_event']));
        $bangquet_reservation =  BangquetReservation::findOrFail($request['id']) ;
        
        $bangquet_reservation->event_name = $request['event_name'];
        $bangquet_reservation->engager_name = $request['engager_name'];
        $bangquet_reservation->address = $request['address'];
        $bangquet_reservation->company = $request['company'];
        $bangquet_reservation->company_address = $request['company_address'];
        $bangquet_reservation->venue = $request['venue'];
        $bangquet_reservation->status = 'occupied';
        $bangquet_reservation->phone_number = $request['phone_number'];
        $bangquet_reservation->email_address = $request['email_address'];
        $bangquet_reservation->date_of_event = $date_of_event;
        $bangquet_reservation->start_time = $request['start_time'];
        $bangquet_reservation->end_time = $request['end_time'];
        $bangquet_reservation->no_of_pax = $request['no_of_pax'];
        $bangquet_reservation->motif = $request['motif'];
        $bangquet_reservation->save();
        
        return new BangquetReservationResources($bangquet_reservation);
    }

    public function bangquet_payment(Request $request)
    {
        $bangquet_payment = new BangquetPayment;

        $id = $request['bangquet_id'];

        $bangquet_payment->bangquet_id = $request['bangquet_id'];
        $bangquet_payment->total_payable = $request['total_payable'];
        $bangquet_payment->amount = $request['amount'];
        $bangquet_payment->balance = $request['balance'];
        $bangquet_payment->payment_mode = $request['payment_mode'];
        $bangquet_payment->save();

        DB::table('bangquet_reservations')
            ->where('id', $id)
            ->update(['paid_status' => 1,
                    'payment_mode' => $request['payment_mode']]);

        return new BangquetPaymentResources($bangquet_payment);
    }

    public function delete_booking($id)
    {
        $booking = BangquetReservation::findOrFail($id);
        $booking_detail = DB::table('bangquet_payments')->where('bangquet_id', '=', $id)->delete();

        if($booking->delete()){
            return new BangquetPaymentResources($booking);
        }
    }
}
