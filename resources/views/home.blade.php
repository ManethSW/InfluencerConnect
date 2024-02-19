@extends('layouts.app')

@include('components.navbar')

@section('content')
    <div class="container home-container justify-content-center">
        @include('components.hero')
        <div class="section" id="featured_influencers">
            <div class="section-header">
                <div class="section-header-content">
                    <h2>Featured Influencers</h2>
                    <h4>Get in touch with the best</h4>
                </div>
                <div class="section-header-divider"></div>
            </div>
            <div class="featured-influencers-container">
                @foreach ($featuredInfluencers as $featuredInfluencer)
                    <x-influencer-card image="{{ asset('storage/' . $featuredInfluencer->user->avatar) }}" alt="influencer"
                                       name="{{ $featuredInfluencer->user->name }}"
                                       category="{{ $featuredInfluencer->influencerCategory->name }}"
                                       rating="4.5"
                                       description="{{ $featuredInfluencer->description }}"/>
                @endforeach
            </div>
        </div>
        <div class="section">
            <div class="section-header">
                <div class="section-header-content">
                    <h2>Explore Businesses</h2>
                    <h4>Influencers this is your call to explore and find collaborations that best suit you and venture
                        out!</h4>
                </div>
                <div class="section-header-divider"></div>
            </div>
            <div class="category-items">
                <div class="items-row">
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/airplane.png" alt="fashion">
                            <div class="item-divider"></div>
                            <h3>Travel and Adventure</h3>
                        </div>
                    </div>
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/fashion.png" alt="fashion">
                            <div class="item-divider"></div>
                            <h3>Fashion and Beauty</h3>
                        </div>
                    </div>
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/gadget.png" alt="fashion">
                            <div class="item-divider"></div>
                            <h3>Tech and Gadgets</h3>
                        </div>
                    </div>
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/music.png" alt="fashion">
                            <div class="item-divider"></div>
                            <h3>Music and Entertainment</h3>
                        </div>
                    </div>
                </div>
                <div class="items-row">
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/game-controller.png" alt="fashion" height="50px">
                            <div class="item-divider"></div>
                            <h3>Gaming and Esports</h3>
                        </div>
                    </div>
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/paw.png" alt="fashion" height="50px">
                            <div class="item-divider"></div>
                            <h3>Pets and Animals</h3>
                        </div>
                    </div>
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/restaurant.png" alt="fashion" height="50px">
                            <div class="item-divider"></div>
                            <h3>Food and Culinary</h3>
                        </div>
                    </div>
                    <div class="category-item-background-image">
                        <div class="category-item-glass-effect">
                            <img src="/icons/weight.png" alt="fashion" height="50px">
                            <div class="item-divider"></div>
                            <h3>Fitness and Wellness</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <x-footer/>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('explore-button').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('featured_influencers').scrollIntoView({behavior: 'smooth'});
        });
    });
</script>
