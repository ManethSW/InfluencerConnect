<nav class="nav navbar-expand-md">
    <a href="{{ url('/') }}">
        <img src="/images/influencer_connect_logo.png" alt="Influencer Connect" class="navbar-logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav-body navbar-nav">
        @guest
            <div class="nav-body-content">
                <a class="link {{ request()->is('/') || request()->routeIs('home') ? ' active-custom active' : '' }}"
                   href="{{ route('home') }}">{{ __('Home') }}</a>
                <a class="link" href="#">Influencers</a>
                <a class="link" href="#">Businesses</a>
            </div>
            <div class="nav-body-content">
                <div class="search">
                    <input id="search-input" placeholder="Search for influencer or business..."/>
                    <img id="search-icon" src="/icons/search.svg" alt="search">
                </div>
                @if (Route::has('login'))
                    <a class="btn btn-login" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
                @if (Route::has('register'))
                    <a class="btn btn-register " href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </div>
        @else
            <div class="nav-body-content">
                <a class="link {{ request()->is('/') || request()->routeIs('home') ? ' active-custom active' : '' }}"
                   href="{{ route('home') }}">{{ __('Home') }}</a>
                <a class="link" href="#">Influencers</a>
                <a class="link" href="#">Businesses</a>
            </div>
            <div class="nav-body-content">
                <div class="search">
                    <input id="search-input" placeholder="Search for influencer or business..."/>
                    <img id="search-icon" src="/icons/search.svg" alt="search">
                </div>
                <div>
                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                            class="dropdownbutton flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full md:me-0 dark:text-white"
                            type="button">
                        <span class="sr-only">Open user menu</span>
                        <div class="pr-2">
                            @if (empty(Auth::user()->avatar))
                                <i class="fa-solid fa-user avatar"></i>
                            @else
                                <img class="w-8 h-8 me-2 rounded-full" src="{{ Auth::user()->avatar }}"
                                     alt="user photo">
                            @endif
                        </div>
                        {{ Auth::user()->name }}
                        <div class="px-2">
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m1 1 4 4 4-4"/>
                            </svg>
                        </div>
                    </button>
                    <div id="dropdownAvatarName"
                         class="z-10 hidden bg-white divide-y divide-gray-300 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="user-role-email px-2.5 py-2.5">
                            <div class="font-medium">{{ Auth::user()->role_id->name }}</div>
                            <div class="truncate">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="dropdown-links" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                            @if (Auth::user()->role_id->name == 'SuperAdministrator')
                                <a href="{{ route('dashboard') }}"
                                   class="hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            @endif
                            <a href="{{ route('profile') }}"
                               class=" hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                            <a href="{{ route('profile') }}"
                               class=" hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Collaborations</a>
                            <a href="#"
                               class=" hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                        </div>
                        <div class="dropdown-links">
                            <a class="hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </ul>
</nav>
