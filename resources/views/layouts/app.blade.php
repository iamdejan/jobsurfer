<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jobsurfer') }}</title>

    <!-- Scripts -->
    <script src="{{ url('../public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <style type="text/css">
        .sidenav {
            height: 100%;
            width: 181px;
            position: fixed;
            top: 55.033px;
            left: 0;
            background-color: rgb(200, 230, 250);
            overflow-x: hidden;
            padding-top: 1.5rem!important;
        }

        .sidenav a {
            padding: 10px 20px 10px 20px;
            text-decoration: none!important;
            font-size: 15px;
            text-align: center;
            color: rgb(100, 100, 100);
            display: block;
        }

        .sidenav a:hover {
            background-color: white;
            color: black;
        }
    </style>

    <!-- Styles -->
    <link href="{{ url('../public/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav style="position: relative;" class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                @php
                $url = "/";
                @endphp
                @if(Auth::guard('seeker')->check())
                    @php
                    $url = "/seeker/home";
                    @endphp
                @elseif(Auth::guard('client')->check())
                    @php
                    $url = "/client/home";
                    @endphp
                @elseif(Auth::guard('staff')->check())
                    @php
                    $url = "/staff/home";
                    @endphp
                @endif
                <a class="navbar-brand" href="{{ url($url) }}">
                    {{ config('app.name', 'Jobsurfer') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <li><a class="nav-link" href="{{ url('/seeker/login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ url('/seeker/register') }}">Register</a></li>
                        @else

                            @if(Auth::guard('seeker')->check())
                                @php
                                $guard = Auth::guard('seeker');
                                $guardname = "seeker";
                                $name = $guard->user()->fName . ' ' . $guard->user()->lName;
                                @endphp
                            @elseif(Auth::guard('client')->check())
                                @php
                                $guard = Auth::guard('client');
                                $guardname = "client";
                                $name = $guard->user()->ClientName;
                                @endphp
                            @elseif(Auth::guard('staff')->check())
                                @php
                                $guard = Auth::guard('staff');
                                $guardname = "staff";
                                $name = $guard->user()->StaffName;
                                @endphp
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ $name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/'. $guardname .'/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/'. $guardname .'/logout') }}" method="POST" style="display: none;">
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
