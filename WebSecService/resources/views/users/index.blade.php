@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Users List</h2>

    <form method="GET" action="{{ route('users.index') }}">
        <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('users.create') }}">Create New User</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.edit', $user) }}">Edit</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $users->links() }}
</div>
@endsection
