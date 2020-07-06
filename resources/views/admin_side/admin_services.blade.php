@extends('layouts.admin')

@section('content')
<!-- end navbar side -->
<!--  page-wrapper -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Services</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Admin Services</li>
            </ol>
        </div>
        </div>
    </div>
</div> 

    <!-- Advanced Tables -->
    <admin-services>
   
@endsection