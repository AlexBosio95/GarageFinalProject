@extends('layouts.error')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center error-page">
            <div class="text-center">
                <h1 class="title">404</h1>
                <h1>Page not found</h1>
                <a href="{{ route('admin.garages.index') }}" class="btn btn-danger mt-2">Homepage</a> 
            </div>
        </div>
    </div>
@endsection
