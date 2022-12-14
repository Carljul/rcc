<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('font/css/font-awesome.css')}}">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

    <script src="{{asset('js/bootstrap/popper.min.js')}}"></script>

    @stack('css')
</head>
<body>
    <div id="app">
        @if (request()->route()->getName() != 'login')
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                @can('view')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.index') }}">{{ __('Users') }}</a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('defaults.index') }}">{{ __('Defaults') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('deceased.index') }}">{{ __('Deceased') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="import-nav" href="{{ route('deceased.import') }}">{{ __('Import') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('deceased.expired.index') }}">{{ __('Expired') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('deceased.deleted') }}">{{ __('Deleted') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a href="{{ route('change-pin.form') }}" class="dropdown-item">
                                            {{ __('Change PIN') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    {{-- Bootstrap js --}}
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('js/common.js?'.strtotime(now()))}}"></script>
    @if(Auth::check())
        <script src="{{asset('js/exporting.js?'.strtotime(now()))}}"></script>
    @endif
    @stack('js')
</body>
</html>
