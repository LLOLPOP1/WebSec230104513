@extends('layouts.master')
@section('title', 'Purchase History')
@section('content')

<div class="container py-4">
    <div class="row mb-4">
        <div class="col text-center">
            <h2><i class="bi bi-clock-history me-2"></i>Purchase History</h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col text-end">
                    <h5>
                        <i class="bi bi-wallet2 me-1"></i>
                        Current Credit Balance: 
                        <span class="text-success">${{ number_format(auth()->user()->credit, 2) }}</span>
                    </h5>
                </div>
            </div>

            @if($purchases->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    You have not made any purchases yet.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col"><i class="bi bi-calendar-date"></i> Date</th>
                                <th scope="col"><i class="bi bi-box-seam"></i> Product</th>
                                <th scope="col"><i class="bi bi-currency-dollar"></i> Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $purchase->product->name }}</td>
                                    <td>${{ number_format($purchase->product->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('products_list') }}" class="btn btn-outline-primary px-4">
                    <i class="bi bi-arrow-left-circle me-1"></i>Back to Products
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush
