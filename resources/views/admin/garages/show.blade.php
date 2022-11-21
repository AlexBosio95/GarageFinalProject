@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('admin.garages.index') }}" class="btn btn-primary mb-2">< back </a>
    
    <a href="{{ route('admin.', ['garage' => $garage]) }}" class="btn btn-primary mb-2">Show correlated messages</a>

    <div class="card mb-3">
        @if ($garage->image)
            <img src="{{ asset('storage/'. $garage->image) }}" class="card-img-top" alt="Image for {{$garage->title}}">
        @else
            <h4 class="card-title text-center mt-5">Image not available</h4>
        @endif

        <div class="card-body">
            <h5 class="card-title">
                <span class="text-primary">Title:</span>
                {{$garage->title}}
            </h5>

            <p class="card-text">
                <span class="text-primary">Address:</span>
                <span class="text-muted">{{$garage->address}}</span>
            </p>

            <p class="card-text">
                <span class="text-primary">Longitude:</span>
                <span class="text-muted">{{$garage->longitude}}</span>
            </p>

            <p class="card-text">
                <span class="text-primary">Latitude:</span>
                <span class="text-muted">{{$garage->latitude}}</span>
            </p>

            @if ($garage->sqmt > 1)
                <p class="card-text">
                    <span class="text-primary">Garage total area:</span>
                    {{$garage->sqmt}} m²
                </p>
            @else
                <p class="card-text">
                    <span class="text-primary">Garage total area:</span>
                    <span class="text-muted">Not available</span>
                </p>
            @endif

            @if ($garage->length > 1)
                <p class="card-text">
                    <span class="text-primary">Length:</span>
                    {{$garage->length}} mt
                </p>
            @else
                <p class="card-text">
                    <span class="text-primary">Length:</span>
                    <span class="text-muted">Not available</span>
                </p>
            @endif

            @if ($garage->width > 1)
                <p class="card-text">
                    <span class="text-primary">Width:</span>
                    {{$garage->width}} mt
                </p>
            @else
                <p class="card-text">
                    <span class="text-primary">Width:</span>
                    <span class="text-muted">Not available</span>
                </p>
            @endif
            @if ($garage->height > 1)
                <p class="card-text">
                    <span class="text-primary">Height:</span>
                    {{$garage->height}} mt
                </p>
            @else
                <p class="card-text">
                    <span class="text-primary">Height:</span>
                    <span class="text-muted">Not available</span>
                </p>
            @endif

            <p class="card-text">
                <span class="text-primary">N_Parking:</span>
                {{$garage->n_parking}}
            </p>

            @if (count($garage->services) > 0)
                <p class="card-text">
                    <span class="text-primary">Services:</span>
                    @foreach ($garage->services as $service)
                        <span class="text-success">
                            {{$service->name}} |
                        </span>
                    @endforeach
                </p>
            @else
                <p class="card-text">
                    <span class="text-primary">Services:</span>
                    <span class="text-muted">Not available</span>
                </p>
            @endif

            @if ($garage->description)
                <p class="card-text">
                    <span class="text-primary">Description:</span>
                    {{$garage->description}}
                </p>
            @else
                <p class="card-text">
                    <span class="text-primary">Description:</span>
                    <span class="text-muted">Not available</span>
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
