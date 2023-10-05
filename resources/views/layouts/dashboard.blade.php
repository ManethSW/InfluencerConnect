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
    @vite(['resources/sass/app.scss', 'resources/sass/dashboard.scss', 'resources/js/app.js'])
    <script defer src="https://kit.fontawesome.com/582a81fd83.js" crossorigin="anonymous"></script>
</head>

<body id="body">
    <div id="dashboard">
        <div class="side-bar">
            <div class="side-bar-top">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo.svg" alt="Influencer Connect" height="60" class="navbar-logo">
                </a>
                <ul class="nav-items flex-column">
                    <h3>Profile</h3>
                </ul>
                <ul class="nav-items flex-column">
                    <h3>Analytics</h3>
                </ul>
                <ul class="nav-items flex-column">
                    <h3>Manage</h3>
                    <li class="nav-item-dashboard">
                        <i class="fa-solid fa-user"></i>
                        <a class="nav-link" href="{{ route('users.index') }}">
                            Users
                        </a>
                    </li>
                    <li class="nav-item-dashboard">
                        <i class="fa-solid fa-filter"></i>
                        <a class="nav-link" href="{{ route('users.index') }}">
                            Categories
                        </a>
                    </li>
                    <li class="nav-item-dashboard">
                        <i class="fa-regular fa-id-card"></i>
                        <a class="nav-link" href="{{ route('users.index') }}">
                            Influencer Cards
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="nav-link logout" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   {{ __('Logout') }}
                </a>
                
            </div>
        </div>
    </div>
    <main class="dashboard-body">
        <div class="dashboard-header">
            <h1>DASHBOARD</h1>
            <h2>{{ Auth::user()->name }}</h2>
        </div>
        <div class="dashboard-content">
            @yield('content')
        </div>
    </main>
</body>

</html>
