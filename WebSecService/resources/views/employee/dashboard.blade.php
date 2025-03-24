@extends('layouts.app')

@section('title', 'Employee Dashboard')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Welcome, {{ auth()->user()->name }}!</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="font-semibold text-lg mb-2">Products Managed</h3>
            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Product::count() }}</p>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg">
            <h3 class="font-semibold text-lg mb-2">Low Stock Products</h3>
            <p class="text-3xl font-bold text-green-600">
                {{ \App\Models\Product::where('stock', '<', 10)->count() }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
            <div class="space-y-2">
                <a href="{{ route('employee.products.index') }}" 
                   class="block w-full p-3 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Manage Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 