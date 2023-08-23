<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .contenedor{
        width: 50%;
        min-height:auto;
        text-align: center;
        margin: 0 auto;
        padding: 40px;
        background: #ececec;
        border-top: 3px solid #046cac;
    }

    body {
        font-family: 'Roboto', sans-serif;
        color: #888;
        background-color:rgba(230, 225, 225, 0.5);
        text-align: center;
    }
    .negro{
        color: #000000;
    }
</style>
<body>
    <div class="contenedor">
        <center><span style='font-size: 30px;'><strong>Comercio Latino</strong></center>
        <h2>Estimad@ : {{ $name }}</h2>
        <br>
        <p class="negro">
            Gracias por usar nuestro servicio, tu suscripcion <b>{{ $tipo }} {{ $modalidad }}</b>
            ha sido aceptada para mantener activo debe realizar el pago por QR y confirmar al siguiente email admin@comercio-latino.com, soporte@comercio-latino.com </p>
        <center>
            <img width="30%" src="https://comercio-latino.com/sistema/public/qrs/{{ $qr }}" alt="aqui la img">
        </center>
        <table>
            <tr>
                <td class="negro"><b>Importe {{ $modalidad }} Bs:</b></td>
                <td class="negro">{{ $monto }}</td>
            </tr>
            <tr>
                <td class="negro"><b>Fecha de Suscripcion:</b></td>
                <td class="negro">{{ $fecha }}</td>
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
        <p class="negro">Al no contar con la confirmacion de pago, la suscripcion sera revertido</p>
    </div>
</body>
</html>


{{--  <html>
    <head>
    <title>Codigo</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Roboto', sans-serif;
        color: #888;
        background-color:rgba(230, 225, 225, 0.5);
        text-align: center;
    }
    .contenedor{
        width: 50%;
        min-height:auto;
        text-align: center;
        margin: 0 auto;
        padding: 40px;
        background: #ececec;
        border-top: 3px solid #046cac;
    }
    @media screen and (max-width: 480px) {
            .contenedor{
            width: 100%;
            min-height:auto;
            text-align: center;
            margin: 0 auto;
            padding: 40px;
            background: #ececec;
            border-top: 3px solid #046cac;
            }
        }
    img{
        margin-left: auto;
        margin-right: auto;
        display: block;
        padding:0px 0px 20px 0px;
    }
    p{
        color: #000000;
    }
    .boton {
      padding: 0px 10px 10px 10px;
      background-color: #046cac;
      color: white;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      text-decoration: none;
    }
    .boton:hover {
      background-color: #03619A;
    }
    </style>
    </head>
    <body>
        <div class='contenedor'>
            <br>
            <span style='font-size: 30px;'><strong>Comercio Latino</strong>
            <br><br>
            <p style='font-size: 14px; line-height: 2; text-align: justify;'>Por favor haga un clic en el siguiente enlace para la recuperación:</p>
            <p>&nbsp;</p>
            <a href='".$link."' class='boton'>
                <label style='font-size: 14px;color:white;'>¡Clic aquí para recuperar contraseña!</label>
            </a>
        </div>
    </body>
</html>  --}}
