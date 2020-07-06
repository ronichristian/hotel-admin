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
                                    Guest: {{ ucwords($details[0]->last_name) }}, {{ ucwords($details[0]->first_name) }} {{ ucwords($details[0]->mi) }}.
                                    <span class="float-right">
                                        Date: {!! date('d/m/Y', strtotime($details[0]->created_at)) !!} 
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

            </div>
            <br><br><br><br>
            <h2 style="margin-top: -10%;" class="heading">
                @isset($footer)
                    <div style="font-size:20px;" >
                        <br><Br>
                        <strong>Again, thank you for choosing CMU Homestay. We look forward to having you as our guest.</strong>
                    </div>
                @endif
            </h2>
        </div>
    </div>
    
@endsection




 