@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Influencer Cards</h3>
                    <div class="search-add">
                        <form method="get" action="{{ route('influencerCards.index') }}" class="">
                            <div class="input-group search">
                                <input type="search" name="search" class="form-control"
                                    placeholder="Search cards by influencer names" style="width: 275px">
                                <div class="input-group-append">
                                    <button type="submit" class="btn">Search</button>
                                </div>
                            </div>
                        </form>
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addInfluencerCardModal">Add
                                Card</a>

                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 5%;">Avatar</th>
                            <th style="width: 15%;">User Name</th>
                            <th style="width: 15%;">Influencer Category</th>
                            <th style="width: 7.5%;">Rating</th>
                            <th style="width: 22.5%;">Description</th>
                            <th style="width: 10%;">Visible</th>
                            <th style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($influencerCards as $influencerCard)
                            <tr>
                                <td>{{ $influencerCard->id }}</td>
                                <td><img src="storage/{{ $influencerCard->avatar }}" alt="avatar" width="50px"></td>
                                <td>{{ $influencerCard->user->name }}</td>
                                <td>{{ $influencerCard->influencerCategory->name }}</td>
                                <td>{{ $influencerCard->rating }}</td>
                                <td>{{ $influencerCard->description }}</td>
                                <td>
                                    @if ($influencerCard->visible == 1)
                                        <div class="status">
                                            <div class="status-badge active"></div>
                                            <p>Visible</p>
                                        </div>
                                    @else
                                        <div class="status">
                                            <div class="status-badge inactive"></div>
                                            <p>Invisible</p>
                                        </div>
                                    @endif
                                </td>
                                <td class="action-btns">
                                    <a href="{{ route('influencerCards.edit', $influencerCard->id) }}"
                                        class="btn action-btn edit-btn">Edit</a>
                                    @if ($influencerCard->visible)
                                        <button type="button" class="btn action-btn suspend-btn" data-bs-toggle="modal"
                                            data-bs-target="#suspendModal{{ $influencerCard->id }}">
                                            Invisible
                                        </button>
                                    @else
                                        <a href="{{ route('influencerCards.activate', $influencerCard->id) }}"
                                            class="btn action-btn activate-btn">Visible</a>
                                    @endif
                                    {{-- <form action="{{ route('influencerCards.destroy', $influencerCard->id) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn action-btn delete-btn">Delete</button>
                                    </form> --}}
                                    <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $influencerCard->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteModal{{ $influencerCard->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="deleteModalLabel{{ $influencerCard->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title custom-title"
                                                id="deleteModalLabel{{ $influencerCard->id }}">
                                                Delete Influencer Card</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                Are you sure you want to delete this card?
                                            </div>
                                            <div class="modal-button">
                                                <form
                                                    action="{{ route('influencerCards.destroy', $influencerCard->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn delete-btn">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal fade" id="suspendModal{{ $influencerCard->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="suspendModalLabel{{ $influencerCard->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title custom-title"
                                                id="suspendModalLabel{{ $influencerCard->id }}">
                                                Suspend User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to set this card to invisible?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('influencerCards.suspend', $influencerCard->id) }}"
                                                class="btn suspend-btn">Set To Invisible</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="modal fade" id="addInfluencerCardModal" tabindex="-1" aria-labelledby="addInfluencerCardModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addInfluencerCardModalLabel">Add Influencer Card</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('influencerCards.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row edit-form">
                            <div class="col input-item">
                                <label for="avatar">Avatar</label>
                                <input type="file" id="avatar" name="avatar" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="user_id">User</label>
                                <select id="user_id" name="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        @if ($user->role_id->value != 1 && $user->influencerCard()->doesntExist())
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col input-item">
                                <label for="influencer_category_id">Influencer Category</label>
                                <select id="influencer_category_id" name="influencer_category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col input-item">
                                <label for="rating">Rating</label>
                                <input type="number" id="rating" name="rating" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>
                            <div class="col input-item">
                                <label for="visible">Visible</label>
                                <select id="visible" name="visible" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-button">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
