<!DOCTYPE html>
{{--<html lang="es">--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SIU</title>
    <link rel="shortcut icon" href="{!! asset('imagenes/logotransparente.png') !!} ">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    {{--<link type="text/css" rel="stylesheet" href="{!! asset('materialize/css/materialize.min.css') !!}"  media="screen,projection"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

    <link type="text/css" rel="stylesheet" href="{!! asset('time/lolliclock.css') !!}"  media="screen,projection"/>




    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {!! Html::style('css/inputs.css') !!}


    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"/>
    <style>
        body {
            font-family: 'Roboto';
        }

        .fa-btn {
            margin-right: 4px;
        }
    </style>


    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body id="app-layout">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
{{--<script type="text/javascript" src="/materialize/js/materialize.min.js"></script>--}}
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="{!! asset('time/lolliclock.js') !!}"></script>


<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>

@include('layouts.menu')

@yield('content')





{!! Html::script('js/utiles.js') !!}
@yield('scripts')
</body>
</html>
