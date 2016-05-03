<html lang="es-ES">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Registro de Solicitud de Gasto</h2>
<div>
    Le informamos que si solicitud de gasto fue registrada exitosamente se le asigno Folio: <strong>{!! $solicitud->id !!}</strong>
    <br>
    <h4>Datos de solicitud</h4>
    <ul style="list-style-type:none">
        <li>Barrio: <strong>{!! $barrio->nombreunidad !!}</strong></li>
        <li>Solicitante:<strong>{!! $solicitud->solicitante !!}</strong></li>
        <li>Monto: <strong>{!! $solicitud->cantidad !!}</strong></li>
        <li>Descripcion: <strong>{!! $solicitud->descripcion !!}</strong></li>
        <li>Organizacion: <strong>{!! $solicitud->organizacionnombre !!}</strong></li>
        <li>Tipo de Pago: <strong>{!! $solicitud->tipopagonombre !!}</strong></li>

    </ul>
<br>
    <br>

    Cual quier duda puede acercarse con sus lideres de su unidad
    <br>
    <br>
    <br><br>Si no reconoce este correo favor de reportarlos a <a href="mailto:soporte@estacaamecameca.org">soporte@estacaamecameca.org</a>
    <br>y notifiquelo a los lideres del barrio <strong>{!! $barrio->nombreunidad !!}</strong>

    <br><br>
    <img src="{!! asset('imagenes/logo.png') !!}">



</div>

</body>



</html>