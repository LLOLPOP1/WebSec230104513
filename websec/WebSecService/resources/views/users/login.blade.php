@extends('layouts.master')
@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
  <div class="card shadow-lg border-0 rounded-4 p-4" style="width: 100%; max-width: 450px;">
    <div class="card-body">
      <h3 class="text-center mb-4 text-primary">Welcome Back</h3>
      <p class="text-center text-muted mb-4">Please login to your account</p>

      @if ($errors->any())
        <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input:
          <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('do_login') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input 
            type="email" 
            class="form-control" 
            id="email" 
            name="email" 
            placeholder="Enter your email" 
            required>
        </div>

        <div class="form-group mb-4">
          <label for="password" class="form-label">Password</label>
          <input 
            type="password" 
            class="form-control" 
            id="password" 
            name="password" 
            placeholder="Enter your password" 
            required>
        </div>

        <div class="d-grid mb-2">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
