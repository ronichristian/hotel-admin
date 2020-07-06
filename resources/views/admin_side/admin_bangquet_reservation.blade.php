@extends('layouts.admin')

@section('content')

<reserve-bangquets :room_categories='{!! json_encode($room_categories) !!}'/>

{{-- <div class="content-header">
    <reserve-services :room_categories='{!! json_encode($room_categories) !!}'/>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Calendar</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Calendar</li>
                </ol>
            </div>
        </div>
    </div>
</div> 
<div class="col-sm-6" style="margin-top:-32px;">
    <h1 class="m-0 text-dark">Bangquet Reservation</h1>
    <button data-toggle="modal" data-target="#checkIn"  class="btn btn-info btn-sm" style="margin-top: 5px;">Reserve Bangquet</button>
</div><!--

<button data-toggle="modal" data-target="#checkIn"  class="btn btn-info btn-sm">Reserve Service</button>
<hr>
<!-- Advanced Tables -->
{!! $calendar->calendar() !!} --}}
<!--End Advanced Tables -->
 
@endsection

{{-- @section('js-for-calendar')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
@endsection --}}