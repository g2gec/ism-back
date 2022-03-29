<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <div>
        <strong>{{ $title }}</strong>
    </div>

    <p>Estimado(a) <strong>{{ $user }},</strong></p>

    <p>La presente notificación tiene como finalidad informarle, que se le han asignado las credenciales para el acceso a nuetra plataforma. Recuerde que debe resguardar la misma, a fin de evitar que esta sea accedida por terceros.</p>

    <p><strong>Usuario: </strong> {{ $email }} </p>
    <p><strong>Contraseña: </strong> {{ $password }} </p>

    <span>Recuerde que para acceder a nuetra plataforma, debe hacerlo desde el siguiente enlace: </span> <a href="{{ $url }}">International Signature</a>.

    <p>Gracias por confiar en nosotros!!</p>

</body>
</html>
