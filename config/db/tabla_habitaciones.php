<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Habitaciones`
    (
     `id`     int NOT NULL AUTO_INCREMENT ,
     `codigo` varchar(45) NOT NULL ,
    
    PRIMARY KEY (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Habitaciones creada correctamente<br>";
    } else {
        echo "Error en la creacion de Habitaciones: " . mysqli_error($con) . "<br>";
    }
    mysqli_close($con);
?>