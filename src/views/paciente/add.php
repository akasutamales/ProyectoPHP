<?php

    include_once '../../services/PacienteService.php';
    $pacienteService = new PacienteService();
    session_start();

    $medico_id = $_SESSION['medico_id'];
    $cama_id = $_SESSION['cama'];
    
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
        $exito = $pacienteService->create($_POST['cedula'],$_POST['nombre'],$_POST['diagnostico'],$_POST['prioridad'],$_POST['fecha_ingreso'],$_POST['estadia'],$medico_id,$cama_id);
        $paciente = $pacienteService->findByCedula($_POST['cedula']);
        $str_datos = "";
        
        if( $paciente == null )
            $exito = false;
        
        if ($exito){
            $str_datos.= "El usuario se creo de forma exitosa con los datos: <br>";
            $str_datos.= $paciente->toString(); 
        }else{
            $str_datos.= "<br>ERROR: No se creo el paciente<br>";
        }
        echo $str_datos;
    ?>

    <a href="../medico/menu-inicio.php">Volver</a>
</body>
</html>