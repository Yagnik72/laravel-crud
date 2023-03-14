<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @stack('title')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Custom Css --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>

<body class="bg-dark">
    <header>
        <nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}"><span class="text-danger">Hello</span> World</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Request::is('/') ? 'active' : ''  }}">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item {{ Request::is('registration') ? 'active' : ''  }}">
                            <a class="nav-link" href="{{url('/registration')}}">Register</a>
                        </li>
                        <li class="nav-item {{ Request::is('customer') ? 'active' : ''  }}">
                            <a class="nav-link" href="{{route('customer.page')}}">Customers</a>
                        </li>
                    </ul>
                </div>
                <div class="form-inline my-2 my-lg-0">

                        @if (session()->has('user_name'))
                            {{-- <a href="{{ route('session.unset') }}"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{session()->get('user_name')}}</button></a> --}}
                            <a href="{{ route('session.unset') }}"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Session Destroy</button></a>
                        @else
                            <a href="{{ route('set-session.set') }}"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Session Set</button></a>

                        @endif
                </div>
            </div>
        </nav>
    </header>
