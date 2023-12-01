<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Actualización de la contraseña</h1>

    <form action="contraseñaActualizada.php" method="post">

        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">

        <br><br>

        <label for="password">Nueva Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">

        <br><br>

        <input type="submit" name="login" id="login" value="Actualizar">

    </form>

</body>
</html>