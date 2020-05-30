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
            </tr>
        </thead>

        <form method="post" action="forms/">
            Codigo: <input type="text" name="codigo" placeholder="Ingrese código de la nueva habitación">
            <input type="submit" value="Agregar">
        </form>

        <tbody>
            <tr>
                <?php
                    include_once '../../services/HabitacionService.php';
                    $servicioHabitacion = new HabitacionService();
                    $str_datos = "";

                    foreach ($servicioHabitacion->getAll() as $i => $habitacion) {
                        $str_datos.= "<td>".$habitacion->getCodigo()."</td>";
                        $str_datos.= "<td><a href=camas.php?habitacion=".$habitacion->getId().">Editar</a></td>";
                        $str_datos.= "<br>";
                    }

                    echo $str_datos;
                ?>
            </tr>
        </tbody>
    </table>
</body>
</html>