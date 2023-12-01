<?php

    include('conectar_db.php');

    $con = new Conexion();

    $dni = $_REQUEST["dni"];
    $contrasena = $_REQUEST["contrasena"];


    //se llama a la conexion y se actualiza la contraseña en funcion del dni introducido
    try {

        $conexion = $con->conectar_db();
        $stmt = $conexion->prepare(
            'UPDATE clientes SET contrasena = :contrasena WHERE dni = :dni'
        );
        $rows = $stmt->execute( array( ':dni' => $dni,
                                            ':contrasena' => $contrasena));

        if($rows > 0) {
            echo "Contraseña actualizada correctamente";

        } 

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    echo "<br>";
    echo "<br>";
    echo "<button><a href='indexAdmin.php'>Inicio</a></button>";


?>