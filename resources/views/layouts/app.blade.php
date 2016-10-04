<!DOCTYPE html>
{{--<html lang="es">--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SIU</title>
    <link rel="shortcut icon" href="{!! asset('imagenes/logotransparente.png') !!} ">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    {{--<link type="text/css" rel="stylesheet" href="{!! asset('materialize/css/materialize.min.css') !!}"  media="screen,projection"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="{!! asset('time/lolliclock.css') !!}"  media="screen,projection"/>




    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {!! Html::style('css/inputs.css') !!}
    <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"/>







    <style>
        body {
            font-family: 'Roboto';

        }
        main {
            flex: 1 1 auto;
        }
        .fa-btn {
            margin-right: 4px;
        }
    </style>




</head>
<body id="app-layout">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
{{--<script type="text/javascript" src="/materialize/js/materialize.min.js"></script>--}}
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="{!! asset('time/lolliclock.js') !!}"></script>


{{--<script   src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"   integrity="sha256-0vBSIAi/8FxkNOSKyPEfdGQzFDak1dlqFKBYqBp1yC4="   crossorigin="anonymous"></script>--}}
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>


{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>--}}
<link rel="stylesheet" href="{{asset('datepicker/css/bootstrap-datepicker3.css')}}">
<link rel="stylesheet" href="{{asset('datepicker/css/bootstrap-datepicker.standalone.css')}}">
<script src="{!! asset('datepicker/js/bootstrap-datepicker.js') !!}"></script>
{{--<script src="{!! asset('datePicker/locales/bootstrap-datepicker.es.min.js') !!}"></script>--}}




<link rel='stylesheet' href='{!! asset('fullcalendar/fullcalendar.css') !!}' />
{{--    <script src='{!! asset('fullcalendar/lib/jquery.min.js') !!}'></script>--}}
<script src='{!! asset('fullcalendar/lib/moment.min.js') !!}'></script>
<script src='{!! asset('fullcalendar/fullcalendar.js') !!}'></script>
<script src='{!! asset('fullcalendar/lang/es.js') !!}'></script>
<script type='text/javascript' src='{!! asset('fullcalendar/gcal.js') !!}'></script>

@include('layouts.menu')
@yield('content')





{!! Html::script('js/utiles.js') !!}
@yield('scripts')



</body>
{{--@include('layouts.footer')--}}
</html>
