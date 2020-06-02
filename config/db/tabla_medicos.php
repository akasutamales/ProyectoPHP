<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Medicos`
    (
     `id`         int NOT NULL AUTO_INCREMENT ,
     `email`      varchar(45) NOT NULL ,
     `nombre`     varchar(45) NOT NULL ,
     `id_usuario` int NOT NULL ,
    
    PRIMARY KEY (`id`),
    KEY `fkIdx_90` (`id_usuario`),
    CONSTRAINT `FK_90` FOREIGN KEY `fkIdx_90` (`id_usuario`) REFERENCES `Usuarios` (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Medicos creada correctamente<br>";
    } else {
        echo "Error en la creacion de Medicos: " . mysqli_error($con);
    }
    mysqli_close($con);
?>