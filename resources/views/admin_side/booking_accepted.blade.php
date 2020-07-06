@extends('layouts.client')

@section('content')

    <div style="margin-top: -8%;" class="site-section bg-light">
        <div class="container">
            <h5>If you wish to book again. </h5><a href="/" class="btn btn-info float-left" >Home</a>

            <div class="row mb-5 pt-5 justify-content-center" >
                <div class="col-md-12 section-heading">

                    <div class="col-lg-12 mb-12 order-lg-12">
                        <div class="media block-6" >
                            <div class="media-body float-left">
                                <h3 class="heading">
                                    Guest: {{ ucwords($bookings_details[0]->last_name) }}, {{ ucwords($bookings_details[0]->first_name) }} {{ ucwords($bookings_details[0]->mi) }}.
                                    <span class="float-right">
                                        Date: {!! date('d/m/Y', strtotime($details[0]->updated_at)) !!} 
                                    </span>
                                </h3>
                            </div>
                        </div> 
                    </div>


                </div>
            </div>

            <h2 style="margin-top: -10%;" class="heading">
                @isset($header)
                    <div style="font-size:20px;" class="alert alert-success">
                        <strong>{{$header}}</strong>
                    </div>
                @endif
            </h2>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="thead-dark">
                            <tr style="white-space:nowrap;">
                                <th>Room name</th>
                                <th>Room rate</th>
                                <th>Check in Date</th>
                                <th>Check out Date</th>
                                <th>Nights</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody style="white-space: nowrap;">
                            @foreach ($bookings_details as $bookings_detail)
                                <tr>
                                    <td align="left">{!! $bookings_detail->category_name !!}</td>
                                    <td align="right">{!! $bookings_detail->room_rate !!}</td>
                                    <td align="center">{!! $bookings_detail->check_in !!}</td>
                                    <td align="center">{!! $bookings_detail->check_out !!}</td>
                                    <td align="center">{!! $bookings_detail->nights !!}</td>
                                    <td align="right"><button class="btn btn-danger float-right">{!! $bookings_detail->total !!}</button></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total: <button class="btn btn-danger float-right">{{ $bookings_details[0]->grand_total }}</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br><br><br>
            <h2 style="margin-top: -10%;" class="heading">
                @isset($footer)
                    <div style="font-size:20px;" >
                        <strong>{{$footer}}</strong>
                        <br><Br>
                        <strong>Again, thank you for choosing CMU Homestay. We look forward to having you as our guest.</strong>
                    </div>
                @endif
            </h2>
        </div>
    </div>
    
@endsection




 