<html lang="es-ES">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Registro de Solicitud de Gasto</h2>
<div>
    Le informamos que si solicitud de gasto fue registrada exitosamente se le asigno Numero: <strong>{!! $sit->id !!}</strong>
    <br>
    <h4>Datos de solicitud</h4>
    <ul style="list-style-type:none">
        <li>Barrio: <strong>{!! $sit->datosbarrio->nombreunidad !!}</strong></li>
        <li>Solicitante:<strong>{!! $sit->solicitante !!}</strong></li>
        <li>Pagable:<strong>{!! $sit->pagable !!}</strong></li>
        <li>Monto: <strong>{!! $sit->cantidad !!}</strong></li>
        <li>Descripcion: <strong>{!! $sit->descripcion !!}</strong></li>
        <li>Organizacion: <strong>{!! $sit->organizacionnombre !!}</strong></li>
        <li>Tipo de Pago: <strong>{!! $sit->tipopagodsc !!}</strong></li>
        <li>Status: <strong>{!! $sit->statusnombre !!}</strong></li>

    </ul>
    <br>

    <p>
        Para segir el estatus de su solicitud podra hacerlo dando click <a href="{!! URL::to('solicitud',array($sit->id,$sit->token)) !!}">Aqui</a>
        <br>
        <br>
        Si no es redirigida a su navegador copie y peque la sigueinte Url en su navegador preferido
        <br>
        <a href="{!! URL::to('solicitud',array($sit->id,$sit->token)) !!}">{!! URL::to('solicitud',array($sit->id,$sit->token)) !!}</a>
    </p>
<br>
    <br>

    Cualquier duda puede acercarse con sus lideres de su unidad
    <br>
    <br>
    <br><br>Si no reconoce este correo favor de reportarlos a <a href="mailto:soporte@estacaamecameca.org">soporte@estacaamecameca.org</a>
    <br>y notifiquelo a los lideres del barrio <strong>{!! $barrio->nombreunidad !!}</strong>

    <br><br>
    <img src="{!! asset('imagenes/logo.png') !!}">



</div>

</body>



</html>