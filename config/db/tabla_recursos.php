<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Recursos`
    (
     `id`            int NOT NULL AUTO_INCREMENT ,
     `nombre`        varchar(45) NOT NULL ,
     `unidad_medida` varchar(45) NOT NULL ,
     `cantidad`      double NOT NULL ,
    
    PRIMARY KEY (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Recursos creada correctamente<br>";
    } else {
        echo "Error en la creacion de Recursos: " . mysqli_error($con) . "<br>";
    }
    mysqli_close($con);
?>