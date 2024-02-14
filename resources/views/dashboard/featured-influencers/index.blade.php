@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Featured Influencers</h3>
                    <div class="search-add">
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addFeaturedInfluencer">Add Featured</a>

                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 15%;">User Name</th>
                        <th style="width: 15%;">Influencer Category</th>
                        <th style="width: 15%;">Visibility</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($featuredInfluencers as $featuredInfluencer)
                        <tr>
                            <td>{{ $featuredInfluencer->id }}</td>
                            <td>{{ $featuredInfluencer->user ? $featuredInfluencer->user->name : 'N/A' }}</td>
                            <td>{{ $featuredInfluencer->influencerCategory->name }}</td>
                            <td>
                                @if ($featuredInfluencer->status == 1)
                                    <div class="status green">
                                        <div class="status-badge"></div>
                                        <p>Enabled</p>
                                    </div>
                                @else
                                    <div class="status red">
                                        <div class="status-badge"></div>
                                        <p>Disabled</p>
                                    </div>
                                @endif
                            </td>
                            <td class="action-btns">
                                <form method="POST"
                                      action="{{ route('featuredInfluencers.status.update', $featuredInfluencer->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status"
                                           value="{{ $featuredInfluencer->status == 1 ? 0 : 1 }}">
                                    <button type="submit"
                                            class="btn action-btn {{ $featuredInfluencer->status == 1 ? 'suspend-btn' : 'activate-btn' }}">
                                        @if($featuredInfluencer->status)
                                            <i class="fa-solid fa-xmark"></i>
                                            Suspend
                                        @else
                                            <i class="fa-solid fa-check"></i>
                                            Activate
                                        @endif
                                    </button>
                                </form>
                                <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $featuredInfluencer->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="addFeaturedInfluencer" tabindex="-1"
             aria-labelledby="addFeaturedInfluencerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addInfluencerCategoryModalLabel">Add Influencer Category</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('featuredInfluencers.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-row edit-form">
                                <div class="form-group">
                                    <label for="influencer_id">Influencer User</label>
                                    <select class="form-control" id="influencer_id" name="influencer_id">
                                        @foreach($influencers as $influencer)
                                            <option value="{{ $influencer->id }}">{{ $influencer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="influencer_category_id">Influencer Category</label>
                                    <select class="form-control" id="influencer_category_id"
                                            name="influencer_category_id">
                                        @foreach($influencerCategories as $influencerCategory)
                                            <option
                                                value="{{ $influencerCategory->id }}">{{ $influencerCategory->name }}</option>
                                        @endforeach
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
    </div>
@endsection
