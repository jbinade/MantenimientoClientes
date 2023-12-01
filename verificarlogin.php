<?php

include('conectar_db.php');

//array para almacenar errores
$error = array();

//objeto conexion
$con = new Conexion();

$dni = $_REQUEST["dni"];
$contrasena = $_REQUEST["contrasena"];

//verficar el rol pasando el dni y la contraseña
$verificarLogin = $con->verificarLogin($dni, $contrasena);

if (!$verificarLogin) {
    $error["error"] = "Usuario incorrecto";
}

if (isset($error["error"])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Iniciar Sesión</h1>

    <form action="verificarlogin.php" method="post">

        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">

        <br><br>

        <label for="password">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">

        <br><br>

        <input type="submit" name="login" id="login" value="Log In">

        <?php 
        if (isset($error["error"])) { 
            echo "<span style='color: red;'>". $error["error"]."</span>"; 
        } 
        ?>

    </form>

    <br><br>

    <button><a href="clientenuevo.php">Registrarse</a></button>

</body>
</html>

<?php

} else {

    session_start();

    $_SESSION["dni"] = $dni;

    $_SESSION["rol"] = $verificarLogin["rol"];


    //si el rol es administrador se redirige a una pagina de incio u otra
    if ($verificarLogin["rol"] == 'administrador') {
        header("Location: indexAdmin.php");
    } else if ($verificarLogin["rol"] == "") {
        header("Location: indexUser.php");
    } else {
        echo "Error";
    }
}

