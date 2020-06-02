<?php
include_once '../../services/CamaService.php';
include_once '../../services/HabitacionService.php';
$camaService = new CamaService();
$habitacionService = new HabitacionService();

$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$parts = parse_url($url);
parse_str($parts['query'], $params);

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
    $habitacion = $habitacionService->findById($params['habitacion']);
    session_start();
    $_SESSION['habitacion'] = $params['habitacion'];
    echo "Habitación: " . $habitacion->getCodigo() . " <br>";
    ?>

    <h1>Lista de camas</h1>
    <table>
        <thead>
            <tr>
                <td>Código</td>
                <td>Disponibilidad</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $camas = $camaService->getDisponibles($params['habitacion']);

            foreach ($camas as $i => $cama) {
                echo "<tr>";
                echo "<td>" . $cama->getCodigo() . "</td>";
                if ($cama->getDisponible() == true) {
                    echo "<td>Disponible</td>";
                } else {
                    echo "<td>Ocupada</td>";
                }
                echo "<td><a href='../paciente/agregar.php?cama=" . $cama->getId() . "' >Asignar paciente</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>