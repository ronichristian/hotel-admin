<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>UFLS Hospitality Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script> --}}

{{-- @guest
    <meta name="user-id" content="">
@else
    <meta name="user-id" content="{{ Auth::user()->id }}">
@endguest --}}

{{-- Modal elemet ui --}}
<link rel="stylesheet" href="{{asset('css/admin2/form-modal/index.css')}}">
<link rel="stylesheet" href="{{asset('css/admin2/form-modal/themify-icons.css')}}">

{{-- Calendar --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

<link rel="stylesheet" href="{{asset('css/admin2/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="{{asset('css/admin2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
<link rel="stylesheet" href="{{asset('css/admin2/plugins/toastr/toastr.min.css')}}">

<link rel="stylesheet" href="{{asset('css/admin2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/admin2/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/admin2/plugins/jqvmap/jqvmap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/admin2/dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('css/admin2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<link rel="stylesheet" href="{{asset('css/admin2/plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('css/admin2/plugins/summernote/summernote-bs4.css')}}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<script>
    var laravel = @json(['baseURL' =>  asset('/') ]);
</script>

</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed layout-fixed">
    <div class="wrapper" id="app">
    <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <notification :userid="{{ auth()->user()->id }}" :unreads="{{ auth()->user()->unreadNotifications}}"></notification>


                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                        <div class="image">
                            <img style="width:15px;" src="{{asset('css/admin2/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                        </div>     
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                        <li><a href="#" class="dropdown-item">Some action </a></li>
                        <li><a href="#" class="dropdown-item">Some other action</a></li>
            
                        <li class="dropdown-divider"></li>
            
                        <!-- Level two dropdown-->
                        <li class="dropdown-submenu dropdown-hover">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <p class="text">Logout</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </li>
                      <!-- End Level two -->
                    </ul>
                </li>
            </ul>
        </nav>
    <!-- /.navbar -->
    
    <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{asset('css/admin2/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">UFLS {{ ucwords(implode(', ', auth()->user()->roles()->get()->pluck('name')->toArray())) }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    <img src="{{asset('css/admin2/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        @if(auth()->user()->hasAnyRole('superadmin'))
                            <li class="nav-item">
                                <a href="{{url('dashboard')}}" class="{{ Request::segment(1) === 'dashboard' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                        @endif
                        
                        @if(auth()->user()->hasAnyRole('superadmin'))
                            <li class="{{ Request::segment(1) === 'admin/users' ? 'nav-item active has-treeview ' : 'nav-item has-treeview'}}">
                                <a href="#" class="{{ Request::segment(1) === 'admin/users' ? 'nav-link active' : 'nav-link'}} ">
                                    <i class="nav-icon fa fa-cog"></i>
                                    <p>
                                        Users
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.users.index') }}" class="{{ Request::segment(1) === 'admin/users' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-th"> </i>
                                            <p>
                                                {{-- <ion-icon name="bed-outline"></ion-icon> --}}
                                                <span>Manage Users</span>
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        
                        @if(auth()->user()->hasAnyRole('accommodation') || auth()->user()->hasAnyRole('bangquet') || auth()->user()->hasAnyRole('superadmin'))
                            <li class="nav-item">
                                <a href="{{ url('admin_room_bookings') }}" class="{{ Request::segment(1) === 'admin_room_bookings' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>
                                        Room Bookings
                                    </p>
                                </a>
                            </li>
                        @endif
                        
                        @if(auth()->user()->hasAnyRole('bangquet') || auth()->user()->hasAnyRole('superadmin'))
                            <li class="nav-item">
                                
                                <a href="{{ url('admin_bangquet_reservation') }}" class="{{ Request::segment(1) === 'admin_bangquet_reservation' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>
                                        Bangquets Reservation
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ url('admin_bookings') }}" class="{{ Request::segment(1) === 'admin_bookings' 
                                                                            || Request::segment(1) === 'booking_detail' ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Group Bookings<span class="badge badge-info right">{{ count(auth()->user()->unreadNotifications) }}</span>
                                </p>
                            </a>
                        </li>

                        <li class="{{ Request::segment(1) === 'admin_room_reports' || Request::segment(1) === 'admin_bangquet_reports' ? 'nav-item active has-treeview menu-open' : 'nav-item has-treeview'}}">
                            <a href="#" class="{{ Request::segment(1) === 'admin_room_reports' ? 'nav-link active' : 'nav-link'}} ">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Reports
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin_room_reports') }}" class="{{ Request::segment(1) === 'admin_room_reports' ? 'nav-link active' : 'nav-link' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Room Reports
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin_bangquet_reports') }}" class="{{ Request::segment(1) === 'admin_bangquet_reports' ? 'nav-link active' : 'nav-link' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Bangquet Reports
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    
                        <li class="{{ Request::segment(1) === 'admin_rooms' 
                                    || Request::segment(1) === 'admin_services' 
                                    || Request::segment(1) === 'admin_halls' ? 'nav-item active has-treeview ' : 'nav-item has-treeview'}}">
                            <a href="#" class="{{ Request::segment(1) === 'admin_rooms' 
                                        || Request::segment(1) === 'admin_services'
                                        || Request::segment(1) === 'admin_halls' ? 'nav-link active' : 'nav-link'}} ">
                                <i class="nav-icon fa fa-cog"></i>
                                <p>
                                    Configuration
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(auth()->user()->hasAnyRole('accommodation') || auth()->user()->hasAnyRole('superadmin'))
                                    <li class="nav-item">
                                        <a href="{{ url('admin_rooms') }}" class="{{ Request::segment(1) === 'admin_rooms' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-th"> </i>
                                            <p>
                                                {{-- <ion-icon name="bed-outline"></ion-icon> --}}
                                                <span>Rooms</span>
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if(auth()->user()->hasAnyRole('bangquet') || auth()->user()->hasAnyRole('superadmin'))
                                    <li class="nav-item">
                                        <a href="{{ url('admin_services') }}" class="{{ Request::segment(1) === 'admin_services' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-th"></i>
                                            <p>
                                                Services/Bangquets
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content">
                <div class="container-fluid">
                    <div >
                        @yield('content')
                    </div>
                </div>
            </section> 
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.4
            </div>
        </footer>
         <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

    </div>
<!-- ./wrapper -->


<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>

<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src="{{asset('css/admin2/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('css/admin2/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('css/admin2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('css/admin2/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('css/admin2/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('css/admin2/plugins/jqvmap/jquery.vmap.min.js')}}"></script>

<script src="{{asset('css/admin2/plugins/toastr/toastr.min.js')}}"></script>

<script src="{{asset('css/admin2/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('css/admin2/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('css/admin2/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('css/admin2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('css/admin2/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('css/admin2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('css/admin2/dist/js/adminlte.js')}}"></script>
<script src="{{asset('css/admin2/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('css/admin2/dist/js/demo.js')}}"></script>

@yield('js-for-calendar')

</body>
</html>
