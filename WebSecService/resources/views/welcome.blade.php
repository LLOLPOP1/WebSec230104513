@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h1 class="text-center">Welcome to WebSec</h1>
    <div class="container m-3">
        <div class="card shadow-lg text-center p-4">
            <button type="button" class="btn btn-primary" onclick="doSomething()">Press Me</button>
        </div>
    </div>
    <script>    
        function doSomething() {
            alert('Hello From JavaScript');
        }
    </script>
@endsection
