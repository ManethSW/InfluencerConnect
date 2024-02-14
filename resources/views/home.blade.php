@extends('layouts.app')

{{--@php--}}
{{--    $chunkedInfluencerCards = $influencerCards->chunk(4);--}}
{{--@endphp--}}
@include('components.navbar')

@section('content')
    <div class="container home-container justify-content-center">
        @include('components.hero')
        <div class="section">
            <div class="section-header">
                <div class="section-header-content">
                    <h2>Featured Influencers</h2>
                    <h4>Get in touch with the best</h4>
                </div>
                <div class="section-header-divider"></div>
            </div>
            <div id="carouselExampleIndicators" class="container-carousel carousel slide">
                <div class="carousel-inner">
{{--                    @foreach ($chunkedInfluencerCards as $index => $chunk)--}}
{{--                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">--}}
{{--                            <div class="items">--}}
{{--                                @foreach ($chunk as $influencerCard)--}}
{{--                                    @if ($influencerCard->visible)--}}
{{--                                        <x-influencer-card image="storage/{{ $influencerCard->avatar }}" alt="influencer"--}}
{{--                                            name="{{ $influencerCard->user->name }}"--}}
{{--                                            category="{{ $influencerCard->influencerCategory->name }}"--}}
{{--                                            rating="{{ $influencerCard->rating }}"--}}
{{--                                            description="{{ $influencerCard->description }}" />--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                    <div class="influencer-card">
                        <div class="card-section">
                            <div class="card-section-one">
                                <div class="card-rating">
                                    <h3>4.5</h3>
                                    <img src="/icons/star-filled.svg" alt="star">
                                </div>
                                <div class="card-avatar-frame">
                                    <div class="card-avatar">
{{--                                        @if ($image != "" )--}}
{{--                                            <img src="{{ asset($image) }}" alt="{{ $alt }}">--}}
                                            {{--                        @dd($image)--}}
{{--                                        @else--}}
                                            <i class="fa-solid fa-user"></i>
{{--                                        @endif--}}
                                    </div>
                                </div>
                                <div class="card-info">
                                    <h3>Maneth Weerasinghe</h3>
                                    <h4>Health & Fitness</h4>
                                </div>
                                <div class="card-links">
                                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                    <div class="link-divider"></div>
                                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    <div class="link-divider"></div>
                                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                    <div class="link-divider"></div>
                                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-section">
                            <div class="card-analytics">
                                <div>
                                    <h3>Collabs</h3>
                                    <h4>12</h4>
                                </div>
                                <div>
                                    <h3>Reviews</h3>
                                    <h4>12</h4>
                                </div>
                            </div>
                            <div class="card-action-buttons">
                                <button class="chat">
                                    <i class="fa-solid fa-comment"></i>
                                    <h3>Chat</h3>
                                </button>
                                <button class="view">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
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
