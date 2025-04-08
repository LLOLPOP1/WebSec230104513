@extends('layouts.master')
@section('title', 'Add New Employee')
@section('content')
<div class="d-flex justify-content-center">
    <div class="row m-4 col-sm-8 col-md-6 col-lg-4">
        <h2 class="text-center mb-4">Add New Employee</h2>
        <form action="{{ route('store_employee') }}" method="post">
            {{ csrf_field() }}
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong> Please fix the following issues:
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" placeholder="Enter employee name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" placeholder="Enter employee email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" name="password" required>
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary w-100">Create Employee</button>
            </div>
        </form>
    </div>
</div>
@endsection
