<?php
include("conectar_db.php");

session_start();

// Verificar que el rol no es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "") {
    header("Location: login.php");
    exit();
}

// Obtener el DNI del usuario autenticado si existe
$dni = isset($_SESSION['dni']) ? $_SESSION['dni'] : null;


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Mantenimiento de clientes</h1> 

    <table>
        <tr id="campos">
            <th>DNI</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Localidad</th>
            <th>Provincia</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th id="editar">Editar</th>
            <th id="borrar">Borrar</th>
        </tr>
        
        <?php

            $con = new Conexion();

            //se llama a la funcion buscar cliente que devuelve el usuario que ha iniciado sesion
            $buscarClientes = $con->buscarCliente($dni);

            if($buscarClientes) {
                echo "<tr>";
                echo "<td>{$buscarClientes->dni}</td>";
                echo "<td>{$buscarClientes->nombre}</td>";
                echo "<td>{$buscarClientes->direccion}</td>";
                echo "<td>{$buscarClientes->localidad}</td>";
                echo "<td>{$buscarClientes->provincia}</td>";
                echo "<td>{$buscarClientes->telefono}</td>";
                echo "<td>{$buscarClientes->email}</td>";
                echo "<td><a href='editarcliente.php?dni={$buscarClientes->dni}'><img src='./img/editar.png' alt='Editar'></a></td>";
                echo "<td><a href='borrarcliente.php?dni={$buscarClientes->dni}'><img src='./img/borrar.jpg' alt='Borrar'></a></td>";
                echo "</tr>";
        
            }
        
        ?>

    </table>

    <br><br>

    <button><a href="cerrarsesion.php">Cerrar Sesión</a></button>

</body>
</html>
