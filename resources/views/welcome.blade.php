<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

       
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <link href="{{ asset('css/hover-card.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/selector.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('css/active.css') }}">

    </head>

    <body>

       <div class="container-fluid p-0 d-flex flex-column">
            <x-top-bar />
            @yield('main')
       </div>

    </body> 
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('jquery/jquery.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script> -->
</html>
