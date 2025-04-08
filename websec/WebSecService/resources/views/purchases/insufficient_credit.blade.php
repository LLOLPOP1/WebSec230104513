@extends('layouts.master')
@section('title', 'Insufficient Credit')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white text-center">
                    <h4 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Insufficient Credit</h4>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert">
                        <i class="bi bi-x-circle-fill me-2 fs-4"></i>
                        <div>
                            <p class="mb-1">You don't have enough credit to complete this purchase.</p>
                            <p class="fw-bold mb-0">Your current credit balance: ${{ number_format(auth()->user()->credit, 2) }}</p>
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-center gap-3">
                        <a href="{{ route('products_list') }}" class="btn btn-outline-primary">
                            <i class="bi bi-box-seam me-1"></i> Back to Products
                        </a>
                        <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-person-circle me-1"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .card {
        border-radius: 0.75rem;
    }
    .btn {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
</style>
@endpush
