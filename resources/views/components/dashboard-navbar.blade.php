<div class="side-navbar">
    <div class="side-navbar-top">
        <h1 class="side-navbar-header">DASHBOARD</h1>
        <ul class="side-navbar-items flex-column">
            <a href="{{ route('dashboard') }}" class="side-navbar-main-link">Analytics</a>
        </ul>
        <ul class="side-navbar-items flex-column">
            <h3>Manage</h3>
            <li class="side-navbar-item-links">
                <i class="fa-solid fa-user"></i>
                <a class="nav-link" href="{{ route('users.index') }}">
                    Users
                </a>
            </li>
            <li class="side-navbar-item-links">
                <i class="fa-solid fa-filter"></i>
                <a class="nav-link" href="{{ route('categories.index') }}">
                    Categories
                </a>
            </li>
            <li class="side-navbar-item-links">
                <i class="fa-solid fa-award"></i>
                <a class="nav-link" href="{{ route('featuredInfluencers.index') }}">
                    Featured Influencers
                </a>
            </li>
            <li class="side-navbar-item-links">
                <i class="fa-solid fa-handshake-simple"></i>
                <a class="nav-link" href="{{ route('collaborations.index') }}">
                    Collaborations
                </a>
            </li>
            <li class="side-navbar-item-links">
                <i class="fa-solid fa-file"></i>
                <a class="nav-link" href="{{ route('proposals.index') }}">
                    Proposals
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
