@extends('layouts.dashboard')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('users.index') }}>CRUD Users</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('users.create') }}>Add User</a>
                </div>
            </div>
    </nav>
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Role</label>
        <input type="text" id="name" name="name">
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="email">Phone Number</label>
        <input type="phone" id="phone" name="phone">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <button type="submit">Create</button>
    </form>
@endsection
