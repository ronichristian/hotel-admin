@extends('layouts.client')

@section('content')
    <div style="margin-top: -10%;" class="site-section bg-light">
        <reservationdetail :r='{!! json_encode($booking_details) !!}'/>
    </div>
@endsection




 