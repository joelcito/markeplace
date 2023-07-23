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
    <p>Gracias por usar nuestro servicio, tu suscripcion {{ $tipo." ".$modalidad }} ha sido aceptada para mantener activo debe realizar el pago por QR y confirmar al siguiente email admin@comercio-latino.com </p>
    <center>
        {{-- <img src="{{ asset('qrs')."/".$qr }}" alt="aqui la img"> --}}
    </center>
    <table>
        <tr>
            <td><b>Importe {{ $modalidad }} Bs:</b></td>
            <td>
                @if (true)
                    2000
                @else
                    200
                @endif
            </td>
        </tr>
        <tr>
            <td><b>Fecha de Suscripcion:</b></td>
            <td>{{ date('d/m/Y H:m:s') }}</td>
        </tr>
    </table>
    <center>
        <button>Ir a la Tienda</button>
    </center>
    <p>Al no contar con la confirmacion de pago, la suscripcion sera revertido</p>
</body>
</html>
