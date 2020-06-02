<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Equipos`
    (
     `id`          int NOT NULL AUTO_INCREMENT ,
     `codigo`      varchar(45) NOT NULL ,
     `disponibles` int NOT NULL ,
     `asignados`   int NOT NULL ,
    
    PRIMARY KEY (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Equipos creada correctamente<br>";
    } else {
        echo "Error en la creacion de Equipos: " . mysqli_error($con);
    }
    mysqli_close($con);
?>