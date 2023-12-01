<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Introduce tus datos</h1>

    <form action="insertarcliente.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">

        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">

        <label for="contraseña">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">

        <br><br>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion">

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" id="localidad">

        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia">

        <br><br>

        <label for="telefono">Telefono</label>
        <input type="tel" name="telefono" id="telefono" pattern="[0-9]{9}">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <br><br>

        <input type="submit" name="enviar" id="enviar" value="enviar">
    </form>
</body>
</html>

