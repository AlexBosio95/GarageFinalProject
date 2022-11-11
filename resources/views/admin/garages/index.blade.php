@extends('layouts.app')

@section('content')
<div class="container">
  {{-- ***Flash messages*** --}}
  @if (session('img-removed'))
    <div class="alert alert-danger">
        {{ session('img-removed') }}
    </div>
  @endif
  
  @if (session('created'))
    <div class="alert alert-success">
        {{ session('created') }}
    </div>
  @endif
  
  @if (session('edited'))
    <div class="alert alert-success">
        {{ session('edited') }}
    </div>
  @endif
  
  @if (session('deleted'))
    <div class="alert alert-danger">
        {{ session('deleted') }}
    </div>
  @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Square Meters</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Available</th>               
                  </tr>
                </thead>
                <tbody>
                    @foreach ($garages as $garage)
                        <tr>
                          <th scope="row">{{$garage->id}}</th>
                          <td>{{$garage->title}}</td>
                          <td>{{$garage->sqmt}}</td>
                          <td>{{$garage->address}}</td>
                          <td class="d-flex justify-content-between">
                            <a href="{{ route('admin.garages.show',['garage'=>$garage]) }}" class="btn btn-primary mr-2"> show </a>                      
                            <a href="{{ route('admin.garages.edit',['garage'=>$garage]) }}" class="btn btn-primary mr-2"> Edit </a>
                          
                            <form action="{{ route('admin.garages.destroy',['garage'=>$garage]) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <button type="submit" class="btn btn-danger mr-2" onclick="return confirm('Are you sure? This action is irreversible')"> Delete </button>                    
          
                            </form>
                          </td>  
                          <td>
                            @if ($garage->available)
                                <span class="text-success">
                                  Available
                                </span>
                            @else
                              <span class="text-danger">
                                Not available
                              </span>
                            @endif
                          </td>   
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <a href="{{ route('admin.garages.create') }}" class="btn btn-primary"> create </a>
        </div>
    </div>
</div>
@endsection
