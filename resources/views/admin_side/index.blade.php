@extends('layouts.admin')

@section('content')
<div class="content-header">
        <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">Admin Rooms</h1>
                </div><!-- /.col -->
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                                </ol>
                        </div>
                </div>
        </div>
</div> 


<section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                    @if(empty($occupied[0]->count_occupied))
                        <h3>0</h3>
                    @else
                        <h3>{{$occupied[0]->count_occupied}}</h3>
                    @endif

                    <p>Occupied Rooms</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    @if(empty($reserved[0]->count_reserved))
                        <h3>0</h3>
                    @else
                        <h3>{{$reserved[0]->count_reserved}}</h3>
                    @endif

                    <p>Reserved Rooms</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    @if(empty($pending[0]->count_pending))
                        <h3>0</h3>
                    @else
                        <h3>{{$pending[0]->count_pending}}</h3>
                    @endif

                    <p>Pending Reservations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    @if(empty($checkout[0]->count_checkout))
                        <h3>0</h3>
                    @else
                        <h3>{{$checkout[0]->count_checkout}}</h3>
                    @endif

                    <p>Checked Out</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div>
        
        </div>

        <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">
                        10
                        <small>%</small>
                        </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">{{$users[0]->count_users}}</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                </div>
                <!-- /.col -->
        </div>
</section>

@endsection