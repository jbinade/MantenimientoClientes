<?php

    session_start();

    include("conectar_db.php");

    $con = new Conexion();

    //array para almacenar fallos
    $fallos = array();

    $dni = $_REQUEST["dni"];
    $nombre = $_REQUEST["nombre"];
    $contrasena = $_REQUEST["contrasena"];
    $direccion = $_REQUEST["direccion"];
    $localidad = $_REQUEST["localidad"];
    $provincia = $_REQUEST["provincia"];
    $telefono = $_REQUEST["telefono"];
    $email = $_REQUEST["email"];

    
    //funcion para validar el dni
    function validarDNI($dni, $con) {
        $fallos = array();
    
        if (strlen($dni) == 9) {
            $numeros = substr($dni, 0, 8);
            $letra = strtoupper(substr($dni, 8, 1));
    
            $comprobarNumeros = ord($numeros);
            
            //se comprueba si hay numeros
            if ($comprobarNumeros >= 48 && $comprobarNumeros <= 57) {
                $comprobarLetra = ord($letra);
                
                //se comprueba que la letra es valida
                if (($comprobarLetra >= 65 && $comprobarLetra <= 90) || ($comprobarLetra >= 97 && $comprobarLetra <= 122)) {
                    $letrasDNI = "TRWAGMYFPDXBNJZSQVHLCKE";
                    $numDni = $numeros % 23;
                    $comprobarDni = $letrasDNI[$numDni];
    
                    if ($letra == $comprobarDni) {
                        $letra = strtoupper($letra);
                    } else {
                        $fallos["dni"] = "Letra no válida";
                    }
                } else {
                    $fallos["dni"] = "No has introducido una letra";
                }
            } else {
                $fallos["dni"] = "No has introducido números";
            }
    
            $buscarDNI = $con->buscarDNI($dni);
            
            //se comprueba si el dni ya existe en la base de datos
            if ($buscarDNI) {
                $fallos["dni"] = "Este DNI ya se encuentra en la base de datos";
            }
        } else {
            $fallos["dni"] = "El DNI es obligatorio";
        }
    
        return $fallos;
    }

    //verificar los campos
    if (empty($nombre)) {
        $fallos["nombre"] = "El nombre es obligatorio";
    }

    if (empty($contrasena)) {
        $fallos["contrasena"] = "La contraseña es obligatoria";
    }

    if (empty($email) || strpos($email, " ") !== false) {
        $fallos["email"] = "El email no puede estar en blanco ni tener espacios";

    }

    if (empty($direccion)) {
        $fallos["direccion"] = "La direccion es obligatoria";
    }

    if (empty($localidad)) {
        $fallos["localidad"] = "La localidad es obligatoria";
    }

    if (empty($provincia)) {
        $fallos["provincia"] = "La provincia es obligatoria";
    }

    //comprobar si el telefono contiene numeros y su longitud
    if (empty($telefono)) {

        $fallos["telefono"] = "El teléfono es obligatorio";
        
    } else {
        if (strlen($telefono) != 9 || !is_numeric($telefono)) {
            $fallos["telefono"] = "Teléfono incorrecto";
        }

    }
        

    $fallos = array_merge($fallos, validarDNI($dni, $con));

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
    
    <form action="insertarcliente.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>">
        <?php 
        if (isset($fallos["nombre"])) { 
            echo "<span style='color: red;'>". $fallos["nombre"]."</span>"; 
        } 
        ?>

        <label for="dni">DNI</label>
        <input type="text" name="dni" value="<?php echo $dni; ?>">
        <?php if (isset($fallos["dni"])) { 
            echo "<span style='color: red;'>".$fallos["dni"]."</span>"; 
        } 
        ?>

        <label for="dni">Contraseña</label>
        <input type="password" name="contrasena" value="<?php echo $contrasena; ?>">
        <?php if (isset($fallos["contrasena"])) { 
            echo "<span style='color: red;'>".$fallos["contrasena"]."</span>"; 
        } 
        ?>

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
        <input type="email" name="email" value="<?php echo $email; ?>" required>
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
        
        //se crea un objeto cliente al que se le pasan los campos y se insertan en la base de datos
        $con = new Conexion();
        $cliente = new Cliente($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email, $rol, $contrasena);
        $cliente1 = $con->insertar($cliente);

        //segun el rol se redirige a una pagina de inicio
        if($cliente1 && $_SESSION["rol"] == 'administrador') {
            header("Location: indexAdmin.php");

        } else if($cliente1 && $_SESSION["rol"] == "") {
            header("Location: indexUser.php");

        } else {
            echo "Error al insertar el cliente ";

        }

    }
?>