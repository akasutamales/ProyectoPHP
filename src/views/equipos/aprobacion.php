<?php
    include_once '../../services/EquipoService.php';
    include_once '../../services/SolicitudService.php';
    $EquipoServices = new EquipoService();
    $SolicitudServices = new SolicitudService();
    session_start();
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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $exito = $SolicitudServices->solicitar($_POST['equipo'],$_POST['cantidad'],$_POST['pacienteId'],$_SESSION['medico_id'],$_POST['fecha']);
            if($exito){
                echo "<br>La solicitud fue realizada de forma exitosa<br>";
            }else{
                echo "<br>ERROR: no se pudo completar la solicitud<br>";
            }
        }
    ?>
    <a href="../paciente/pacientes-medico.php">Volver al listado de pacientes</a>
</body>
</html>