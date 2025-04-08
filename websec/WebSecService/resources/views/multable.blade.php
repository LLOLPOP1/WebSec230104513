@extends('layouts.master')

@section('title', 'Multiplication Table')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Multiplication Table</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach (range(1, 12) as $j)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card border-primary shadow-sm">
                                <div class="card-header bg-primary text-white text-center">
                                    <strong>{{ $j }} Multiplication Table</strong>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Expression</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (range(1, 10) as $i)
                                                <tr>
                                                    <td>{{ $i }} × {{ $j }}</td>
                                                    <td><strong>{{ $i * $j }}</strong></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection