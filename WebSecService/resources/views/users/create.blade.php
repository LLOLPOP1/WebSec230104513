@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Create</button>
    </form>
</div>
@endsection
