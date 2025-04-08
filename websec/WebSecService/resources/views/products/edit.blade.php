@extends('layouts.master')
@section('title', 'Edit Product')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">{{ $product->id ? '✏️ Edit' : '➕ Add' }} Product</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Error!</strong> Please check the form for errors.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if($product->photo)
                    <div class="col-12 text-center my-3">
                        <img id="product-preview" src="{{ asset('images/' . $product->photo) }}" class="img-thumbnail" style="max-height: 200px;" alt="Product Photo">
                    </div>
                    @endif

                    <form action="{{route('products_save', $product->id)}}" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="code" class="form-label">Product Code</label>
                                <input type="text" class="form-control" id="code" name="code" required value="{{$product->code}}" placeholder="Enter product code">
                                @error('code')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" required value="{{$product->model}}" placeholder="Enter model number">
                                @error('model')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{$product->name}}" placeholder="Enter product name">
                                @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" required value="{{$product->price}}" placeholder="0.00">
                                </div>
                                @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock Quantity</label>
                                <input type="number" min="0" class="form-control" id="stock" name="stock" required value="{{$product->stock}}" placeholder="Enter stock quantity">
                                @error('stock')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="photo" class="form-label">Product Photo URL</label>
                                <input type="text" class="form-control" id="photo" name="photo" required value="{{$product->photo}}" placeholder="Enter photo URL">
                                @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required rows="4" placeholder="Enter product description">{{$product->description}}</textarea>
                                @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('products_list') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Products
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Save Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .card {
        border-radius: 0.75rem;
    }
    .card-header {
        border-radius: 0.75rem 0.75rem 0 0 !important;
        font-size: 1.25rem;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
    .btn-primary, .btn-outline-secondary {
        padding: 0.5rem 1.75rem;
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })();

    // Live preview for product image
    document.getElementById('photo').addEventListener('input', function () {
        const url = this.value;
        const preview = document.getElementById('product-preview');
        if (url) {
            preview.src = url;
        }
    });
</script>
@endpush

@endsection
