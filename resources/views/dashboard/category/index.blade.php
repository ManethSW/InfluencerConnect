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
                        <th style="width: 25%;">Category Name</th>
                        <th style="width: 20%;">status</th>
                        <th style="width: 35%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($influencerCategories as $influencerCategory)
                        <tr>
                            <td>{{ $influencerCategory->id }}</td>
                            <td>{{ $influencerCategory->name }}</td>
                            <td>
                                @if ($influencerCategory->status == 1)
                                    <div class="status green">
                                        <div class="status-badge"></div>
                                        <p>Active</p>
                                    </div>
                                @else
                                    <div class="status red">
                                        <div class="status-badge"></div>
                                        <p>Inactive</p>
                                    </div>
                                @endif
                            </td>
                            <td class="action-btns">
                                <button type="button" class="btn action-btn edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModalInfluencer{{ $influencerCategory->id }}">
                                    Edit
                                </button>
                                <form method="POST"
                                      action="{{ route('influencer-category.status.update', $influencerCategory->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status"
                                           value="{{ $influencerCategory->status == 1 ? 0 : 1 }}">
                                    <button type="submit"
                                            class="btn action-btn {{ $influencerCategory->status == 1 ? 'suspend-btn' : 'activate-btn' }}">
                                        {{ $influencerCategory->status == 1 ? 'Suspend' : 'Activate' }}
                                    </button>
                                </form>
                                <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $influencerCategory->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModalInfluencer{{ $influencerCategory->id }}" tabindex="-1"
                             role="dialog" aria-labelledby="editModalInfluencerLabel{{ $influencerCategory->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="editModalInfluencerLabel{{ $influencerCategory->id }}">Edit
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
                        <th style="width: 25%;">Category Name</th>
                        <th style="width: 20%;">status</th>
                        <th style="width: 35%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($businessCategories as $businessCategory)
                        <tr>
                            <td>{{ $businessCategory->id }}</td>
                            <td>{{ $businessCategory->name }}</td>
                            <td>
                                @if ($businessCategory->status == 1)
                                    <div class="status green">
                                        <div class="status-badge"></div>
                                        <p>Active</p>
                                    </div>
                                @else
                                    <div class="status red">
                                        <div class="status-badge"></div>
                                        <p>Inactive</p>
                                    </div>
                                @endif
                            </td>
                            <td class="action-btns">
                                <button type="button" class="btn action-btn edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModalBusiness{{ $businessCategory->id }}">
                                    Edit
                                </button>
                                <form method="POST"
                                      action="{{ route('business-category.status.update', $businessCategory->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status"
                                           value="{{ $businessCategory->status == 1 ? 0 : 1 }}">
                                    <button type="submit"
                                            class="btn action-btn {{ $businessCategory->status == 1 ? 'suspend-btn' : 'activate-btn' }}">
                                        {{ $businessCategory->status == 1 ? 'Suspend' : 'Activate' }}
                                    </button>
                                </form>
                                <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#suspendModal{{ $businessCategory->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModalBusiness{{ $businessCategory->id }}" tabindex="-1"
                             role="dialog" aria-labelledby="editModalBusinessLabel{{ $businessCategory->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalBusinessLabel{{ $businessCategory->id }}">
                                            Edit
                                            Business Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post"
                                              action="{{ route('businessCategories.update', $businessCategory->id) }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{ $businessCategory->name }}">
                                            </div>
                                            <div class="modal-button">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
