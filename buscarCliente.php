<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Introduce el DNI a buscar:</h1>

    <form action="clienteBuscado.php" method="post">
        
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">

        <input type="submit" name="enviar" id="enviar" value="enviar">

    </form>
</body>
</html>
