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
        <link rel="stylesheet" href="../../resources/barra-navegacion.css">

    </head>
    <body>
    <div class="topnav">
        <a href="../administrador/centro-mensajes.php">Centro de mensajes</a>
        <a href="../usuario/listado.php">Gestionar usuarios</a>
        <a href="../habitacion/habitaciones.php">Gestionar habitaciones</a>
        <a class="active" href="../paciente/pacientes.php">Gestionar pacientes</a>
        <a href="../recurso/gestionar.php">Gestionar recursos</a>
        <a href="../equipos/gestionar-equipos.php">Gestionar equipos</a>
        <a href="../usuario/logout.php" >Cerrar sesion</a>
</div>
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
                        echo "<td><a href='../equipos/asignados.php?paciente=".$paciente->getId()."'> Equipos </a></td>";
                        echo "</tr>" ;
                        
                    }
                ?>

            </tbody>
        </table>
    </body>
</html> 