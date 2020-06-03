<?php

include_once '../../services/UsuarioService.php';

$str_datos = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exito = true;
    if ($_POST['Contrasenia'] !== $_POST['ConfirmPass']) {
        $str_datos .= "<br>ERROR: Las contraseñas no coinciden<br>";
        $exito = false;
    }

    if ($_POST['Email'] !== $_POST['ConfirmEmail']) {
        $str_datos .= "<br>ERROR: Los correos no coinciden<br>";
        $exito = false;
    }
    if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) ){
        $str_datos.="La estructura del correo es inválida debe ser NOMBRE@DOMINIO <br>";
        $exito = false;
    }

    if ($exito) {

        $usuarioService = new UsuarioService();
        $exito = $usuarioService->register($_POST['Usuario'], 'Admin', $_POST['Contrasenia'], $_POST['Email'],$_POST['Nombre']);

        if ($exito) {
            $str_datos .= "<br>El usuario se registró con exito<br>";
        } else {
            $str_datos .= "<br>ERROR: no se pudo registrar el usuario!<br>";
        }
    }
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
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">

        <p>Nombre:</p> <input type="text" name="Nombre">
        <p>Nombre de usuario:</p> <input type="text" name="Usuario">
        <p>Contraseña:</p> <input type="password" name="Contrasenia">
        <p>Confirmar Contraseña:</p> <input type="password" name="ConfirmPass">
        <p>Email:</p> <input type="email" name="Email">
        <p>Confirmar email:</p> <input type="email" name="ConfirmEmail">
        <div>
            <input type="submit" value="Registrar admin">
        </div>
    </form>
    <button><a href="listado.php">Volver al listado de usuarios</a></button>

    <?php
        echo $str_datos;
    ?>
</body>

</html>