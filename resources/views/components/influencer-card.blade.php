@props(['image', 'alt', 'name', 'category', 'rating', 'description'])

<div class="influencer-card">
    <div class="card-section">
        <div class="card-section-one">
            <div class="card-rating">
                <h3>{{ $rating }}</h3>
                <img src="/icons/star-filled.svg" alt="star">
            </div>
            <div class="card-avatar-frame">
                <div class="card-avatar">
                    @if ($image != "" )
                        <img src="{{ asset('images/hero.png') }}" alt="{{ $alt }}">
{{--                        @dd($image)--}}
                    @else
                        <i class="fa-solid fa-user"></i>
                    @endif
                </div>
            </div>
            <div class="card-info">
                <h3>{{ $name }}</h3>
                <h4>{{ $category }}</h4>
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
