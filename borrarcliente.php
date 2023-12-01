<?php

    session_start();

    include("conectar_db.php");

    //se verifica el dni para identificar el cliente a borrar
    if(isset($_REQUEST["dni"])) {
        $dni = $_REQUEST["dni"];
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="clienteborrado.php?dni=<?php echo $dni; ?>" method="post">

        <label for="borrar">¿Quieres borrar el cliente?</label>
        Si <input type="radio" name="borrar" id="borrar" value="Si"> 
        No <input type="radio" name="borrar" id="borrar" value="No"> 

        <br><br>

        <input type="submit" name="enviar" id="enviar" value="borrar">
    </form>
</body>
</html>

