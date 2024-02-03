@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Users</h3>
                    <div class="search-add">
                        <form method="get" action="{{ route('users.index') }}" class="">
                            <div class="search">
                                <input id="search-input" type="search" name="search" class="form-control" placeholder="Search users by name" />
                                <button type="submit">
                                    <img id="search-icon" src="/icons/search.svg" alt="search">
                                </button>
                            </div>
                        </form>
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addInfluencerModal">Add
                                Influencer</a>
                        </div>
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addIndividualModal">Add
                                Individual</a>
                        </div>
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addBusinessModal">Add
                                Business</a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-column-id">ID</th>
                            <th class="table-column-name">Name</th>
                            <th class="table-column-email">Email</th>
                            <th class="table-column-status">Status</th>
                            <th class="table-column-role">Role</th>
                            <th class="table-column-actions">Actions</th>
                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->status == 1)
                                        <div class="status">
                                            <div class="status-badge active"></div>
                                            <p>Active</p>
                                        </div>
                                    @else
                                        <div class="status">
                                            <div class="status-badge inactive"></div>
                                            <p>Inactive</p>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $user->role_id->name }}</td>
                                <td class="action-btns">
                                    @if ($user->role_id->value != 1)
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn action-btn edit-btn">Edit</a>
                                        @if ($user->status)
                                            <button type="button" class="btn action-btn suspend-btn" data-bs-toggle="modal"
                                                data-bs-target="#suspendModal{{ $user->id }}">
                                                Suspend
                                            </button>
                                        @else
                                            <a href="{{ route('users.activate', $user->id) }}"
                                                class="btn action-btn activate-btn">Activate</a>
                                        @endif
                                        <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $user->id }}">
                                            Delete
                                        </button>
                                    @else
                                        No Actions Allowed
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="suspendModal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="suspendModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="suspendModalLabel{{ $user->id }}">
                                                Suspend User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                Are you sure you want to suspend this user?
                                            </div>
                                            <div class="modal-button">
                                                <a href="{{ route('users.suspend', $user->id) }}"
                                                    class="btn suspend-btn">Suspend User</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title custom-title" id="deleteModalLabel{{ $user->id }}">
                                                Delete User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                Are you sure you want to delete this user?
                                            </div>
                                            <div class="modal-button">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
    <div class="modal fade" id="addInfluencerModal" tabindex="-1" aria-labelledby="addInfluencerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInfluencerModalLabel">Add Influencer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-row edit-form modal-form">
                            <input type="hidden" name="role_id" value="{{ App\Enums\UserRole::Influencer }}">
                            <div class="col input-item">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
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
    <div class="modal fade" id="addIndividualModal" tabindex="-1" aria-labelledby="addIndividualModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIndividualModalLabel">Add Individual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-row edit-form modal-form">
                            <input type="hidden" name="role_id" value="{{ App\Enums\UserRole::Individual }}">
                            <div class="col input-item">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
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
    <div class="modal fade" id="addBusinessModal" tabindex="-1" aria-labelledby="addBusinessModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBusinessModalLabel">Add Business</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-row edit-form modal-form">
                            <input type="hidden" name="role_id" value="{{ App\Enums\UserRole::Business }}">
                            <div class="col input-item">
                                <label for="name">Business Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="email">Business Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="col input-item">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
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
