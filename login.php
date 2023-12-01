<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Iniciar Sesión</h1>

    <form action="verificarlogin.php" method="post">

        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">

        <br><br>

        <label for="password">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">

        <br><br>

        <input type="submit" name="login" id="login" value="Log In">

    </form>

    <br><br>

    <button><a href="clientenuevo.php">Registrarse</a></button>
    <button><a href="actualizarContraseña.php">He olvidado mi contraseña</a></button>

</body>
</html>

