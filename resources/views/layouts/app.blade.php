<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <link href="{{asset('css/client/css/bootstrap.4.4.1.min.css')}}" rel="stylesheet" >

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <!-- Scripts -->
    <style>
        /* @import "compass/css3"; */

        /* @import "compass/reset"; */
        /* @import "compass/css3"; */

        /* Colors */	
        /* ---------------------------------------- */ 
        $border: 		 #c6c6c6;
        $border-focus: #9FB1C1;
        $brand-color:  #1b3d4d;
        $booking-green: #bdcc00;
        $asphalt: 		#506982;

        *{
            box-sizing(border-box);
        }
        body{
            text-align: center;
            font-family: 'Lato', 'sans-serif';
            font-weight: 400;

        }
        a{
            text-decoration: none;
        }
        .info-text{
            text-align: left;
            width: 100%;
        }
        header, form{
            padding: 4em 10%;
        }

        .form-group{
            margin-bottom: 20px;
        }
        h2.heading{
            font-size: 18px;
            text-transform: uppercase;
            font-weight: 300;
            text-align: left;
            color: $asphalt;
            border-bottom: 1px solid $asphalt;
            padding-bottom: 3px;
            margin-bottom: 20px;
        }

        .controls{
            text-align: left;
            position: relative;
            input[type="text"],
            input[type="email"],
            input[type="number"],
            input[type="date"],
            input[type="tel"],
            textarea,
            button,
            select{
                padding: 12px;
                font-size: 14px;
                border: 1px solid $border;
                width: 100%;
                margin-bottom: 18px;
                color: #888;
                font-family: 'Lato', 'sans-serif';
                font-size: 16px;
                font-weight: 300;
                border-radius(2px);
                transition(all .3s);

                &:focus, &:hover{
                    outline: none;
                    border-color: $border-focus;
                    + label{
                        color: $booking-green;
                cursor: text;
                    }
                }
            }

            .fa-sort{
                position:absolute;
                right: 10px;
                top: 17px;
                color: #999;
            }
            select{
                appearance(none);
                cursor: pointer;
            }
            label{
                position: absolute;
                left: 8px;
                top: 12px;
            width: 60%;
            color: #999;
                font-size: 16px;
                display: inline-block;
                padding: 4px 10px;
                font-weight: 400;
                background-color: rgba(255,255,255,0);
                transition(color .3s, top .3s, background-color .8s);
            background-color: rgba(255,255,255,1);

            &.active{
                    top: -11px;
                    color: #555;
                    background-color: rgba(255,255,255,1);
                    width: auto;
                }
            }
            textarea{
                resize: none;
                height: 200px;
            }
        }

        button{
        cursor: pointer;
        background-color: $brand-color;
        border: none;
        color: #fff;
        padding: 12px 0;
        float: right;
        &:hover{
                background-color: lighten($brand-color, 5%);
            }
        }

        .clear:after{
            content: "";
            display: table;
            clear: both;
        }
        $pad: 10px;
        .grid {
            background: white;
            //margin: 0 0 $pad 0;
            
            &:after {
                /* Or @extend clearfix */
                content: "";
                display: table;
                clear: both;
            }
        }
        [class*='col-'] {
            float: left;
            padding-right: $pad;
            .grid &:last-of-type {
                padding-right: 0;
            }
        }
        .col-2-3 {
            width: 66.66%;
        }
        .col-1-3 {
            width: 33.33%;
        }
        .col-1-2 {
            width: 50%;
        }
        .col-1-4 {
            width: 25%;
        }
        @media (max-width: 760px) {
            .col-1-4-sm, .col-1-3, .col-2-3 {
                width: 100%;
            }
            [class*='col-'] {
                padding-right: 0px;
            }  
        }
        .col-1-8 {
            width: 12.5%;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


</body>
</html>
