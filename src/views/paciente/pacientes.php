<?php
    include_once '../../services/PacienteService.php';
    $serviciopaciente = new PacienteService();
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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cama</th>
                    <th>Medico</th>
                </tr>
            </thead>
            <tbody text-align="center">
                <?php
                    $id = 1;
                    $pacientes = $serviciopaciente->getAll2($id);

                    foreach ($pacientes as $i => $paciente) {
                        echo "<tr>";
                        echo "<td>".$paciente->getId()."</td>";
                        echo "<td>".$paciente->getNombre()."</td>";
                        echo "<td>".$paciente->getIdCama()."</td>";
                        echo "<td>".$paciente->getIdMedico()."</td>";
                        echo "</tr>" ;
                    }
                ?>
            </tbody>
        </table>
    </body>
</html> 