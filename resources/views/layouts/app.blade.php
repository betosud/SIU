<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SIU</title>
    <link rel="shortcut icon" href="{!! asset('imagenes/logotransparente.png') !!} ">

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{--<link href="{!! asset('bootstrap/bootstrap.min.css') !!}" rel="stylesheet">--}}
    <link href="{!! asset('toastr/build/toastr.css') !!}" rel="stylesheet">


{{--datetime--}}
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/datetime/moment.min.js"></script>
    {{--<script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="/datetime/build/js/bootstrap-datetimepicker.min.js"></script>
    {{--<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />--}}
    <link rel="stylesheet" href="/datetime/build/css/bootstrap-datetimepicker.min.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

{{--insertar menu--}}
@include('layouts.menu')





@yield('contenido')

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



{!! Html::script('toastr/build/toastr.min.js') !!}
{!! Html::script('js/utiles.js') !!}
@yield('scripts')


</body>
</html>