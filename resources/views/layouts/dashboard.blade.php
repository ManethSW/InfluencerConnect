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
        @include('components.dashboard-navbar')
    </div>
    <main class="dashboard-body">
        <div class="dashboard-header">
            <a href="{{ url('/') }}">
                <img src="/images/influencer_connect_logo.png" alt="Influencer Connect"  class="dashboard-header-logo">
            </a>
            {{-- <h1>DASHBOARD</h1> --}}
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
