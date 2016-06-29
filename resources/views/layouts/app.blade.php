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
    <link type="text/css" rel="stylesheet" href="{!! asset('materialize/css/materialize.min.css') !!}"  media="screen,projection"/>


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




</head>
<body id="app-layout">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/materialize/js/materialize.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="{!! asset('time/lolliclock.js') !!}"></script>


<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

@include('layouts.menu')


@yield('content')





<script>
    $( document ).ready(function() {

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year
            closeOnSelect: true,
            labelMonthNext: 'Siguiente Mes',
            labelMonthPrev: 'Mes Anterior',
            labelMonthSelect: 'Selecciona Mes',
            labelYearSelect: 'Selecciona Año',
            monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Nombiembre', 'Diciembre' ],
            monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
            weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
            weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
            weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
            today: 'Hoy',
            clear: 'Borrar',
            close: 'Cerrar',
            format: 'yyyy-mm-dd'
        });
        $('#pick-a-time').lolliclock({autoclose:true});



        $(".button-collapse").sideNav();
        $('.slider').slider({
            Height:200
        });
        $('.modal-trigger').leanModal({
            dismissible: false,
        });
        $('select').material_select();

        $('.tooltipped').tooltip({delay: 50});
        $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,

                    constrain_width: true, // Does not change width of dropdown to that of the activator
                    hover: true, // Activate on hover
                    gutter: 0, // Spacing from edge
                    belowOrigin: true, // Displays dropdown below the button
                    alignment: 'left' // Displays dropdown with edge aligned to the left of button
                }
        );
    });
</script>
@yield('scripts')
</body>
</html>
