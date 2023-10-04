@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-register">
                <div class="card-header form-header-register">
                    <p>{{ __('Register - Business') }} </p>
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
                <form method="POST" action="{{ route('register-business.store') }}">
                    @csrf
                    <div class="inputs">
                        <x-form-input-field field="name" label="Business Name" type="text"
                            placeholder="Enter the business name" />
                        <x-form-input-field field="email" label="Business Email Address" type="email"
                            placeholder="Enter the business email" />
                        <x-form-input-field field="phone" label="Business Phone Number" type="tel"
                            placeholder="Enter the business phone number" />
                        <x-form-input-field field="dob" label="Business Website" type="text"
                            placeholder="Enter the website URL" />
                        <div id="input-address">
                            <x-form-input-field field="address" label="Business Address" type="text"
                                placeholder="Enter your business headquarters address" />
                        </div>
                        <x-form-input-field field="business_type" label="Business Type" type="text"
                            placeholder="Enter the industry your business specialize" />
                        <x-form-input-field field="business_size" label="Business Size" type="number"
                            placeholder="Enter the number of staff" />
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
