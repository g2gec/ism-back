<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>Un proveedor quiere contactar con  International Signature</p>
    <p>Estos son los datos del proveedor que ha realizado la petición:</p>
    <ul>
        <li>Nombre: {{ $data-first_name }}</li>
        <li>Apellido: {{ $data->last_name }}</li>
        <li>Pais: {{ $data->country }}</li>
        <li>Ciudad: {{ $data->city }}</li>
        <li>Email: {{ $data->email }}</li>
        <li>Telefono: {{ $data->phone }}</li>

        <li>Tipo de alojamiento: {{ $data->type_accommodation }}</li>
        <li>Nombre de alojamiento: {{ $data->accommodation_name }}</li>
        <li>Dirección de alojamiento: {{ $data->accomodation_address }}</li>
        
    </ul>
</body>
</html>