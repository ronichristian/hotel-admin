<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\RoomCategory;
use App\Http\Resources\Room as RoomResources;
use App\Http\Resources\RoomCategory as RoomCategoryResources;
use Carbon\Carbon;
use Auth;
use DB;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function display_rooms()
    {
        $rooms = DB::table('room_categories')
        ->join('rooms', 'rooms.room_cat_id', '=', 'room_categories.id')
        ->select('room_categories.id', 'room_categories.category_name', 'room_categories.room_rate', 'room_categories.facilities', 'room_categories.persons', DB::raw('count(rooms.room_cat_id) as count_room'))
        ->groupBy('room_categories.id', 'room_categories.category_name', 'room_categories.room_rate', 'room_categories.facilities', 'room_categories.persons')
        ->orderBy('room_categories.room_rate', 'desc')
        ->distinct()
        ->get();

        // $rooms = RoomCategory::select('id', 'category_name', 'room_rate', 'facilities', 'persons')
        //                         ->groupBy('id', 'category_name', 'room_rate', 'facilities', 'persons')
        //                         ->distinct()
        //                         ->get();

        return new RoomResources($rooms);
    }


    public function display_room_types(Request $request)
    {
        $columns = ['room_categories.category_name', 'room_categories.room_rate', 'room_categories.facilities', 'room_categories.persons', 'count_room'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = DB::table('room_categories')
        ->leftJoin('rooms', 'rooms.room_cat_id', '=', 'room_categories.id')
        ->select('room_categories.id', 'room_categories.category_name', 'room_categories.room_rate', 'room_categories.facilities', 'room_categories.persons', DB::raw('count(rooms.room_cat_id) as count_room'))
        ->groupBy('room_categories.id', 'room_categories.category_name', 'room_categories.room_rate', 'room_categories.facilities', 'room_categories.persons')
        ->orderBy('room_rate', 'desc')
        ->orderBy('category_name', 'desc');

        if($searchValue){
            $query->where(function($query) use ($searchValue){
                $query->where('category_name', 'like', '%' . $searchValue . '%');
            });
        }
        $rooms = $query->paginate($length);
        return ['data' => $rooms, 'draw' => $request->input('draw')];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room_categories = $request->isMethod('put') ? RoomCategory::findOrFail($request->id) : new RoomCategory;
        
        $room_categories->category_name = $request->input('category_name');
        $room_categories->room_rate = $request->input('room_rate');
        $room_categories->facilities = $request->input('facilities');
        $room_categories->persons = $request->input('persons');
        
        if($room_categories->save()){
            return new RoomCategoryResources($room_categories);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = RoomCategory::findOrFail($id);
        $rooms = DB::table('rooms')->where('room_cat_id', '=', $id)->delete();
        if($room->delete()){
            return new RoomCategoryResources($room);
        }
    }

    public function delete_room_number($id)
    {
        $room = Room::findOrFail($id);
        if($room->delete()){
            return new RoomResources($room);
        }
    }

    public function add_room_number(Request $request)
    {
        $room_cateogry = new Room;
        $room_cateogry->room_no = $request['room_no'];
        $room_cateogry->room_cat_id = $request['room_cat_id'];
        $room_cateogry->save();

        return new RoomCategoryResources($room_cateogry);
    }

    public function get_all_rooms()
    {
        $get_rooms = Room::all();
        return new RoomResources($get_rooms);
    }

    public function get_rooms($id)
    {
        $rooms = Room::where('room_cat_id', '=', $id)->get();
        return new RoomResources($rooms);
    }

    public function all_available_rooms(Request $request)
    {
        $date_start = $request['check_in'];
        $date_end = $request['check_out'];
        $status = 'reserved';
        
        $rooms = DB::table('rooms')
        ->join('room_categories', 'room_categories.id', '=', 'rooms.room_cat_id')
        ->select('rooms.room_no', 'room_categories.category_name', 'rooms.room_cat_id')
        ->whereNotIn('rooms.room_no', 
            function($query) use ($date_start, $date_end, $status) {
            $query->from('confirmed_bookings')
             ->select('room_no')
             ->where('check_in', '<=', $date_end)
             ->where('check_out', '>=', $date_start);
         })
        ->get();

        if($rooms){
            return new RoomResources($rooms);
        }
    }

    public function room_status(Request $request)
    {
        $date = Carbon::now();
        
        $columns = ['rooms.room_no', 'room_categories.category_name'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $checkInDate = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');

        $query = DB::table('rooms')
        ->join('room_categories', 'room_categories.id', '=', 'rooms.room_cat_id')
        ->select('rooms.room_no', 'room_categories.category_name', 'rooms.room_cat_id')
        ->whereNotIn('rooms.room_no', 
            function($query) use ($checkInDate, $checkOutDate, $date) {
            $query->from('booking_details')
             ->select('room_no')
             ->where('check_in', '<=', $date)
             ->where('check_out', '>=', $date)
             ->where('status', '=', 'checkout');
         })
        ->orderBy($columns[$column], $dir)
        ->distinct();

        if($checkInDate && $checkOutDate){
            $query->whereNotIn('rooms.room_no', 
                function($query) use ($checkInDate, $checkOutDate) {
                $query->from('confirmed_bookings')
                ->select('room_no')
                ->where('check_in', '<=', $checkOutDate)
                ->where('check_out', '>=', $checkInDate)
                ->where('status', '!=', 'checkout');
            });
        }
        $bookings = $query->paginate($length);
        return ['data' => $bookings, 'draw' => $request->input('draw')];
    }

   
}
