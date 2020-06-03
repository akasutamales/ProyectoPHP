<?php
    include_once '../../services/SolicitudService.php';
    include_once '../../services/EquipoService.php';
    $solicitudService = new SolicitudService();
    $equipoServices = new EquipoService();
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Equipos asignados</h1>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Fecha</th>
                <th>Equipo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $str_datos = "";
                foreach ($solicitudService->getAllByPaciente($_GET['paciente']) as $i => $solicitud) {
                    if( $solicitud->isAprobado() == 1){

                        $equipo = $equipoServices->findById($solicitud->getEquipo());
                        $str_datos.= "<tr>";
                        $str_datos.= "<td>" . $solicitud->getFecha() . "</td>";
                        $str_datos.= "<td>" . $equipo->getCodigo() . "</td>";
                        $str_datos.= "<td>" . $solicitud->getCantidad() . "</td>";
                        $str_datos.= "</tr>";
                    }
                }
                echo $str_datos;
            ?>
        </tbody>
    </table>

    <a href="../paciente/pacientes.php">Volver al listado de pacientes</a>
</body>
</html>