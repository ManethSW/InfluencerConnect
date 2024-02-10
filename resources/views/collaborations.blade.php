@extends('layouts.app')

@section('content')
    <div class="collaborations-container">
        <div class="collaborations-header">
            <div class="header-content">
                <h2>Collaborations</h2>
            </div>
            <div class="header-navigation">
                <a href="?page=incoming" class="{{ $activePage == 'incoming' ? 'active' : '' }}">Incoming Offers</a>
                <a href="?page=proposals" class="{{ $activePage == 'proposals' ? 'active' : '' }}">My Proposals</a>
                <a href="?page=active" class="{{ $activePage == 'active' ? 'active' : '' }}">Active Collaborations</a>
            </div>
        </div>
        <div class="section-header-divider"></div>
        <div class="collaborations-body">
            @switch($activePage)
                @case('incoming')
                    @include('components.incoming-offers')
                    @break

                @case('proposals')
                    @include('components.my-proposals')
                    @break

                @case('active')
                    @include('components.active-collaborations')
                    @break

                @default
                    <p>No page selected.</p>
            @endswitch
        </div>
    </div>
@endsection
