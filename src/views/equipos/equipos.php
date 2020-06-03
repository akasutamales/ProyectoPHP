<?php
    include_once '../../services/EquipoService.php';
    include_once '../../services/PacienteService.php';
    include_once '../../services/UsuarioService.php';
    include_once '../../services/SolicitudService.php';
    
    $solicitudService = new SolicitudService();
    $equipoServices = new EquipoService();
    $pacienteServices = new PacienteService();
    $medicoServices = new UsuarioService();
    session_start();

    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $params);
    $paciente = $pacienteServices->findById($params['paciente']);
    $medico = $medicoServices->findById($_SESSION['medico_id']);
    
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s', time());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="aprobacion.php">
        Médico: <input type="text" name="medico" value="<?= $medico->getNombre() ?>" readonly><br>
        Paciente: <input type="text" name="paciente" value="<?= $paciente->getNombre() ?>" readonly><br> 
        <input type="hidden" name="pacienteId" value="<?= $paciente->getId() ?>" ><br> 
        Fecha: <input type="text" name="fecha" value="<?= $fecha ?>" readonly><br>
        <?php
        
        $equipos = $equipoServices->getDisponibles();
        echo "<select name='equipo'>";
        foreach ($equipos as $i => $equipo) {
            echo "<option>". $equipo->getCodigo() ." </option>";
        }
        echo "</select>";
        echo "<input type='text' name='cantidad' placeholder='cantidad'> "; 
        ?>
        <input type="submit" value="Solicitar">
    </form>

    <h1>Equipos asignados al paciente</h1>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Fecha</th>
                <th>Equipo</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $str_datos = "";
                foreach ($solicitudService->getAllByPaciente($paciente->getId()) as $i => $solicitud) {
                    $equipo = $equipoServices->findById($solicitud->getEquipo());
                    $str_datos.= "<tr>";
                    $str_datos.= "<td>" . $solicitud->getFecha() . "</td>";
                    $str_datos.= "<td>" . $equipo->getCodigo() . "</td>";
                    $str_datos.= "<td>" . $solicitud->getCantidad() . "</td>";
                    $str_datos.= "<td>" . $solicitud->isAprobado() . "</td>";
                    $str_datos.= "<td><a href='eliminar-asignacion.php?solicitud=" . $solicitud->getId() . "'>Eliminar</a></td>";
                    $str_datos.= "</tr>";
                }
                echo $str_datos;
            ?>
        </tbody>
    </table>
</body>
</html>