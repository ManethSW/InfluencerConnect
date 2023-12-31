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
    @vite(['resources/sass/app.scss', 'resources/sass/dashboard.scss', 'resources/sass/dashboard-edit.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
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
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            Categories
                        </a>
                    </li>
                    <li class="nav-item-dashboard">
                        <i class="fa-regular fa-id-card"></i>
                        <a class="nav-link" href="{{ route('influencerCards.index') }}">
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
            @section('content')
                <!-- Default content goes here -->
                <div class="dashboard-default-content-container">
                    <h2>Dashboard Analytics Coming Soon</h2>
                    <p>Access Manage Features Through The Side Navigation</p>
                </div>
            @show
        </div>

    </main>
    <!-- Success Message -->
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed bottom-0 right-0 bg-green-500 text-white p-4 rounded m-4  feedback-popup" style="display: none;">
        <p>
            @if (session('success'))
                {{ session('success') }}
            @endif
        </p>
    </div>
    <!-- Error Message -->
    @if ($errors->any())
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="fixed bottom-0 right-0 bg-red-500 text-white p-4 rounded m-4  feedback-popup" style="display: none;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>
