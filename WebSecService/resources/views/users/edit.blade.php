@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>
        <label>Password (optional):</label>
        <input type="password" name="password">
        <button type="submit">Update</button>
    </form>
</div>
@endsection
