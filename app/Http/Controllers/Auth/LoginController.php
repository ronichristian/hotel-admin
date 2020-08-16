<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function redirectTo()
    {
        if (auth()->user()->roles()->first()->name == 'superadmin') {
            return '/dashboard';
        } else if (auth()->user()->roles()->first()->name == 'bangquet') {
            return '/admin_bangquet_reservation';
        } else if (auth()->user()->roles()->first()->name == 'accommodation') {
            return '/admin_room_bookings';
        } else {
            return '/';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
