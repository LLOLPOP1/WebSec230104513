@extends('layouts.app')

@section('title', 'Users List')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Users List</h2>

    <form method="GET" action="{{ route('users.index') }}" class="flex mb-4">
        <input type="text" name="search" placeholder="Search users..."
            value="{{ request('search') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">
            Search
        </button>
    </form>

    <a href="{{ route('users.create') }}"
       class="inline-block mb-4 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
        Create New User
    </a>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('users.edit', $user) }}"
                           class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>

                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
