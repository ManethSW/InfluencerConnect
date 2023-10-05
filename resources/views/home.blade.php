@extends('layouts.app')

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
                    <div class="carousel-item active">
                        <div class="items">
                            <x-influencer-card image="/images/influencer-1.png" alt="influencer" name="Emily Johnson"
                                category="Fashion & Beauty" rating="4"
                                description="Fashion and beauty influencer, setting trends and sharing makeup tips." />
                            <x-influencer-card image="/images/influencer-2.png" alt="influencer" name="Alex Rodriguez"
                                category="Fitness & Wellness" rating="5"
                                description="Fitness guru inspiring healthier lives with workouts and wellness advice" />
                            <x-influencer-card image="/images/influencer-2.png" alt="influencer" name="James Smith"
                                category="Tech & Gadgets" rating="5"
                                description="Tech expert sharing latest trends and gadget insights." />
                            <x-influencer-card image="/images/influencer-1.png" alt="influencer" name="Emily Johnson"
                                category="Fashion & Beauty" rating="4"
                                description="Fashion and beauty influencer, setting trends and sharing makeup tips." />
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="items">
                            <x-influencer-card image="/images/influencer-1.png" alt="influencer" name="Emily Johnson"
                                category="Fashion & Beauty" rating="4"
                                description="Fashion and beauty influencer, setting trends and sharing makeup tips." />
                            <x-influencer-card image="/images/influencer-2.png" alt="influencer" name="Alex Rodriguez"
                                category="Fitness & Wellness" rating="5"
                                description="Fitness guru inspiring healthier lives with workouts and wellness advice" />
                            <x-influencer-card image="/images/influencer-2.png" alt="influencer" name="James Smith"
                                category="Tech & Gadgets" rating="5"
                                description="Tech expert sharing latest trends and gadget insights." />
                            <x-influencer-card image="/images/influencer-1.png" alt="influencer" name="Emily Johnson"
                                category="Fashion & Beauty" rating="4"
                                description="Fashion and beauty influencer, setting trends and sharing makeup tips." />
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="items">
                            <x-influencer-card image="/images/influencer-1.png" alt="influencer" name="Emily Johnson"
                                category="Fashion & Beauty" rating="4"
                                description="Fashion and beauty influencer, setting trends and sharing makeup tips." />
                            <x-influencer-card image="/images/influencer-2.png" alt="influencer" name="Alex Rodriguez"
                                category="Fitness & Wellness" rating="5"
                                description="Fitness guru inspiring healthier lives with workouts and wellness advice" />
                            <x-influencer-card image="/images/influencer-2.png" alt="influencer" name="James Smith"
                                category="Tech & Gadgets" rating="5"
                                description="Tech expert sharing latest trends and gadget insights." />
                            <x-influencer-card image="/images/influencer-1.png" alt="influencer" name="Emily Johnson"
                                category="Fashion & Beauty" rating="4"
                                description="Fashion and beauty influencer, setting trends and sharing makeup tips." />
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
@endsection
