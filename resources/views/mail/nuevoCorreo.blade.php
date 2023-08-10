<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center><h3>COMERCIO LATINO</h3></center>
    <h1>Estimad@ : {{ $name }}</h1>
    <br>
    <p>
        Gracias por usar nuestro servicio, tu suscripcion <b>{{ $tipo }} {{ $modalidad }}</b>
        ha sido aceptada para mantener activo debe realizar el pago por QR y confirmar al siguiente email admin@comercio-latino.com, soporte@comercio-latino.com </p>
    <center>
        <img width="30%" src="https://comercio-latino.com/sistema/public/qrs/{{ $qr }}" alt="aqui la img">
    </center>
    <table>
        <tr>
            <td><b>Importe {{ $modalidad }} Bs:</b></td>
            <td>{{ $monto }}</td>
        </tr>
        <tr>
            <td><b>Fecha de Suscripcion:</b></td>
            <td>{{ $fecha }}</td>
        </tr>
    </table>
    <center>
        <a style="
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #007BFF; /* Color de fondo azul */
            color: #fff; /* Color de texto blanco */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            " href="{{ $url }}">Ir a la Tienda</a>
    </center>
    <p>Al no contar con la confirmacion de pago, la suscripcion sera revertido</p>
</body>
</html>