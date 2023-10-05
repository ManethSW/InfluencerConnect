@extends('layouts.dashboard')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" value="{{ $user->phone }}">
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" value="{{ $user->dob }}">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="{{ $user->address }}">
        <label for="role_id">User Role</label>
        <input type="text" id="role_id" name="role_id" value="{{ $user->role_id }}">
        <button type="submit">Update</button>
    </form>
@endsection
