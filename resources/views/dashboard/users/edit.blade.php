@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <button type="submit">Update</button>
    </form>
@endsection
