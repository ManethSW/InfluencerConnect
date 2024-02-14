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
                        <h2>Business
                        </h2>
                        <h3>Great! Now enter your email and password to get started</h3>
                    </div>
                    <form method="POST" action="{{ route('register-business.store') }}">
                        @csrf
                        <div class="inputs-container register-input-container">
                            <x-form-input-field field="name" label="Name" type="text" placeholder="Enter your name" />
                            <x-form-input-field field="email" label="Email Address" type="email"
                                                placeholder="Enter your email" />
                            <x-form-input-field field="password" label="Password" type="password"
                                                placeholder="Enter a password" />
                            <x-form-input-field field="password_confirmation" label="Confirm Password" type="password"
                                                placeholder="Retype password" />
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
@endsection
