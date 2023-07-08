<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('login/ingresa') }}" method="POST">
        @csrf
        <label for="">USUARIO</label>
        <input type="text" id="usuario" name="usuario" value="admin@gmail.com">
        <label for="">CONTRASENIA</label>
        <input type="password" id="password" name=" password" value="admin">
        <button type="submit">INGRESAR</button>
    </form>
</body>
</html>
