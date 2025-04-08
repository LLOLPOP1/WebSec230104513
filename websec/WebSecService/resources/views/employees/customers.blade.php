@extends('layouts.master')
@section('title', 'Customer List')
@section('content')
<div class="container">
    <h1>Customer List</h1>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Credit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>${{ number_format($customer->credit, 2) }}</td>
                <td>
                    <form action="{{ route('employees.add_credit', $customer) }}" method="POST" class="d-flex">
                        @csrf
                        <input type="number" name="amount" step="0.01" min="0.01" class="form-control me-2" placeholder="Add Credit" required>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 