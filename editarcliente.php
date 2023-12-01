<?php

    session_start();

    include("conectar_db.php");

    //se verifica el dni y se busca el cliente para mostrar sus datos para editarlos
    if(isset($_REQUEST["dni"])) {
        $dni = $_REQUEST["dni"];
    
       
        $con = new Conexion();
            
        $datosCliente = $con->buscarCliente($dni);

        

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
    <form action="clienteEditado.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $datosCliente->nombre; ?>">

        <label for="dni">DNI <?php echo $datosCliente->dni; ?></label>
        <input type="hidden" name="dni" value="<?php echo $datosCliente->dni; ?>">

        <br><br>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" value="<?php echo $datosCliente->direccion; ?>">

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" id="localidad" value="<?php echo $datosCliente->localidad; ?>">
    
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" value="<?php echo $datosCliente->provincia; ?>">

        <br><br>

        <label for="telefono">Telefono</label>
        <input type="tel" name="telefono" id="telefono" pattern="[0-9]{9}" value="<?php echo $datosCliente->telefono; ?>">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $datosCliente->email; ?>" required>

        <br><br>

        <input type="submit" name="enviar" id="enviar" value="enviar"> 
    </form>
</body>
</html>

