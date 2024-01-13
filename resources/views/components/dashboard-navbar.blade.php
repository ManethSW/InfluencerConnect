<div class="side-bar">
    <div class="side-bar-top">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/images/influencer_connect_logo.png" alt="Influencer Connect"  class="navbar-logo">
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