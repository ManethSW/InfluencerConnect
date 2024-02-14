@extends('layouts.app')

@section('content')
    <div class="auth-navbar">
        @include('components.navbar')
    </div>
    <div class="auth-container">
        <div class="auth-hero"></div>
        <div class="login-container container">
            <div class="row justify-content-center">
                <div class="form-login">
                    <div class="auth-header">
                        <h2>Welcome,
                            @php
                                $time = date("H");
                                if ($time < "12") {
                                    echo "Good Morning";
                                } elseif ($time < "17") {
                                    echo "Good Afternoon";
                                } else {
                                    echo "Good Evening";
                                }
                            @endphp
                        </h2>
                        <h3>Select your prefered user type</h3>
                    </div>
                    <form method="POST" action="{{ route('user-type.store') }}">
                        @csrf
                        <input type="hidden" id="user_type" name="user_type">
                        <div class="user-types">
                            <div class="user-type-box" data-type="influencer">
                                <div class="user-type-image-heading">
                                    <i class="fa-solid fa-user"></i>
                                    <h2>Influencer</h2>
                                </div>
                                <p>As an influencer you can link your socials, upload you portfolio, communicate with
                                    businesses and post yourself for collaborations
                                </p>
                                <span class="check-icon">
                                    <img src="/icons/select-check.svg">
                                </span>
                            </div>
                            <div class="user-type-box" data-type="business">
                                <div class="user-type-image-heading">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <h2>Business</h2>
                                </div>
                                <p>As a business, you can find influencers to collaborate with, manage your campaigns,
                                    and track your results.</p>
                                <span class="check-icon">
                                <img src="/icons/select-check.svg">
                            </span>
                            </div>
                        </div>
                        <button type="submit" class="auth-button">
                            {{ __('Register') }}
                        </button>
                    </form>
                    <div class="other-action">
                        <h3>
                            Have an account?
                            <a href="{{ route('login') }}">
                                Login here
                            </a>
                        </h3>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        var userTypeBoxes = document.querySelectorAll('.user-type-box');
        var userTypeInput = document.getElementById('user_type');

        userTypeBoxes.forEach(function (box) {
            box.addEventListener('click', function () {
                userTypeInput.value = this.getAttribute('data-type');

                // Add a class to highlight the selected box
                userTypeBoxes.forEach(function (box) {
                    box.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
    </script>
@endsection
