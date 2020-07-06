<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function bookingDetail()
    {
        return $this->hasMany('App\BookingDetail');
    }
}
