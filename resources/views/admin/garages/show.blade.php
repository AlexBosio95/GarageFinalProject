@extends('layouts.app')

@section('content')
<div class="container">



    <h1>{{ $garage->title }}</h1>

    <h3>Address</h3>
    <h4>{{ $garage->address }}</h4>

    <h3>Garage total area</h3>
    <h4>{{ $garage->sqmt }} mt&#178</h4>

    <h3>Length of the garage</h3>
    <h4>{{ $garage->length }} mt</h4>

    <h3>width of the garage</h3>
    <h4>{{ $garage->width }} mt</h4>

    <h3>Height of the garage</h3>
    <h4>{{ $garage->height }} mt</h4>

    <h3>Nuber of parking spots</h3>
    <h4>{{ $garage->n_parking }}</h4>

    <h4>Services</h4>
    @foreach ($garage->services as $service )
    <ul>
        <li>{{ $service->name }}</li>
    </ul>   
    @endforeach

    <h3>Description</h3>
    <p>{{ $garage->description }}</p>

    <h3>Images</h3>

    <img src="{{ asset('storage/'. $garage->image) }}" alt="image garage">

</div>
@endsection