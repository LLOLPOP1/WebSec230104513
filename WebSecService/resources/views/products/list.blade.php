@extends('layouts.master')

@section('title', 'Products')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('products.edit') }}" class="btn btn-success">Add Product</a>
    </div>

    <form class="mb-4">
        <div class="row g-2">
            <div class="col-md-2">
                <input name="keywords" type="text" class="form-control" placeholder="Search Keywords"
                    value="{{ request()->keywords }}" />
            </div>
            <div class="col-md-2">
                <input name="min_price" type="number" class="form-control" placeholder="Min Price"
                    value="{{ request()->min_price }}" />
            </div>
            <div class="col-md-2">
                <input name="max_price" type="number" class="form-control" placeholder="Max Price"
                    value="{{ request()->max_price }}" />
            </div>
            <div class="col-md-2">
                <select name="order_by" class="form-select">
                    <option value="" disabled {{ request()->order_by ? '' : 'selected' }}>Order By</option>
                    <option value="name" {{ request()->order_by == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request()->order_by == 'price' ? 'selected' : '' }}>Price</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="order_direction" class="form-select">
                    <option value="" disabled {{ request()->order_direction ? '' : 'selected' }}>Order Direction</option>
                    <option value="ASC" {{ request()->order_direction == 'ASC' ? 'selected' : '' }}>ASC</option>
                    <option value="DESC" {{ request()->order_direction == 'DESC' ? 'selected' : '' }}>DESC</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('products.index') }}" class="btn btn-danger w-100">Reset</a>
            </div>
        </div>
    </form>

    @forelse ($products as $product)
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset("images/products/$product->photo") }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">{{ $product->name }}</h5>
                            <div class="d-flex">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success me-2">Edit</a>
                                <form action="{{ route('products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th width="20%">Model</th>
                                <td>{{ $product->model }}</td>
                            </tr>
                            <tr>
                                <th>Code</th>
                                <td>{{ $product->code }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $product->price }} LE</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">No products found.</div>
    @endforelse
</div>
@endsection
