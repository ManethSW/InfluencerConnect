{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="form-register">--}}
{{--                <div class="card-header form-header-register">--}}
{{--                    <p>{{ __('Register') }} </p>--}}
{{--                    <p>--}}
{{--                        @php--}}
{{--                            $currentTime = date('H:i:s');--}}
{{--                            $morningTime = '06:00:00';--}}
{{--                            $afternoonTime = '12:00:00';--}}
{{--                            $eveningTime = '18:00:00';--}}
{{--                            --}}
{{--                            if ($currentTime >= $morningTime && $currentTime < $afternoonTime) {--}}
{{--                                echo 'Good Morning!';--}}
{{--                            } elseif ($currentTime >= $afternoonTime && $currentTime < $eveningTime) {--}}
{{--                                echo 'Good Afternoon!';--}}
{{--                            } else {--}}
{{--                                echo 'Good Evening!';--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="divider"></div>--}}
{{--                <form method="POST" action="{{ route('register') }}">--}}
{{--                    @csrf--}}
{{--                    <div class="inputs">--}}
{{--                        <x-form-input-field field="name" label="Name" type="text" placeholder="Enter your name" />--}}
{{--                        <x-form-input-field field="email" label="Email Address" type="email"--}}
{{--                            placeholder="Enter your email" />--}}
{{--                        <x-form-input-field field="phone" label="Phone Number" type="tel"--}}
{{--                            placeholder="Enter your phone number" />--}}
{{--                        <x-form-input-field field="dob" label="Date of Birth" type="date"--}}
{{--                            placeholder="Enter your dob" />--}}
{{--                        <div id="input-address">--}}
{{--                            <x-form-input-field field="address" label="Address" type="text"--}}
{{--                                placeholder="Enter your residential address" />--}}
{{--                        </div>--}}
{{--                        <x-form-input-field field="password" label="Password" type="password"--}}
{{--                            placeholder="Enter a password" />--}}
{{--                        <x-form-input-field field="password_confirmation" label="Confirm Password" type="password"--}}
{{--                            placeholder="Retype password" />--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="user_type">User Type</label>--}}
{{--                        <select name="user_type" id="user_type" required>--}}
{{--                            <option value="influencer">Influencer</option>--}}
{{--                            <option value="business">Business</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="divider"></div>--}}
{{--                    <p class="login-link">Already have an account?<a href="{{ route('login') }}">Login</a></p>--}}
{{--                    <button type="submit" class="btn">--}}
{{--                        {{ __('Register') }}--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
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
