@extends('layouts.app')

@section('content')
<div class="container">
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
                          <td>
                            <a href="{{ route('admin.garages.show',['garage'=>$garage]) }}" class="btn btn-primary"> show </a>                      
                            <a href="{{ route('admin.garages.edit',['garage'=>$garage]) }}" class="btn btn-primary"> Edit </a>
                          
                            <form action="{{ route('admin.garages.destroy',['garage'=>$garage]) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <button type="submit" class="btn btn-danger"> Delete </button>                    
          
                            </form>
                          </td>  
                          <td>
                            {{ $garage->available }}
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
