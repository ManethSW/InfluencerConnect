@extends('layouts.app')

@php
    $chunkedInfluencerCards = $influencerCards->chunk(4);
@endphp

@section('content')
    <div class="container home-container justify-content-center">
        <div class="hero rounded-5">
            <div class="hero-items">
                <div class="hero-text">
                    <div class="hero-heading">
                        <h1>Connect With Influencers,</h1>
                        <h1>Grow Your Business</h1>
                    </div>
                    <p>
                        "Join InfluencerConnect to effortlessly connect with influencers and supercharge your brand's
                        reach. Discover, collaborate, and thrive in the digital age with ease!"
                    </p>
                </div>
                <div class="call-action-btn">
                    <a class="" href="#!" role="button">Explore Now</a>
                    <img src="/icons/down.svg">
                </div>
            </div>
        </div>
        <div class="form-outline search">
            <input id="search-input" type="search" id="form1" class="form-control"
                placeholder="Search for a business or influencer . . . " />
            <img src="/icons/search.svg" alt="search" class="search-icon">
        </div>
        <div class="influencers">
            <div class="influencer-header">
                <h2>Featured Influencers</h2>
            </div>
            <div id="carouselExampleIndicators" class="container-carousel carousel slide">
                <div class="carousel-inner">
                    @foreach ($chunkedInfluencerCards as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="items">
                                @foreach ($chunk as $influencerCard)
                                    @if ($influencerCard->visible)
                                        <x-influencer-card image="storage/{{ $influencerCard->avatar }}" alt="influencer"
                                            name="{{ $influencerCard->user->name }}"
                                            category="{{ $influencerCard->influencerCategory->name }}"
                                            rating="{{ $influencerCard->rating }}"
                                            description="{{ $influencerCard->description }}" />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="influencers-categories">
            <div class="influencer-header">
                <h2>Influencers By Category</h2>
                <div id="heading-underline"></div>
            </div>
            <div class="category-items">
                <div class="items-row">
                    <div class="category-item">
                        <img src="/icons/airplane.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Travel and Adventure</h3>
                    </div>
                    <div class="category-item">
                        <img src="/icons/fashion.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Fashion and Beauty</h3>
                    </div>
                    <div class="category-item">
                        <img src="/icons/gadget.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Tech and Gadgets</h3>
                    </div>
                    <div class="category-item">
                        <img src="/icons/fashion.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Music and Entertainment</h3>
                    </div>
                </div>
                <div class="items-row">
                    <div class="category-item">
                        <img src="/icons/game-controller.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Gaming and Esports</h3>
                    </div>
                    <div class="category-item">
                        <img src="/icons/paw.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Pets and Animals</h3>
                    </div>
                    <div class="category-item">
                        <img src="/icons/restaurant.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Food and Culinary</h3>
                    </div>
                    <div class="category-item">
                        <img src="/icons/weight.png" alt="fashion" height="50px">
                        <div class="item-divider"></div>
                        <h3>Fitness and Wellness</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
