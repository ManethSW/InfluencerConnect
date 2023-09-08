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
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item normal-link">
                                <a class="nav-link{{ request()->routeIs(['login', 'register']) ? '' : ' active-custom active' }}"
                                    href="{{ route('home') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Influencers</a>
                            </li>
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Businesses</a>
                            </li>
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Dashboard</a>
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
                            <li class="nav-item normal-link">
                                <a class="nav-link" href="#">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="user-dropdown nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Profile</a>
                                    <a class="dropdown-item" href="#">Dashboard</a>
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <div class="footer-content">
            <section class="footer-links d-flex justify-content-center p-4 border-bottom">
                <a href="#!" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
            </section>
            <div class="footer-text">
                <div class="col-xl-3">
                    <h6 class="text-uppercase fw-bold">
                        InfluencerConnect
                        <div class="footer-title-underline"></div>
                    </h6>
                    <p>
                        "Connect with influencers and supercharge your brand's
                        reach. Discover, collaborate, and thrive in the digital age with ease!"
                    </p>
                </div>
                <div class="useful-links col-xl-2">
                    <h6 class="text-uppercase fw-bold">
                        Useful links
                        <div class="footer-title-underline"></div>
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Influencers</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Businesses</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Dashboard</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Profile</a>
                    </p>
                </div>
                <div class="contact col-xl-3">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold">
                        Contact
                        <div class="footer-title-underline"></div>
                    </h6>
                    <p>
                        1234, Main Street
                        <i class="fas fa-home"></i>
                    </p>
                    <p>
                        info@example.com
                        <i class="fas fa-envelope"></i>
                    </p>
                    <p>+94 77 123 4567<i class="fas fa-phone"></i></p>
                    <p>+94 011 123 4567<i class="fas fa-print"></i></p>
                </div>
            </div>
            </section>
        </div>

        <!-- Copyright -->
        <div class="footer-copyright text-center p-4">
            <a class="text-reset fw-bold" href="#">© 2021 Copyright: influencerconnect.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>
