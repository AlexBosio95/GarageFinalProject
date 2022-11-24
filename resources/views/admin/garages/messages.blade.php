@extends('layouts.app')

@section('content')
    <div class="container">
        <a
        class="btn btn-warning mb-5"
        href="{{route('admin.garages.show', ['garage' => $garage])}}"
        >
            Back
        </a>

        <h1 class="text-center text-warning mb-5">Messages</h1>

        @if (count($garage->messages) > 0)
            @foreach ($garage->messages as $message)
                <div class="message-wrapper border border-light d-flex justify-content-around align-items-center">
                    <span class="text-warning my-3">Email from:</span>
                    <p class="d-flex align-items-center m-0">
                        {{$message->email}}
                    </p>
                    <span class="text-warning">Name:</span>
                    <p class="d-flex align-items-center m-0">
                        Name:
                        {{$message->name}}
                    </p>
                    <span class="text-warning">Surname:</span>
                    <p class="d-flex align-items-center m-0">
                        {{$message->surname}}
                    </p>
                </div>
                <div class="border border-light mb-4">

                    <span class="text-warning">Text:</span>
                    <p class="d-flex align-items-center m-0">
                        {{$message->text}}
                    </p>
                </div>
            @endforeach

        @else
            <h2 class="text-center text-warning mb-5">There are no messages for this garage</h2>
        @endif
    </div>
@endsection
