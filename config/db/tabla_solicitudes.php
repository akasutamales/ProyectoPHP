<?php
    include_once '../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE `Solicitudes`
    (
     `id`          int NOT NULL AUTO_INCREMENT ,
     `cantidad`    int NOT NULL ,
     `medico_id`   int NOT NULL ,
     `equipo_id`   int NOT NULL ,
     `aprobado`    bit NOT NULL ,
     `paciente_id` int NOT NULL ,
    
    PRIMARY KEY (`id`),
    KEY `fkIdx_72` (`medico_id`),
    CONSTRAINT `FK_72` FOREIGN KEY `fkIdx_72` (`medico_id`) REFERENCES `Medicos` (`id`),
    KEY `fkIdx_75` (`equipo_id`),
    CONSTRAINT `FK_75` FOREIGN KEY `fkIdx_75` (`equipo_id`) REFERENCES `Equipos` (`id`),
    KEY `fkIdx_85` (`paciente_id`),
    CONSTRAINT `FK_85` FOREIGN KEY `fkIdx_85` (`paciente_id`) REFERENCES `Pacientes` (`id`)
    );";

    if (mysqli_query($con, $sql)) {
        echo "Tabla Solicitudes creada correctamente<br>";
    } else {
        echo "Error en la creacion de Solicitudes: " . mysqli_error($con);
    }
    mysqli_close($con);
?>