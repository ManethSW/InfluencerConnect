@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-register">
                <div class="card-header form-header-register">
                    <p>{{ __('Select User Type') }} </p>
                </div>
                <div class="divider"></div>
                <form method="POST" action="{{ route('user-type.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <select name="user_type" id="user_type" required>
                            <option value="influencer">Influencer</option>
                            <option value="business">Business</option>
                        </select>
                    </div>
                    <div class="divider"></div>
                    <button type="submit" class="btn">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
