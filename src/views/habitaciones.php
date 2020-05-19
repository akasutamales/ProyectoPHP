<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones</title>
</head>
<body>
    
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Codigo</th>
                <th>Camas</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                    include_once '../services/HabitacionService.php';
                    $servicioHabitacion = new HabitacionService();
                    foreach ($servicioHabitacion->getAll() as $i => $habitacion) {
                        echo "<td>".$habitacion->getCodigo()."</td>";
                        echo "<td>".$habitacion->listadoCamasToString()."</td>";
                        // echo "<td><a href="."camas.php?$habitacion->getId()".">Editar</a></td>";
                    }
                ?>
            </tr>
        </tbody>
    </table>
</body>
</html>