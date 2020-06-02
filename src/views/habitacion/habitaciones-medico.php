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
</head>

<body>

    <?php
    $str_datos = "";

    foreach ($servicioHabitacion->getDisponibles() as $i => $habitacion) {

        $str_datos .= "<tr>";
        $str_datos .= "<td>" . $habitacion->getCodigo() . "</td>";

        $str_datos .= "<td><a href='../cama/camas.php?habitacion=" . $habitacion->getId() . "'>Editar</a></td>";
        $str_datos .= "</tr>";
    }
    echo $str_datos;
    ?>
</body>

</html>