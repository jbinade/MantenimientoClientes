<?php

    session_start();

    include("conectar_db.php");

    $con = new Conexion();

    //array para almacenar fallos
    $fallos = array();

    $dni = $_REQUEST["dni"];
    $nombre = $_REQUEST["nombre"];
    $direccion = $_REQUEST["direccion"];
    $localidad = $_REQUEST["localidad"];
    $provincia = $_REQUEST["provincia"];
    $telefono = $_REQUEST["telefono"];
    $email = $_REQUEST["email"];

    
    //se busca el cliente a partir del dni
    $clienteDNI = $con->buscarCliente($dni);

    //verificar los campos
    if (empty($nombre)) {
        $fallos["nombre"] = "El campo Nombre es obligatorio";
    }

    if(empty($email) || strpos($email, " ") !== false) {
        $fallos["email"] = "El email no puede estar en blanco ni tener espacios";

    }

    if (empty($direccion)) {
        $fallos["direccion"] = "La direccion es obligatoria";
    }

    if (empty($localidad)) {
        $fallos["localidad"] = "La localidad es obligatoria";
    }

    if (empty($provincia)) {
        $fallos["provincia"] = "La provinicia es obligatoria";
    }

    if (empty($telefono)) {

        $fallos["telefono"] = "El teléfono es obligatorio";
        
    } else {
        if (strlen($telefono) != 9 || !is_numeric($telefono)) {
            $fallos["telefono"] = "Teléfono incorrecto";
        }

    }

    //si hay fallos al introducir el fomulario se vuelve a mostrar indicando el error en color rojo
    if (count($fallos) > 0) {
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
            <input type="text" name="nombre" value="<?php echo $nombre; ?>">
            <?php 
            if (isset($fallos["nombre"])) { 
                echo "<span style='color: red;'>". $fallos["nombre"]."</span>"; 
            } 
            ?>

            <label for="dni">DNI <?php echo $clienteDNI->dni; ?></label>
            <input type="hidden" name="dni" value="<?php echo $clienteDNI->dni; ?>">
        
            <br><br>
        
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" value="<?php echo $direccion; ?>">
            <?php 
            if (isset($fallos["direccion"])) { 
                echo "<span style='color: red;'>". $fallos["direccion"]."</span>"; 
            } 
            ?>
                
            <label for="localidad">Localidad</label>
            <input type="text" name="localidad" value="<?php echo $localidad; ?>">
            <?php 
            if (isset($fallos["localidad"])) { 
                echo "<span style='color: red;'>". $fallos["localidad"]."</span>"; 
            } 
            ?>
                
            <label for="provincia">Provincia</label>
            <input type="text" name="provincia" value="<?php echo $provincia; ?>">
            <?php 
            if (isset($fallos["provincia"])) { 
                echo "<span style='color: red;'>". $fallos["provincia"]."</span>"; 
            } 
            ?>
            <br><br>
        
            <label for="telefono">Telefono</label>
            <input type="tel" name="telefono" value="<?php echo $telefono; ?>">
            <?php 
            if (isset($fallos["telefono"])) { 
                echo "<span style='color: red;'>". $fallos["telefono"]."</span>"; 
            } 
            ?>
                
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <?php 
            if (isset($fallos["email"])) { 
                echo "<span style='color: red;'>".$fallos["email"]."</span>"; 
            } 
            ?>
            <br><br>
                        
            <input type="submit" name="enviar" id="enviar" value="enviar">
            </form>
        </body>
        </html>
        
<?php

    } else {

        //se crea un objeto cliente al que se le pasan los campos y se actualizan en la base de datos
        $cliente = new Cliente($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email, $rol, $contrasena);

        $con = new Conexion();

        $cliente1 = $con->actualizar($cliente);

        //segun el rol se redirige a una pagina de inicio
        if ($cliente1 && $_SESSION["rol"] == 'administrador') {
            header("Location: indexAdmin.php");
               
        } else if($cliente1 && $_SESSION["rol"] == "") {
            header("Location: indexUser.php");

        } else {
            echo "Error al actualizar el cliente ";
        }
    }
?>
    