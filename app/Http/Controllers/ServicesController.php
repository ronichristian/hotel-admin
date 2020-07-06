<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Services;
use App\RoomCategory;
use App\OtherCharges;
use App\Http\Resources\Services as ServiceResources;
use App\Http\Resources\OtherCharges as OtherChargesResources;
use App\Http\Resources\RoomCategory as RoomCategoryResources;
use Carbon\Carbon;
use Auth;
use DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $columns = ['services.service_name'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = DB::table('services')
        ->select('services.id', 'services.service_name', 'services.rentable', 'services.rent_fee')
        ->orderBy('id', 'desc')
        ->orderBy('service_name', 'desc');

        if($searchValue){
            $query->where(function($query) use ($searchValue){
                $query->where('service_name', 'like', '%' . $searchValue . '%');
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
        $services = $request->isMethod('put') ? Services::findOrFail($request->id) : new Services;
        
        $services->service_name = $request->input('service_name');
        $services->rentable = $request->input('rentable');
        $services->rent_fee = $request->input('rent_fee');
        
        if($services->save()){
            return new ServiceResources($services);
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
        $service = Services::findOrFail($id);
        if($service->delete()){
            return new ServiceResources($service);
        }
    }

    public function get_other_charges(Request $request)
    {
        $charges = OtherCharges::all();
        return new OtherChargesResources($charges);
    }

    public function add_charge(Request $request)
    {
        $charge = $request->isMethod('put') ? OtherCharges::findOrFail($request->id) : new OtherCharges;
        
        $charge->charge_name = $request->input('charge_name');
        $charge->charge_price = $request->input('charge_price');
        
        if($charge->save()){
            return new OtherChargesResources($charge);
        }
    }

    public function delete_charge($id)
    {
        $charge = OtherCharges::findOrFail($id);
        if($charge->delete()){
            return new OtherChargesResources($charge);
        }
    }
}
