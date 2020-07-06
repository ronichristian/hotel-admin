<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\BookingDetail;
use App\Http\Resources\User as UserResources;
use App\Http\Resources\Booking as BookingResources;
use App\Http\Resources\BookingDetail as BookingDetailResources;
use Carbon\Carbon;
use DateTime;
use Auth;
use DB;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $columns = ['users.name', 'bookings.id', 'bookings.grand_total', 'bookings.number_of_rooms', 'bookings.created_at'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = DB::table('bookings')
        ->join('users', 'users.id', '=', 'bookings.user_id')
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->select('users.name', 'bookings.id', 'bookings.grand_total', 'bookings.id', 'bookings.number_of_rooms', 'bookings.created_at')
        ->where('user_id', '=', $request->user_id)
        ->orderBy($columns[$column], $dir)
        ->distinct();

        if($searchValue){
            $query->where(function($query) use ($searchValue){
                $query->where('bookings.id', 'like', '%' . $searchValue . '%')->
                orWhere('bookings.created_at', 'like', '%' . $searchValue . '%');
            });
        }
        $bookings = $query->paginate($length);
        return ['data' => $bookings, 'draw' => $request->input('draw')];
    }

   
}
