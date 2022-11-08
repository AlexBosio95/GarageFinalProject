@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.garages.store') }}" method="POST">

        @csrf

        <div class="form-group">
          <label for="GarageTitle">Title</label>
          <input type="text" class="form-control" id="GarageTitle" placeholder="MyGarage" name="title">
        </div>
        
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="Via/piazz. rossi n 1" name="address">
        </div>

        <div class="form-group">
            <label for="sqmt">Square Meters </label>
            <input type="number" min="10" max="200" class="form-control" id="sqmt" placeholder="25" name="sqmt">
        </div>

        <div class="form-group">
            <label for="length">Length (mt)</label>
            <input type="number" min="3" max="20" class="form-control" id="length" placeholder="6" name="length">
        </div>
        <div class="form-group">
            <label for="width">width (mt)</label>
            <input type="number" min="1" max="10" class="form-control" id="width" placeholder="2" name="width">
        </div>
        <div class="form-group">
            <label for="height">height (mt)</label>
            <input type="number" min="1" max="6" class="form-control" id="height" placeholder="2" name="height">
        </div>

        

        <div class="form-group">
          <label for="exampleFormControlSelect2">Parking numbers</label>
          <select class="form-control" id="n_parking" name="n_parking">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>

        @foreach ($services as $service)
            <div class="custom-control custom-checkbox">
            
                <input type="checkbox" class="custom-control-input" id="{{ $service->id }}" name="services[]" value="{{ $service->id }}">
                <label class="custom-control-label" for="{{ $service->id }}">{{ $service->name }}</label>
            
            </div>
        @endforeach

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
      
</div>
@endsection