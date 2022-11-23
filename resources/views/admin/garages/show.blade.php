@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('admin.garages.index') }}" class="btn btn-warning mb-2 mr-3">< back </a>

    <a href="{{ route('admin.messages', ['garage' => $garage]) }}" class="btn btn-warning mb-2 mr-3">Show correlated messages</a>

    <a href="{{ route('admin.views', ['garage' => $garage]) }}" class="btn btn-warning mb-2 mr-3">Check views</a>

    <div class="card mb-3">
        @if ($garage->image)
            <img src="{{ asset('storage/'. $garage->image) }}" class="card-img-top" alt="Image for {{$garage->title}}">
        @else
            <h4 class="card-title text-center mt-5">Image not available</h4>
        @endif

        <div class="card-body">
            <h5 class="card-title">
                <span class="text-warning">Title:</span>
                {{$garage->title}}
            </h5>

            <p class="card-text">
                <span class="text-warning">Address:</span>
                <span >{{$garage->address}}</span>
            </p>

            <p class="card-text">
                <span class="text-warning">Longitude:</span>
                <span >{{$garage->longitude}}</span>
            </p>

            <p class="card-text">
                <span class="text-warning">Latitude:</span>
                <span >{{$garage->latitude}}</span>
            </p>

            @if ($garage->sqmt > 1)
                <p class="card-text">
                    <span class="text-warning">Garage total area:</span>
                    {{$garage->sqmt}} m²
                </p>
            @else
                <p class="card-text">
                    <span class="text-warning">Garage total area:</span>
                    <span >Not available</span>
                </p>
            @endif

            @if ($garage->length > 1)
                <p class="card-text">
                    <span class="text-warning">Length:</span>
                    {{$garage->length}} mt
                </p>
            @else
                <p class="card-text">
                    <span class="text-warning">Length:</span>
                    <span >Not available</span>
                </p>
            @endif

            @if ($garage->width > 1)
                <p class="card-text">
                    <span class="text-warning">Width:</span>
                    {{$garage->width}} mt
                </p>
            @else
                <p class="card-text">
                    <span class="text-warning">Width:</span>
                    <span >Not available</span>
                </p>
            @endif
            @if ($garage->height > 1)
                <p class="card-text">
                    <span class="text-warning">Height:</span>
                    {{$garage->height}} mt
                </p>
            @else
                <p class="card-text">
                    <span class="text-warning">Height:</span>
                    <span >Not available</span>
                </p>
            @endif

            <p class="card-text">
                <span class="text-warning">N_Parking:</span>
                {{$garage->n_parking}}
            </p>

            @if (count($garage->services) > 0)
                <p class="card-text">
                    <span class="text-warning">Services:</span>
                    @foreach ($garage->services as $service)
                        <span class="text-success">
                            {{$service->name}} |
                        </span>
                    @endforeach
                </p>
            @else
                <p class="card-text">
                    <span class="text-warning">Services:</span>
                    <span >Not available</span>
                </p>
            @endif

            @if ($garage->description)
                <p class="card-text">
                    <span class="text-warning">Description:</span>
                    {{$garage->description}}
                </p>
            @else
                <p class="card-text">
                    <span class="text-warning">Description:</span>
                    <span >Not available</span>
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
