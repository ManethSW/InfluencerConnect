<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Influencer Connect') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/sass/registerLogin.scss', 'resources/sass/home.scss', 'resources/js/app.js'])
    <script defer src="https://kit.fontawesome.com/582a81fd83.js" crossorigin="anonymous"></script>
</head>

<body id="body">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo.svg" alt="Influencer Connect" height="60" class="navbar-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item normal-link">
                                <a class="nav-link{{ request()->routeIs(['login', 'user-type', 'user-type.create', 'auth.register-business', 'auth.register-business']) ? '' : ' active-custom active' }}"
                                    href="{{ route('home') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Influencers</a>
                            </li>
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Businesses</a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-login nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-register nav-link"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item normal-link">
                                <a class="nav-link active-custom active" href="#">Home</a>
                            </li>
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Influencers</a>
                            </li>
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Businesses</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="user-dropdown nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Profile</a>
                                    {{-- check users role_id through data dump --}}

                                    @if (Auth::user()->role_id->name == 'SuperAdministrator')
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                    @endif
                                    <hr class="dropdown-divider">
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
    </div>
    <main class="py-4">
        @yield('content')
    </main>
    <div>
        @yield('footer')
    </div>
</body>

</html>
