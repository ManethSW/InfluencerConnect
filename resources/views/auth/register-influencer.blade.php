@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-register">
                <div class="card-header form-header-register">
                    <p>{{ __('Register - Influencer') }} </p>
                    <p>
                        @php
                            $currentTime = date('H:i:s');
                            $morningTime = '06:00:00';
                            $afternoonTime = '12:00:00';
                            $eveningTime = '18:00:00';
                            
                            if ($currentTime >= $morningTime && $currentTime < $afternoonTime) {
                                echo 'Good Morning!';
                            } elseif ($currentTime >= $afternoonTime && $currentTime < $eveningTime) {
                                echo 'Good Afternoon!';
                            } else {
                                echo 'Good Evening!';
                            }
                        @endphp
                    </p>
                </div>
                <div class="divider"></div>
                <form method="POST" action="{{ route('register-influencer.store') }}">
                    @csrf
                    <div class="inputs">
                        <x-form-input-field field="name" label="Name" type="text" placeholder="Enter your name" />
                        <x-form-input-field field="email" label="Email Address" type="email"
                            placeholder="Enter your email" />
                        <x-form-input-field field="phone" label="Phone Number" type="tel"
                            placeholder="Enter your phone number" />
                        <x-form-input-field field="dob" label="Date of Birth" type="date"
                            placeholder="Enter your dob" />
                        <div id="input-address">
                            <x-form-input-field field="address" label="Address" type="text"
                                placeholder="Enter your residential address" />
                        </div>
                        <x-form-input-field field="password" label="Password" type="password"
                            placeholder="Enter a password" />
                        <x-form-input-field field="password_confirmation" label="Confirm Password" type="password"
                            placeholder="Retype password" />
                    </div>
                    <div class="divider"></div>
                    <p class="login-link">Already have an account?<a href="{{ route('login') }}">Login</a></p>
                    <button type="submit" class="btn">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
