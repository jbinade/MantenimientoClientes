<?php

    session_start();

    include("conectar_db.php");

    $con = new Conexion();

    //se verifica el dni y se buscar el cliente a partir de ese dni y se muestras sus datos
    if (isset($_REQUEST["dni"])) {
        $dni = $_REQUEST["dni"];
    
        $buscarClientes = $con->buscarCliente($dni);

        if($buscarClientes) {
            echo "DNI: " . $buscarClientes->dni;
            echo "<br>";
            echo "Nombre: " . $buscarClientes->nombre;
            echo "<br>";
            echo "Direccion: " . $buscarClientes->direccion;
            echo "<br>";
            echo "Localidad: " . $buscarClientes->localidad;
            echo "<br>";
            echo "Provincia: " . $buscarClientes->provincia;
            echo "<br>";
            echo "Telefono: " . $buscarClientes->telefono;
            echo "<br>";
            echo "Email: " . $buscarClientes->email;
            echo "<br>";
            echo "<br>";
            echo "<button><a href='indexAdmin.php'>Inicio</a></button>";

        } else {
            echo "No se ha encontrado el cliente";
            echo "<br>";
            echo "<br>";
            echo "<button><a href='indexAdmin.php'>Inicio</a></button>";

        }

    }

?>