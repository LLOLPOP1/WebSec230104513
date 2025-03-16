@extends('layouts.app')

@section('title', 'Create New User')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Create New User</h2>

    {{-- ✅ عرض رسالة نجاح عند إضافة المستخدم --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ نموذج إنشاء المستخدم --}}
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        {{-- 🔹 حقل الاسم --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Name:</label>
            <input type="text" name="name" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required>
        </div>

        {{-- 🔹 حقل البريد الإلكتروني --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Email:</label>
            <input type="email" name="email" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required>
        </div>

        {{-- 🔹 حقل كلمة المرور --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Password:</label>
            <input type="password" name="password" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required>
        </div>

        {{-- 🔹 زر إنشاء المستخدم --}}
        <button type="submit" 
            class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
            Create User
        </button>
    </form>
</div>
@endsection
