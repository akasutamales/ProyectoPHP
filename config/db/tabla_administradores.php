<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Administradores`
    (
     `id`          int NOT NULL AUTO_INCREMENT ,
     `usuario`     varchar(45) NOT NULL ,
     `contrasenia` varchar(45) NOT NULL ,
     `email`       varchar(45) NOT NULL ,
    
    PRIMARY KEY (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Administradores creada correctamente<br>";
    } else {
        echo "Error en la creacion de Adminisitradores: " . mysqli_error($con);
    }
    mysqli_close($con);
?>