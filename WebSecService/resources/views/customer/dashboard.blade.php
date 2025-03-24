@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Welcome, {{ auth()->user()->name }}!</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="font-semibold text-lg mb-2">Available Credit</h3>
            <p class="text-3xl font-bold text-blue-600">{{ number_format($stats['available_credit'], 2) }}</p>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg">
            <h3 class="font-semibold text-lg mb-2">Total Purchases</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['total_purchases'] }}</p>
        </div>
        
        <div class="bg-purple-50 p-4 rounded-lg">
            <h3 class="font-semibold text-lg mb-2">Total Spent</h3>
            <p class="text-3xl font-bold text-purple-600">{{ number_format($stats['total_spent'], 2) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
            <div class="space-y-2">
                <a href="{{ route('customer.products.browse') }}" 
                   class="block w-full p-3 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Browse Products
                </a>
                <a href="{{ route('customer.purchases.index') }}" 
                   class="block w-full p-3 bg-green-500 text-white rounded hover:bg-green-600">
                    View Purchase History
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 