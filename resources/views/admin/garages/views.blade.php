@extends('layouts.app')

@section('content')

<div class="container">
        <a
        class="btn btn-warning mb-5"
        href="{{route('admin.garages.show', ['garage' => $garage])}}"
        >
            Back
        </a>

        <h1 class="text-center text-warning">
            Title: <br>
            {{$garage->title}}
        </h1>

        <canvas id="myChart">

        </canvas>
    </div>


    <h2 id="views-count" class="d-none">
        {{count($garage->views)}}
    </h2>

    <ol class="d-none">
        @foreach ($garage->views as $view)
            @if ($view->date > '2022-01-01' && $view->date < '2022-01-31')
                <li class="gennaio">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-02-01' && $view->date < '2022-01-28')
                <li class="febbraio">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-03-01' && $view->date < '2022-01-31')
                <li class="marzo">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-04-01' && $view->date < '2022-04-30')
                <li class="aprile">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-05-01' && $view->date < '2022-05-31')
                <li class="maggio">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-06-01' && $view->date < '2022-06-30')
                <li class="giugno">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-07-01' && $view->date < '2022-07-31')
                <li class="luglio">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-08-01' && $view->date < '2022-08-31')
                <li class="agosto">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-09-01' && $view->date < '2022-09-30')
                <li class="settembre">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-10-01' && $view->date < '2022-10-31')
                <li class="ottobre">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-11-01' && $view->date < '2022-11-31')
                <li class="novembre">
                    {{$view->date}}
                </li>
            @endif
            @if ($view->date > '2022-12-01' && $view->date < '2022-12-31')
                <li class="dicembre">
                    {{$view->date}}
                </li>
            @endif
        @endforeach
    </ol>
@endsection
