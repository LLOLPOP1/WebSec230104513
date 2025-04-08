@extends('layouts.master')
@section('title', 'Product Store')

@section('content')
<div class="row mt-4 mb-3 align-items-center">
    <div class="col-md-10">
        <h2 class="fw-bold">🛒 Product Store</h2>
    </div>
    <div class="col-md-2 text-end">
        @can('add_products')
        <a href="{{ route('products_edit') }}" class="btn btn-success w-100">➕ Add Product</a>
        @endcan
    </div>
</div>

<form class="mb-4">
    <div class="row g-2">
        <div class="col-md-2">
            <input name="keywords" type="text" class="form-control" placeholder="🔍 Search" value="{{ request()->keywords }}">
        </div>
        <div class="col-md-2">
            <input name="min_price" type="number" class="form-control" placeholder="Min Price" value="{{ request()->min_price }}">
        </div>
        <div class="col-md-2">
            <input name="max_price" type="number" class="form-control" placeholder="Max Price" value="{{ request()->max_price }}">
        </div>
        <div class="col-md-2">
            <select name="order_by" class="form-select">
                <option value="" disabled {{ request()->order_by=="" ? 'selected' : '' }}>Order By</option>
                <option value="name" {{ request()->order_by=="name" ? 'selected' : '' }}>Name</option>
                <option value="price" {{ request()->order_by=="price" ? 'selected' : '' }}>Price</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="order_direction" class="form-select">
                <option value="" disabled {{ request()->order_direction=="" ? 'selected' : '' }}>Direction</option>
                <option value="ASC" {{ request()->order_direction=="ASC" ? 'selected' : '' }}>ASC</option>
                <option value="DESC" {{ request()->order_direction=="DESC" ? 'selected' : '' }}>DESC</option>
            </select>
        </div>
        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
        <div class="col-md-1 d-grid">
            <a href="{{ route('products_list') }}" class="btn btn-outline-danger">Reset</a>
        </div>
    </div>
</form>

@foreach($products as $product)
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-light">
        <h4 class="mb-0">{{ $product->name }}</h4>
    </div>
    <div class="card-body row">
        <div class="col-md-4 text-center">
            <img src="{{ asset("images/$product->photo") }}" class="img-fluid rounded" alt="{{ $product->name }}">
        </div>
        <div class="col-md-8">
            <table class="table table-bordered mb-3">
                <tr><th>Name</th><td>{{ $product->name }}</td></tr>
                <tr><th>Model</th><td>{{ $product->model }}</td></tr>
                <tr><th>Code</th><td>{{ $product->code }}</td></tr>
                <tr><th>Price</th><td>${{ number_format($product->price, 2) }}</td></tr>
                <tr><th>Stock</th><td>{{ $product->stock }}</td></tr>
                <tr><th>Description</th><td>{{ $product->description }}</td></tr>
            </table>
            <div class="d-flex gap-2">
                @auth
                    @if(auth()->user()->hasRole('Customer'))
                    <form action="{{ route('purchases.store') }}" method="POST" class="flex-grow-1">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary w-100" {{ $product->stock < 1 ? 'disabled' : '' }}>
                            🛍 Buy
                        </button>
                    </form>
                    @endif
                @endauth

                @can('edit_products')
                <a href="{{ route('products_edit', $product->id) }}" class="btn btn-success flex-grow-1">✏️ Edit</a>
                @endcan

                @can('delete_products')
                <a href="{{ route('products_delete', $product->id) }}" class="btn btn-danger flex-grow-1">🗑 Delete</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
