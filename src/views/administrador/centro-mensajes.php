<?php
    include_once '../../services/SolicitudService.php';
    include_once '../../services/PacienteService.php';
    include_once '../../services/UsuarioService.php';
    include_once '../../services/EquipoService.php';
    $solicitudService = new SolicitudService();
    $pacienteService = new PacienteService();
    $medicoService = new UsuarioService();
    $equipoService = new EquipoService();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../resources/barra-navegacion.css">
</head>

<body>

    <div class="topnav">
        <a class="active" href="#home">Centro de mensajes</a>
        <a href="../habitacion/habitaciones.php">Gestionar habitaciones</a>
        <a href="../paciente/pacientes.php">Gestionar pacientes</a>
        <a href="../recurso/gestionar.php">Gestionar recursos</a>
        <a href="../equipos/gestionar-equipos.php">Gestionar equipos</a>
        <a href="../../Index.html" >Cerrar sesion</a>
    </div>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Prioridad</th>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Medico</th>
                <th>Equipo</th>
                <th>Cantidad</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $solicitudes = $solicitudService->getPendientes();
                $str_datos = "";
                $cantidad = [];
                
                foreach ($solicitudes as $i => $solicitud) {
                    $paciente = $pacienteService->findById( $solicitud->getPaciente());
                    $medico = $medicoService->findById( $solicitud->getMedico());
                    $equipo = $equipoService->findById( $solicitud->getEquipo());

                    if( !isset( $cantidad[$equipo->getCodigo()] ) ){
                        $cantidad[$equipo->getCodigo()]=$equipo->getDisponibles();
                    }
                    $str_datos.="<tr>";
                    $str_datos.="<td>". $paciente->getPrioridad() ."</td>";
                    $str_datos.="<td>". $solicitud->getFecha() ."</td>";
                    $str_datos.="<td>". $paciente->getNombre() ."</td>";
                    $str_datos.="<td>". $medico->getNombre() ."</td>";
                    $str_datos.="<td>". $equipo->getCodigo() ."</td>";
                    $str_datos.="<td>". $solicitud->getCantidad() ."</td>";
                    
                    if( $cantidad[$equipo->getCodigo()] > 0){
                        $str_datos.="<td><a href='confirmacion-solicitud.php?solicitud=".$solicitud->getId()."' >Aprobar</a></td>";
                        $cantidad[$equipo->getCodigo()]-=$solicitud->getCantidad();
                    }
                    
                    $str_datos.="<td><a href='denegacion-solicitud.php?solicitud=".$solicitud->getId()."' >Rechazar</a></td>";
                    
                    $str_datos.="</tr>";
                    $str_datos.="</tr>";
                }
                echo $str_datos;
            ?>
        </tbody>
    </table>

</body>
</html>