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
                                } elseif ($time >= "12" && $time < "17") {
                                    echo "Good Afternoon";
                                } else {
                                    echo "Good Evening";
                                }
                            @endphp
                        </h2>
                        <h3>Login to your account</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="inputs-container">
                            <x-form-input-field field="email" label="Email Address" type="email"
                                                placeholder="Enter your email"/>
                            <x-form-input-field field="password" label="Password" type="password"
                                                placeholder="Enter a password"/>
                        </div>
                        <div class="login-footer">
                            <div class="form-check btn-remember">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label label-remember" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="password-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <button type="submit" class="auth-button">
                            {{ __('Login') }}
                        </button>
                    </form>
                    <div class="other-action">
                        <h3>
                            Not registered yet?
                            <a href="{{ route('register') }}">
                                Create an account
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
