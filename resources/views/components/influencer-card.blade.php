@props(['image', 'alt', 'name', 'category', 'rating', 'description'])

<div class="influencer-card">
    <div class="influencer-img">
        <img src="{{ $image }}" alt="{{ $alt }}" height="207px">
    </div>
    <div class="influencer-content">
        <h3>{{ $name }}</h3>
        <p>{{ $category }}</p>
        <div class="influencer-rating">
            @for ($i = 0; $i < $rating; $i++)
                <img src="/icons/star-filled.svg" alt="star">
            @endfor
            @for ($i = $rating; $i < 5; $i++)
                <img src="/icons/star-outlined.svg" alt="star">
            @endfor
        </div>
        <div class="content-divider"></div>
        <p>{{ $description }}</p>
        <button>Contact Influencer</button>
    </div>
</div>
