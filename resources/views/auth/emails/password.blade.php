<html lang="es-ES">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Establecer Password</h2>
<div>
    Para poder establecer su nuevo password vaya a la siguiente direccion <a href="{!! URL::to('password/reset',array($token)) !!}">Establecer password</a>
    <br>Este Link es valido por los siguientes {!! Config::get('auth.passwords.users.expire') !!} minutos
    <br><br>Cualquier problema contactar a Soporte Tecnico <a href="mailto:soporte@estacaamecameca.org">soporte@estacaamecameca.org</a>
    <br><br>
    <img src="{!! asset('imagenes/logo.png') !!}">
</div>
</body>
</html>