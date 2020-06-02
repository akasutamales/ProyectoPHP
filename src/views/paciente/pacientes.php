<?php
    include_once '../../services/PacienteService.php';
    include_once '../../services/CamaService.php';
    include_once '../../services/UsuarioService.php';
    include_once '../../services/HabitacionService.php';
    $serviciopaciente = new PacienteService();
    $servicioCama = new CamaService();
    $servicioMedicos = new UsuarioService();
    $servicioHabitacion = new HabitacionService();
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
        <h1>Lista de pacientes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Habitacion</th>
                    <th>Cama</th>
                    <th>Medico</th>
                    <th></th>
                </tr>
            </thead>
            <tbody text-align="center">
                <?php
                    $id = 1;
                    $pacientes = $serviciopaciente->getAll();

                    foreach ($pacientes as $i => $paciente) {
                        $medico = $servicioMedicos->findById($paciente->getIdMedico());
                        $cama = $servicioCama->findById($paciente->getIdCama());
                        $habitacion = $servicioHabitacion->findById( $cama->getIdHabitacion());

                        echo "<tr>";
                        echo "<td>".$paciente->getId()."</td>";
                        echo "<td>".$paciente->getNombre()."</td>";
                        echo "<td>".$habitacion->getCodigo()."</td>";
                        echo "<td>".$cama->getCodigo()."</td>";
                        echo "<td>".$medico->getNombre()."</td>";
                        echo "<td><a href='../recurso/peticion.php'> Equipos </a></td>";
                        echo "</tr>" ;
                        
                    }
                ?>

            </tbody>
        </table>
    </body>
</html> 