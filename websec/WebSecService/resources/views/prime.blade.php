@extends('layouts.master')

@section('title', 'Prime Numbers')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Prime Numbers</h3>
            </div>
            <div class="card-body text-center">
                @foreach (range(1, 100) as $i)
                    @if (isPrime($i))
                        <span class="badge bg-primary m-1 p-2">{{ $i }}</span>
                    @else
                        <span class="badge bg-secondary m-1 p-2">{{ $i }}</span>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection