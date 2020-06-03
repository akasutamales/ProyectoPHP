<?php

    include_once '../../services/SolicitudService.php';
    include_once '../../services/PacienteService.php';
    include_once '../../services/UsuarioService.php';
    include_once '../../services/EquipoService.php';
    $solicitudService = new SolicitudService();
    $pacienteService = new PacienteService();
    $medicoService = new UsuarioService();
    $equipoService = new EquipoService();

    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $params);

    $solicitud = $solicitudService->findById( $params['solicitud']);
    $paciente = $pacienteService->findById( $solicitud->getPaciente());
    $medico = $medicoService->findById( $solicitud->getMedico());
    $equipo = $equipoService->findById( $solicitud->getEquipo());
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

        $resultado = $solicitudService->aprobarSolicitud($solicitud);
        if( $resultado['exito']){

            $mensaje = "La solicitud del equipo " . $equipo->getCodigo() . " fue aprobada."
            . "\nLos datos de la solicitud son: " 
            . "\nUnidades asignadas: " . $resultado['asignados']
            //. "\nUnidades no asignadas: " . $resultado['no_asignados']
            . "\n\nAtentamente, Akasutamales.";
            $mensaje=wordwrap($mensaje,70,"\n");
            if(mail($medico->getEmail(),"Solicitud aprobada",$mensaje)){
                echo "La solicitud fue aprobada correctamente, se notifico al correo " . $medico->getEmail()."<br>";
            }else{
                echo "Error en el envío del correo<br>";
            }
        }else{
            echo "ERROR: no se pudo procesar la solicitud<br>";
        }
    ?>
</body>
</html>