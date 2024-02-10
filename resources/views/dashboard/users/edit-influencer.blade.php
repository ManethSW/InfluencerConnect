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
                                <div>
                                    <div class="col input-item">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" id="avatar" name="avatar" class="form-control">
                                    </div>
                                    <div class="col input-item">
                                        <label for="banner">Banner</label>
                                        <input type="file" id="banner" name="banner" class="form-control">
                                    </div>
                                </div>
                                <div class="col input-item">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="col input-item">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" name="description" class="form-control"
                                           value="{{ $user->description }}">
                                </div>
                                <div>
                                    <div class="col input-item">
                                        <label for="specialty">Specialty</label>
                                        <input type="text" id="specialty" name="specialty" class="form-control"
                                               value="{{ $user->specialty }}">
                                    </div>
                                    <div class="col input-item">
                                        <label for="gender">Gender</label>
                                        <input type="text" id="gender" name="gender" class="form-control"
                                               value="{{ $user->gender }}">
                                    </div>
                                </div>
                                <div>
                                    <div class="col input-item">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                               value="{{ $user->email }}">
                                    </div>
                                    <div class="col input-item">
                                        <label for="phone">Phone</label>
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                               value="{{ $user->phone }}">
                                    </div>
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
