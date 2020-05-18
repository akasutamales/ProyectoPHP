<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Camas`
    (
     `id`            int NOT NULL AUTO_INCREMENT ,
     `disponible`    bit NOT NULL ,
     `codigo`        varchar(45) NOT NULL ,
     `habitacion_id` int NOT NULL ,
    
    PRIMARY KEY (`id`),
    KEY `fkIdx_34` (`habitacion_id`),
    CONSTRAINT `FK_34` FOREIGN KEY `fkIdx_34` (`habitacion_id`) REFERENCES `Habitaciones` (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Camas creada correctamente<br>";
    } else {
        echo "Error en la creacion de Camas: " . mysqli_error($con);
    }
    mysqli_close($con);
?>