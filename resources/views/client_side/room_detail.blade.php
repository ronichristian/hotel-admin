@extends('layouts.client')

@section('content')
    <div class="site-section bg-light">
        <roomdetail :r='{!! json_encode($room_detail) !!}' >
    </div>
@endsection