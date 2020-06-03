<?php
include_once '../../services/HabitacionService.php';
$servicioHabitacion = new HabitacionService();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../resources/barra-navegacion.css" rel="stylesheet">
</head>

<body>
    <div class="topnav">
        <a href="../paciente/pacientes-medico.php">Visualizar pacientes</a>
        <a class="active" href="../habitacion/habitaciones-medico.php">Gestionar pacientes</a>
        <a href="../usuario/logout.php" >Cerrar sesion</a>
    </div>

    <h1>Lista de habitaciones disponibles</h1>
    <p>Seleccione la habitación en la que estará el paciente:</p>

    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>Codigo de habitación</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $str_datos = "";

            foreach ($servicioHabitacion->getDisponibles() as $i => $habitacion) {

                $str_datos .= "<tr>";
                $str_datos .= "<td> <a href='../cama/cama-medico.php?habitacion="
                . $habitacion->getId() . "' >" 
                . $habitacion->getCodigo() . "</a></td>";
                $str_datos .= "</tr>";
            }
            echo $str_datos;
            ?>
        </tbody>
    </table>
</body>

</html>