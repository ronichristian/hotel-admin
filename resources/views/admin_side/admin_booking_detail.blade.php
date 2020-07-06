@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Booking Detail</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Admin Bookings</a></li>
                <li class="breadcrumb-item active">Booking Detail</li>
            </ol>
        </div>
        </div>
    </div>

</div> 

<a style="margin-left:2%;" href="{{asset('admin_bookings')}}" class="btn btn-primary btn-sm">Go Back</a>
<hr>
<admin-bookings-details :booking_id='{!! json_encode($booking_id) !!}' :guest_name='{!! json_encode($guest_name) !!}' :grand_total='{!! json_encode($grand_total) !!}' :booking='{!! json_encode($booking) !!}' :booking_details='{!! json_encode($booking_details) !!}' :grand_total='{!! json_encode($grand_total) !!}' :date='{!! json_encode($date) !!}'/>
@endsection
