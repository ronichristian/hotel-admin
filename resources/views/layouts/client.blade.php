<!DOCTYPE html>
<html lang="en">
<head>
    <title>CMU Homestay</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <!-- Core CSS - Include with every page -->
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <link rel="stylesheet" href="https://rawgit.com/lykmapipo/themify-icons/master/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('css/client/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/style.css')}}">
    <link href="{{asset('css/client/css/bootstrap.4.4.1.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/client/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/bootstrap-datepicker.css')}}"> 


    </head>
    <body>

    <nav  class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light">
        <div style="max-width: 100%; padding-left:20px; padding-right:20px; background-color: #0c9463; 
                    color:wheat; font-weight:500; border-radius:5px;" class="container">
            <a class="navbar-brand" href="/">CMU Homestay</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="{{ Request::segment(1) === '' ? 'nav-item active' : 'nav-item ' }}">
                        <a href="{{ url('/') }}" class="nav-link">Home</a>
                    </li>
                    <li class="{{ Request::segment(1) === '' ? 'nav-item active' : 'nav-item ' }}">
                        <a href="{{ url('/') }}" class="nav-link">Rooms</a>
                    </li>
                    <li class="{{ Request::segment(1) === '' ? 'nav-item active' : 'nav-item ' }}">
                        <a href="{{ url('/') }}" class="nav-link">About Us</a>
                    </li>
                    <li class="{{ Request::segment(1) === '' ? 'nav-item active' : 'nav-item ' }}">
                        <a href="{{ url('/') }}" class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
  
    <div style="background-color: #21bf73;" id="app">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row mb-5">
            <div class="col-md-6 col-lg-4">
                <h3 class="heading-section">About Us</h3>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga aliquid. Atque dolore esse veritatis iusto eaque perferendis non dolorem fugiat voluptatibus vitae error ad itaque inventore accusantium tempore dolores sunt.</p>
                <p><a href="#" class="btn btn-primary px-4">Button</a></p>
            </div>
            <div class="col-md-6 col-lg-4">
                <h3 class="heading-section">Blog</h3>
                <div class="block-21 d-flex mb-4">
                <figure class="mr-3">
                    <img src="/css/client/images/img_1.jpg" alt="" class="img-fluid">
                </figure>
                <div class="text">
                    <h3 class="heading"><a href="#">Our Luxury Hotel &amp; Restaurants</a></h3>
                    <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                    </div>
                </div>
                </div>

                <div class="block-21 d-flex mb-4">
                <figure class="mr-3">
                    <img src="/css/client/images/img_2.jpg" alt="" class="img-fluid">
                </figure>
                <div class="text">
                    <h3 class="heading"><a href="#">Our Luxury Hotel &amp; Restaurants</a></h3>
                    <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                    </div>
                </div>
                </div>

                <div class="block-21 d-flex mb-4">
                <figure class="mr-3">
                    <img src="/css/client/images/img_3.jpg" alt="" class="img-fluid">
                </figure>
                <div class="text">
                    <h3 class="heading"><a href="#">Our Luxury Hotel &amp; Restaurants</a></h3>
                    <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="block-23">
                <h3 class="heading-section">Contact Info</h3>
                    <ul>
                    <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                    <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                    <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                    <li><span class="icon icon-clock-o"></span><span class="text">Monday &mdash; Friday 8:00am - 5:00pm</span></li>
                    </ul>
                </div>
            </div>
            
            
            </div>
            <div class="row pt-5">
            <div class="col-md-12 text-left">
                <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
            </div>
        </div>
    </footer>
    
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js "></script>
    <script src="{{asset('css/client/js/jquery.min.js')}}"></script>
    <script src="{{asset('css/client/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('css/client/js/popper.min.js')}}"></script>
    <script src="{{asset('css/client/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('css/client/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('css/client/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('css/client/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('css/client/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('css/client/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('css/client/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('css/client/js/aos.js')}}"></script>
    <script src="{{asset('css/client/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('css/client/js/main.js')}}"></script>

    </body>
</html>