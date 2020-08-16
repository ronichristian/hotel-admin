@extends('layouts.admin')

@section('content')
 
<admin-room-bookings :room_categories='{!! json_encode($room_categories) !!}'></admin-room-bookings>

{{-- <div class="modal modal fade bd-example-modal-xl" id="bookingDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="max-width: 100%;" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Room name</th>
                            <th>Room rate</th>
                            <th>Check in Date</th>
                            <th>Check out Date</th>
                            <th>Nights</th>
                            <th>Status</th>
                            <th>Room NO.</th>
                            <th>Total cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="booking_detail in booking_details" v-bind:key="booking_detail.id">
                            <td> </td>
                            <td align="right"> </td>
                            <td align="center"> </td>
                            <td align="center"> </td>
                            <td align="center"> </td>

                            <td align="center" v-if="booking_detail.status == 'cancelled'" style="font-weight: 700;" class="text-danger">
                                <span class="badge badge-danger"> </span>
                            </td>
                            <td align="center" v-else-if="booking_detail.status == 'checkout'" style="font-weight: 700;" class="text-danger">
                                <span class="badge badge-danger">CHECKED OUT</span>
                            </td>
                            <td align="center" v-else-if="booking_detail.status == 'occupied'" style="font-weight: 700;" class="text-primary">
                                <span class="badge badge-info"> </span>
                            </td>
                            <td align="center" v-else-if="booking_detail.status == 'pending'" class="text-warning">
                                <span class="badge badge-warning"> </span>
                            </td>
                            <td align="center" v-else style="font-weight: 700;" class="text-success">
                                <span class="badge badge-success"> </span>
                            </td>

                            <td align="center" v-if="booking_detail.room_no == 0" class="text-secondary">N/A</td>
                            <td align="center" v-else class="text-success"> </td>

                            <td align="right" class="text-danger"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="content-header">
    <checkin :room_categories='{!! json_encode($room_categories) !!}'/>
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

<div class="col-sm-6" style="margin-top:-30px;">
    <h1 class="m-0 text-dark">Accommodation Bookings</h1>
    <button data-toggle="modal" data-target="#checkIn"  class="btn btn-info btn-sm" style="margin-top:-0px;">Check In</button>
</div><!-- /.col -->

<hr>
{!! $calendar->calendar() !!} --}}
 
@endsection

{{-- @section('js-for-calendar')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
@endsection --}}