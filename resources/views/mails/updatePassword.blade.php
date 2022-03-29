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

    <p>Ingrese al enlace </span> <a href="{{ $url }}">recuperar contraseña</a>, desde donde podrá actualizar su clave de acceso a nuestra plataforma.</p>

    <span>Recuerde mantener segura sus credenciales a fin de evitar acceso a terceros con fines maliciosos. </span>.

</body>
</html>
