@extends('layouts.app')

@section('content')
    <div class="container">
        <a
        class="btn btn-primary mb-5" 
        href="{{route('admin.garages.show', ['garage' => $garage])}}"
        >
            Back
        </a>

        <h1 class="text-center text-primary mb-5">Messages</h1>

        @if (count($garage->messages) > 0)
            @foreach ($garage->messages as $message)
                <div class="message-wrapper d-flex justify-content-around">
                    <span class="text-primary">Email from:</span>
                    <p>
                        {{$message->email}}
                    </p>
                    <span class="text-primary">Name:</span>
                    <p>
                        Name:
                        {{$message->name}}
                    </p>
                    <span class="text-primary">Surname:</span>
                    <p>
                        {{$message->surname}}
                    </p>
                    <span class="text-primary">Text:</span>
                    <p>
                        {{$message->text}}
                    </p>
                </div>
            @endforeach
            
        @else
            <h2 class="text-center text-primary mb-5">There are no messages for this garage</h2>
        @endif
    </div>
@endsection