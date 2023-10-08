@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Influencer Categories</h3>
                    <div class="search-add">
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addInfluencerCategoryModal">Add
                                Category</a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th style="width: 55%;">Category Name</th>
                            <th style="width: 35%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($influencerCategories as $influencerCategory)
                            <tr>
                                <td>{{ $influencerCategory->id }}</td>
                                <td>{{ $influencerCategory->name }}</td>
                                <td class="action-btns">
                                    <button type="button" class="btn action-btn edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $influencerCategory->id }}">
                                        Edit
                                    </button>

                                    <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $influencerCategory->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal{{ $influencerCategory->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="editModalLabel{{ $influencerCategory->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $influencerCategory->id }}">Edit
                                                Influencer Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post"
                                                action="{{ route('influencerCategories.update', $influencerCategory->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $influencerCategory->name }}">
                                                </div>
                                                <div class="modal-button">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal{{ $influencerCategory->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="deleteModalLabel{{ $influencerCategory->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title custom-title"
                                                id="deleteModalLabel{{ $influencerCategory->id }}">
                                                Delete Influencer Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                Are you sure you want to delete this influencer category?
                                            </div>
                                            <div class="modal-button">
                                                <form
                                                    action="{{ route('influencerCategories.destroy', $influencerCategory->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn delete-btn">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm">
                <div class="users-header">
                    <h3>Business Categories</h3>
                    <div class="search-add">
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addBusinessCategoryModal">Add
                                Category</a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th style="width: 55%;">Category Name</th>
                            <th style="width: 35%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($businessCategories as $businessCategory)
                            <tr>
                                <td>{{ $businessCategory->id }}</td>
                                <td>{{ $businessCategory->name }}</td>
                                <td class="action-btns">
                                    <a href="" class="btn action-btn edit-btn">Edit</a>
                                    <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#suspendModal{{ $businessCategory->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="suspendModal{{ $businessCategory->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="suspendModalLabel{{ $businessCategory->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title custom-title"
                                                id="suspendModalLabel{{ $businessCategory->id }}">
                                                Delete Business Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                Are you sure you want to delete this business category?
                                            </div>
                                            <div class="modal-button">
                                                <form
                                                    action="{{ route('businessCategories.destroy', $businessCategory->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn delete-btn">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addInfluencerCategoryModal" tabindex="-1"
        aria-labelledby="addInfluencerCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addInfluencerCategoryModalLabel">Add Influencer Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('influencerCategories.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row edit-form">
                            <div class="col input-item">
                                <label for="name">Influencer Category Name</label>
                                <input type="text" id="name" name="name" class="form-control">
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
    <div class="modal fade" id="addBusinessCategoryModal" tabindex="-1" aria-labelledby="addBusinessCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addBusinessCategoryModalLabel">Add Business Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('businessCategories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row edit-form">
                            <div class="col input-item">
                                <label for="name">Business Category Name</label>
                                <input type="text" id="name" name="name" class="form-control">
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
