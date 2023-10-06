@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header card-edit-header-user">
                    <h3>Edit {{ $user->name }}'s Profile</h3>
                    <h3>Influencer</h3>
                </div>
                <div class="card-edit-body card-edit-body-user">
                    <div class="edit-fields">
                        <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-row edit-form">
                                <div class="col input-item">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" id="avatar" name="avatar" class="form-control">
                                </div>
                                <div class="col input-item">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="col input-item">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="col input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        value="{{ $user->phone }}">
                                </div>
                                <div class="col input-item">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" class="form-control"
                                        value="{{ $user->dob }}">
                                </div>
                                <div class="col input-item">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        value="{{ $user->address }}">
                                </div>
                                <div class="edit-buttons">
                                    <button type="button">
                                        <a href="{{ route('users.index') }}">Go Back</a>
                                    </button>
                                    <button type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
