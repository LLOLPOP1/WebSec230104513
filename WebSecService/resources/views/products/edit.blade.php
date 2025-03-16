@extends('layouts.master')

@section('title', ($products->id ? 'Edit' : 'Add') . ' Product')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center fw-bold">
                    {{ $products->id ? 'Edit' : 'Add' }} Product
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.save', $products->id ?? '') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">Code:</label>
                            <input type="text" id="code" class="form-control" placeholder="Enter product code" name="code" required value="{{ old('code', $products->code) }}">
                        </div>

                        <div class="mb-3">
                            <label for="model" class="form-label">Model:</label>
                            <input type="text" id="model" class="form-control" placeholder="Enter model" name="model" required value="{{ old('model', $products->model) }}">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter product name" name="name" required value="{{ old('name', $products->name) }}">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($):</label>
                            <input type="number" id="price" class="form-control" placeholder="Enter price" name="price" required value="{{ old('price', $products->price) }}" step="0.01" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo URL:</label>
                            <input type="url" id="photo" class="form-control" placeholder="Enter photo URL" name="photo" required value="{{ old('photo', $products->photo) }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea id="description" class="form-control" placeholder="Enter product description" name="description" required rows="3">{{ old('description', $products->description) }}</textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100">
                                {{ $products->id ? 'Update' : 'Add' }} Product
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
