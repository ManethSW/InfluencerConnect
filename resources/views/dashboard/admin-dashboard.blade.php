@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}!</p>
    <p><a href="{{ route('users.index') }}">View Users</a></p>
@endsection
