@extends('layouts.app')

@section('title') {{'- Garage List'}} @endsection

@section('content')
    <div class="container text-light">
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

    <a href="{{ route('admin.garages.create') }}" class="btn btn-warning mb-3 button-sm">create</a>
        <div class="row justify-content-center">
            <div class="col">
                <table class="table table-hover table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col" class="small-none text-center">Square Meters</th>
                        <th scope="col" class="small-none text-center">Address</th>
                        <th scope="col" class="text-center">Actions</th>
                        <th scope="col">Available</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($garages as $garage)
                            <tr>
                            <td>{{$garage->title}}</td>
                            <td class="small-none text-center">{{$garage->sqmt}}</td>
                            <td class="small-none">{{$garage->address}}</td>
                            <td class="d-flex justify-content-between flex-wrap">
                                <a href="{{ route('admin.garages.show',['garage'=>$garage]) }}" class="btn btn-warning m-1"> show </a>
                                <a href="{{ route('admin.garages.edit',['garage'=>$garage]) }}" class="btn btn-warning m-1"> Edit </a>

                                <form action="{{ route('admin.garages.destroy',['garage'=>$garage]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger m-1" onclick="return confirm('Are you sure? This action is irreversible')"> Delete </button>

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
            </div>
        </div>
    </div>
@endsection
