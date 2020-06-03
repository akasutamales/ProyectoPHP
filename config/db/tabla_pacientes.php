<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Pacientes`
    (
     `id`            int NOT NULL AUTO_INCREMENT ,
     `cedula`        varchar(20) NOT NULL ,
     `nombre`        varchar(45) NOT NULL ,
     `diagnostico`   varchar(45) NOT NULL ,
     `prioridad`     varchar(10) NOT NULL ,
     `fecha_ingreso` date NOT NULL ,
     `estadia`       int NOT NULL ,
     `cama_id`       int NOT NULL ,
     `medico_id`     int NOT NULL ,
    
    PRIMARY KEY (`id`),
    KEY `fkIdx_24` (`cama_id`),
    CONSTRAINT `FK_24` FOREIGN KEY `fkIdx_24` (`cama_id`) REFERENCES `Camas` (`id`),
    KEY `fkIdx_95` (`medico_id`),
    CONSTRAINT `FK_95` FOREIGN KEY `fkIdx_95` (`medico_id`) REFERENCES `Usuarios` (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Pacientes creada correctamente<br>";
    } else {
        echo "Error en la creacion de Pacientes: " . mysqli_error($con) . "<br>";
    }
    mysqli_close($con);
?>