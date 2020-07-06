@extends('layouts.admin')

@section('content')
        <!-- end navbar side -->
        <!--  page-wrapper -->

            <div class="row">
                <!--  page header -->
               <div class="col-lg-12">
                   <h1 class="page-header">Admin Rooms</h1>
               </div>
                <!-- end  page header -->
           </div>
           <div class="row">
               <div class="col-lg-12">
                   <!-- Advanced Tables -->
                    <admin-rooms-status>
                   <!--End Advanced Tables -->
               </div>
           </div>
        
 
@endsection