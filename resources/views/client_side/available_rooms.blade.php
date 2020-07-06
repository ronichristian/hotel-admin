@extends('layouts.client')

@section('content')
    <div style="background-color: #0c9463;"  class="site-section">
        <availablerooms :number_of_rooms='{!! json_encode($number_of_rooms) !!}' :nights='{!! json_encode($nights) !!}' :rooms='{!! json_encode(count($rooms)) !!}' :r='{!! json_encode($rooms) !!}' :date_start='{!! json_encode($date_start) !!}' :date_end='{!! json_encode($date_end)  !!}'/>
    </div>
@endsection




 