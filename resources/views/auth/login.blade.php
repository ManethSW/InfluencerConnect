@extends('layouts.app')

@section('content')
    <div class="login-container container">
        <div class="row justify-content-center">
            <div class="form-login">
                <div class="card-header form-header-register">
                    <p>{{ __('Login') }} </p>
                    <p>Welcome Back!</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    <div class="divider"></div>
                    @csrf
                    <div class="inputs-login">
                        <x-form-input-field field="email" label="Email Address" type="email"
                            placeholder="Enter your email" />
                        <x-form-input-field field="password" label="Password" type="password"
                            placeholder="Enter a password" />
                    </div>
                    <div class="divider" id="divider-2"></div>
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
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </form>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
