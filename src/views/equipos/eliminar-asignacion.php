<?php
    include_once '../../services/SolicitudService.php';
    $solicitudService = new SolicitudService(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $solicitud = $solicitudService->findById($_GET['solicitud']);
        $exito = $solicitudService->delete($solicitud->getId());
        if( $exito ){
            echo "La solicitud se elimino de forma exitosa<br>";
        }else{
            echo "ERROR: no se pudo eliminar la solicitud<br>";
        }
        echo "Los datos de la solicitud eran: <br>";
        echo $solicitud->toString();
        echo "<br><a href='equipos.php?paciente=".$solicitud->getPaciente()."' >Volver al listado de equipos</a>";
    ?>    
</body>
</html>