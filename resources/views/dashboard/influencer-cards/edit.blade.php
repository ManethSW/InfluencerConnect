@extends('layouts.dashboard')

@php
    $usersWithoutCard = $users->filter(function ($user) {
        return $user->role_id->value != 1 && $user->influencerCard()->doesntExist();
    });
@endphp

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Edit {{ $influencerCard->user->name }}'s Card</h3>
                </div>
                <div class="card-edit-body">
                    <div class="preview-card">
                        <h4>Preview</h4>
                        <div class="influencer-card">
                            <x-influencer-card image="{{ asset('storage/' . $influencerCard->avatar) }}" alt="influencer"
                                name="{{ $influencerCard->user->name }}"
                                category="{{ $influencerCard->influencerCategory->name }}"
                                rating="{{ $influencerCard->rating }}" description="{{ $influencerCard->description }}" />
                        </div>
                    </div>
                    <div class="edit-fields">
                        <h4>Edit</h4>
                        <form method="post" action="{{ route('influencerCards.update', $influencerCard->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-row edit-form">
                                <div class="col input-item">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" id="avatar" name="avatar" class="form-control">
                                </div>
                                <div class="col input-item">
                                    <label for="user_id">User</label>
                                    <select id="user_id" name="user_id" class="form-control">
                                        @foreach ($usersWithoutCard as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $influencerCard->user_id ? 'selected' : '' }}>
                                                {{ $user->name }}</option>
                                        @endforeach

                                        @if ($usersWithoutCard->isEmpty())
                                            <p>No influencers to choose from</p>
                                        @endif
                                    </select>
                                </div>
                                <div class="col input-item">
                                    <label for="influencer_category_id">Influencer Category</label>
                                    <select id="influencer_category_id" name="influencer_category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $influencerCard->influencer_category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col input-item">
                                    <label for="rating">Rating</label>
                                    <input type="number" id="rating" name="rating" class="form-control"
                                        value="{{ $influencerCard->rating }}">
                                </div>
                                <div class="col input-item">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control">{{ $influencerCard->description }}</textarea>
                                </div>
                                <div class="edit-buttons">
                                    <button type="button">
                                        <a href="{{ route('influencerCards.index') }}">Go Back</a>
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
