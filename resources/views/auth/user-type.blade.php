@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-register form-register-user-type">
                <div class="card-header form-header-register user-type-form-header-register">
                    <p>{{ __('Select User Type') }} </p>
                </div>
                <div class="divider"></div>
                <form method="POST" action="{{ route('user-type.store') }}">
                    @csrf
                    <input type="hidden" name="user_type" id="user_type">
                    <div class="user-types">
                        <div class="user-type-box" data-type="influencer">
                            <img src="/icons/select-influencer.svg">
                            <h2>Influencer</h2>
                            <div class="user-type-box-divider"></div>
                            <p>As an influencer you can link your socials, upload your portfolio, communicate with
                                businesses and post yourself for collaborations</p>
                            <span class="check-icon">
                                <img src="/icons/select-check.svg">
                            </span>
                        </div>
                        <div class="user-type-box" data-type="individual">
                            <img src="/icons/select-influencer.svg">
                            <h2>Individual</h2>
                            <div class="user-type-box-divider"></div>
                            <p>
                                As an individual, you can find influencers to collaborate with, manage your campaigns, post brand deals and track your results.
                            </p>
                            <span class="check-icon">
                                <img src="/icons/select-check.svg">
                            </span>
                        </div>
                        <div class="user-type-box" data-type="business">
                            <img src="/icons/select-business.svg">
                            <h2>Business</h2>
                            <div class="user-type-box-divider"></div>
                            <p>As a business, you can find influencers to collaborate with, manage your campaigns, post brand deals and track
                                your results.</p>
                            <span class="check-icon">
                                <img src="/icons/select-check.svg">
                            </span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <button type="submit" class="btn">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        var userTypeBoxes = document.querySelectorAll('.user-type-box');
        var userTypeInput = document.getElementById('user_type');

        userTypeBoxes.forEach(function(box) {
            box.addEventListener('click', function() {
                userTypeInput.value = this.getAttribute('data-type');

                // Add a class to highlight the selected box
                userTypeBoxes.forEach(function(box) {
                    box.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
    </script>
@endsection

@section('footer')
    <x-footer />
@endsection
