<html lang="es-ES">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{!! $descripcion !!}</h2>
<div>
     Envio de Documentos SIU
    Por medio le la presente le informamos que tiene un documento de {!! $descripcion !!} asignado por parte la unidad {!! $ward->nameunit !!}.
    <br>
    Si el documento no esta adjunto puede verlo en el siguiente
    @if($modulo<>'sit')

    <a href="{!! route('pdf'.$modulo,[$data->id,'ver',$data->token]) !!}">>>Link<<</a>
        @else
        <a href="{!! route('pdf'.$modulo,[$data->id,'completo','ver',$data->token]) !!}">>>Link<<</a>
    @endif
    <br>
    <br>
    <br><br>Si no puede ver el documento pongase en contacto con soporte <a href="mailto:soporte@estacaamecameca.org">soporte@estacaamecameca.org</a>
    <br>y notifiquelo a los lideres del barrio {!! $ward->nameunit !!}



</div>

</body>



</html>