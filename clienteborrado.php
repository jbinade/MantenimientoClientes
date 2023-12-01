<?php

    session_start();

    include("conectar_db.php");

    $con = new Conexion();

    //se verifica el dni
    if(isset($_REQUEST["dni"])) {
        $dni = $_REQUEST["dni"];
    }

   
    //si se ha seleccionado la opcion Si se llama a la funcion borrar que borra el cliente
    if (isset($_REQUEST["borrar"]) && ($_REQUEST["borrar"]) == "Si") { 
        
        $borrarCliente = $con->borrar($dni);
       
        //despues de eliminar el cleinte se vuelve a inicio en funcion del inicio de sesion 
        if($borrarCliente && $_SESSION["rol"] == 'administrador') {
            header("Location: indexAdmin.php");

        } else if($borrarCliente && $_SESSION["rol"] == "") {
            header("Location: indexUser.php");
        
        //si no se encuentra el dni muestra error
        } else {
            echo "Error al borrar el cliente";

            if($_SESSION["rol"] == 'administrador') {
                header("Location: indexAdmin.php");

            } else if($_SESSION["rol"] == "") {
                header("Location: indexUser.php");

            }
        }
    }
        
?>