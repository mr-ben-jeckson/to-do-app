<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <script>window.Laravel = { csrfToken: '{{csrf_token()}}'}</script>

        <title>Vue Laravel API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{url('css/bootstrap.css')}}">

        <!-- Styles -->
    </head>
    <body>
        <div id="app">
            <navbar></navbar>
            <div class="container">
                <products></products>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{url('js/bootstrap.min.js')}}"></script>
        <script src="{{url('js/jquery.min.js')}}"></script>
    </body>
</html>
