<?php

    session_start();

    //verificar que el rol es administrador
    if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 'administrador') {
        header("Location: login.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Mantenimiento de clientes</h1>

    <table>
        <tr id="campos">
            <th>DNI</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Localidad</th>
            <th>Provincia</th>
            <th>Telefono</th>
            <th>Email</th>
            <th id="editar">Editar</th>
            <th id="borrar">Borrar</th>
        </tr>
        
        <?php
            include('conectar_db.php');

            //se llama a la funcion consultar que devuelve un array de clientes y se muestran en una tabla
            $con = new Conexion();
            $clientes = $con->consultar();

            foreach($clientes as $cliente) {
                echo "<tr>";
                echo "<td>{$cliente->dni}</td>";
                echo "<td>{$cliente->nombre}</td>";
                echo "<td>{$cliente->direccion}</td>";
                echo "<td>{$cliente->localidad}</td>";
                echo "<td>{$cliente->provincia}</td>";
                echo "<td>{$cliente->telefono}</td>";
                echo "<td>{$cliente->email}</td>";
                echo "<td><a href='editarcliente.php?dni={$cliente->dni}'><img src='./img/editar.png' alt='Editar'></a></td>";
                echo "<td><a href='borrarcliente.php?dni={$cliente->dni}'><img src='./img/borrar.jpg' alt='Borrar'></a></td>";
                echo "</tr>";
            }

        ?>

    </table>

    <br><br>

    <button><a href="clientenuevo.php">Nuevo cliente</a></button>
    <button><a href="buscarCliente.php">Buscar cliente</a></button>
    <button><a href="cerrarsesion.php">Cerrar Sesión</a></button>

</body>
</html>























