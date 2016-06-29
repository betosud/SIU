<html lang="es-ES">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Informasion sobre solicitud de Gasto</h2>
<div>
    Su solicitud de Gasto con id: <strong>{!! $sit->id !!}</strong> se a modificado.
    <br>
    @if($sit->idsit!='')
        El numero de Referecnia es: <strong>{!! $sit->idsit !!}</strong>
    @endif
    <br>


    <p>
        Para poder ver el status de su Solicitud y descargar formatos ingrese al sigiente  <a href="{!! URL::to('solicitud',array($sit->id,$sit->token)) !!}">Link</a>
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