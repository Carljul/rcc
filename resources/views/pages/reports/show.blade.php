<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('font/css/font-awesome.css')}}">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

    <script src="{{asset('js/bootstrap/popper.min.js')}}"></script>

    @stack('css')

</head>
<body>
    {!!$report->htmlReport!!}
    
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let contractNo = '{!! $_GET['contractNo'] !!}';
            let report = '{!! $_GET['report'] !!}';
            console.log(report);

            $('#contractNo').html(contractNo);
        });
    </script>
</body>
</html>