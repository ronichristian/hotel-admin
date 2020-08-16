<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Auth;
use App\Authentication;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_side.users.admin_accounts')->with('users', User::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $users = DB::table('role_user')->select(DB::raw("count(role_user.user_id) as count_users"))->where('role_user.role_id', '=', 2)->get();

        // $reserved = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_reserved'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'reserved')->get();
        // $occupied = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_occupied'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'occupied')->get();
        // $pending = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_pending'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'pending')->get();
        // $checkout = DB::table('booking_details')->select( DB::raw('count(booking_details.status) as count_checkout'))->groupBy('booking_details.status')->where('booking_details.status', '=', 'checkout')->get();

        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to update your account');
        }

        return view('admin_side.users.admin_users_edit')->with(['user' => User::find($id), 'roles' => Role::all()]);

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
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index');
        }

        $user = User::find($id);
        $user->roles()->sync($request->roles);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Account updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to delete your account');
        }
        $user = User::find($id);

        if($user){
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('admin.users.index')->with('succes', 'User has been deleted');
        }
        
        return redirect()->route('admin.users.index')->with('success', 'User has been allowed');
    }

    public function create(Request $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('admin.users.index')->with('warning', 'This user cannot be deleted');
    }

    public function create_user()
    {
        return view('admin_side.users.admin_create_account')->with(['roles' => Role::all()]);
    }
}
