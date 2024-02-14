<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Influencer Connect') }}</title>
    @vite(['resources/sass/app.scss', 'resources/sass/registerLogin.scss', 'resources/js/app.js'])
    <script defer src="https://kit.fontawesome.com/582a81fd83.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>

<body id="body">
    <div id="app">
        <main>
            @yield('content')
        </main>
        <div>
            @yield('footer')
        </div>
    </div>
</body>

</html>
