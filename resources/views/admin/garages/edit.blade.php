@extends('layouts.app')

@section('title') {{'- Edit Garage'}} @endsection

@section('content')
<div class="container">
  <a href="{{ route('admin.garages.index') }}" class="btn btn-warning mb-2">< back </a>
    <form enctype="multipart/form-data" action="{{ route('admin.garages.update', ['garage' => $garage]) }}" method="POST" id="edit-form">

        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="GarageTitle">Title</label>
          <input type="text" class="bg-warning form-control @error ('title') is-invalid @enderror" id="title" placeholder="MyGarage" name="title" value="{{old('title', $garage->title)}}" required>

          @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="bg-warning form-control @error ('address') is-invalid @enderror" id="address" placeholder="insert a complete address for the research" value="{{old('address', $garage->address)}}" required>

          @error('address')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <select id="search-results" class="bg-warning form-control mb-2" name="address">

          @if (old('address', $garage->address))
          <option value="{{$garage->address}}" selected>
            {{$garage->address}}
          </option>
          @else
            <option value="" selected disabled>Select an address</option>
          @endif
          {{-- option injected by axios.js --}}
        </select>

        <div class="form-group">
            <label for="length">Length (mt)</label>
            <input type="number" min="3" max="20" class="bg-warning form-control @error ('length') is-invalid @enderror" id="length" placeholder="Example: 5" name="length" value="{{old('length', $garage->length)}}">

            @error('length')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="width">width (mt)</label>
            <input type="number" min="1" max="10" class="bg-warning form-control @error ('width') is-invalid @enderror" id="width" placeholder="Example: 5" name="width" value="{{old('width', $garage->width)}}">

            @error('width')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="height">height (mt)</label>
            <input type="number" min="1" max="6" class="bg-warning form-control @error ('height') is-invalid @enderror" id="height" placeholder="Example: 5" name="height" value="{{old('height', $garage->height)}}">

            @error('height')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlSelect2">Parking numbers</label>
          <select class="bg-warning form-control @error ('n_parking') is-invalid @enderror" id="n_parking" name="n_parking" required>
            <option {{old('n_parking', $garage->n_parking)==1?'selected':''}} value="1">1</option>
            <option {{old('n_parking', $garage->n_parking)==2?'selected':''}} value="2">2</option>
            <option {{old('n_parking', $garage->n_parking)==3?'selected':''}} value="3">3</option>
            <option {{old('n_parking', $garage->n_parking)==4?'selected':''}} value="4">4</option>
            <option {{old('n_parking', $garage->n_parking)==5?'selected':''}} value="5">5</option>
          </select>

          @error('n_parking')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        @foreach ($services as $service)
            <div class="custom-control custom-checkbox">

                <div class="form-check form-check-inline">
                    @if ($errors->any())
                    <input {{(in_array($service->id, old('services', []))) ? 'checked' : ''}} name='services[]' class="form-check-input" type="checkbox" id="{{$service->id}}" value="{{$service->id}}">
                    @else
                    <input {{($garage->services->contains($service))?'checked':''}} name='services[]' class="form-check-input" type="checkbox" id="{{$service->id}}" value="{{$service->id}}">
                    @endif
                    <label class="form-check-label" for="{{$service->id}}">{{$service->name}}</label>
                </div>

            </div>
        @endforeach

        @error('services')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="toggle-available my-4">
          <h6>Available</h6>
          <div class="toggleWrapper">
            <input type="checkbox" name="available" class="bg-warning mobileToggle @error ('available') is-invalid @enderror"  id="available" value="1" {{old('available', $garage->available) == 1 ? 'checked' : ''}} >
            <label for="available"></label>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="bg-warning form-control @error ('description') is-invalid @enderror" id="description" rows="3" name="description">
            {{old('description', $garage->description)}}
          </textarea>

          @error('description')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        @if ($garage->image)

          <img src="{{ asset('storage/'. $garage->image) }}" alt="image garage" class="w-100">

        @else

          <div class="form-group">
            <label for="image">Images</label>
            <input type="file" class="bg-warning form-control @error ('image') is-invalid @enderror" id="image" name="image">
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

        @endif

        <button type="submit" class="btn btn-warning my-4" id="submit-btn">Edit</button>

      </form>

      @if ($garage->image)

      <form action="{{route('admin.garages.deleteCover', ['garage' => $garage])}}" method="POST" id="deleteCoverForm">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger"> Delete image</button>

      </form>

      @endif

</div>
@endsection
