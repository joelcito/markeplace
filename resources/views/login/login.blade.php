{{-- <!DOCTYPE html>
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
</html> --}}

<!DOCTYPE html>
<html>
<head>
  <title>Formulario de inicio de sesión</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 8px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    .form-group button {
      width: 100%;
      padding: 8px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Iniciar sesión</h2>
    <form action="{{ url('login/ingresa') }}" method="POST">
        @csrf
      <div class="form-group">
        <label for="username">Usuario:</label>
        <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required value="admin@gmail.com">
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name=" password" placeholder="Ingresa tu contraseña" required value="1234567lP.">
      </div>
      <div class="form-group">
        <button type="submit">Iniciar sesión</button>
      </div>
    </form>
  </div>
</body>
</html>

