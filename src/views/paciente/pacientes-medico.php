<?php
    include_once '../../services/PacienteService.php';
    include_once '../../services/CamaService.php';
    include_once '../../services/UsuarioService.php';
    include_once '../../services/HabitacionService.php';
    $serviciopaciente = new PacienteService();
    $servicioCama = new CamaService();
    $servicioMedicos = new UsuarioService();
    $servicioHabitacion = new HabitacionService();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pacientes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1>Listado de mis pacientes</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Prioridad</th>
                    <th>Habitacion</th>
                    <th>Cama</th>
                    <th></th>
                </tr>
            </thead>
            <tbody text-align="center">
                <?php
                    $pacientes = $serviciopaciente->getAll2($_SESSION['medico_id']);

                    foreach ($pacientes as $i => $paciente) {

                        $cama = $servicioCama->findById($paciente->getIdCama());
                        $habitacion = $servicioHabitacion->findById( $cama->getIdHabitacion());

                        echo "<tr>";
                        echo "<td>".$paciente->getNombre()."</td>";
                        echo "<td>".$paciente->getPrioridad()."</td>";
                        echo "<td>".$habitacion->getCodigo()."</td>";
                        echo "<td>".$cama->getCodigo()."</td>";
                        echo "<td><a href='#'> Equipos </a></td>";
                        echo "<td><a href='../recurso/peticion.php?paciente=". $paciente->getId() . " '> Solicitar recursos </a></td>";
                        echo "</tr>" ;
                        
                    }
                ?>

            </tbody>
        </table>
    </body>
</html> 