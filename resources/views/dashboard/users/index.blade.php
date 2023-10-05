@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Users</h3>
                    <div class="search-add">
                        <form method="get" action="{{ route('users.index') }}" class="">
                            <div class="input-group search">
                                <input type="search" name="search" class="form-control" placeholder="Search users by name">
                                <div class="input-group-append">
                                    <button type="submit" class="btn">Search</button>
                                </div>
                            </div>
                        </form>
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">Add
                                User</a>

                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 22.5%;">Email</th>
                            {{-- <th style="width: 15%;">Phone</th> --}}
                            <th style="width: 10%;">Status</th>
                            <th style="width: 17.5%;">Role</th>
                            <th style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- <td>{{ $user->phone }}</td> --}}
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
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn action-btn delete-btn">Delete</button>
                                        </form>
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
                                            Are you sure you want to suspend this user?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <a href="{{ route('users.suspend', $user->id) }}"
                                                class="btn btn-warning">Suspend User</a>
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
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="role_id">Role</label>
                                <select id="role_id" name="role_id" class="form-control">
                                    @foreach ([App\Enums\UserRole::Influencer, App\Enums\UserRole::business] as $role)
                                        <option value="{{ $role->value }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="phone">Phone Number</label>
                                <input type="phone" id="phone" name="phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
