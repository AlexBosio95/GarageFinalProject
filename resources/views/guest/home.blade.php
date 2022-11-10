
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Benvenuti in frontend</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />
</head>
<body>
    <div class="text-right m-4">
        
        <a class="btn btn-primary " href="{{ route('login') }}">{{ __('Login') }}</a>   
    
    </div>
    
    <h1 class="text-center">Ciao PM!</h1>
    {{-- <div id="root"></div>
    <script src="{{asset('js/front.js')}}"></script> --}}
</body>
</html>

