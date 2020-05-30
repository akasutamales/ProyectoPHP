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
            echo "Habitación: ". $habitacion->getCodigo()." <br>";       
        ?>

    <form action="../habitacion/eliminar-habitacion.php" action="POST">
        <input type = "submit" value="Eliminar habitacion">
    </form>
    
    <form action="create-cama.php" method="POST" >
        Codigo: <input type="text" name="codigo">  
        <input type="submit" value="Agregar cama">
    </form>


    <h1>Lista de camas</h1>
    <table >
        <thead>
            <tr>
                <td>Código</td>
                <td>Disponibilidad</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $camas = $camaService->getAll($params['habitacion']);

                foreach ($camas as $i => $cama) {
                    echo "<tr>";
                    echo "<td>" . $cama->getCodigo() . "</td>";
                    if( $cama->getDisponible() == true){
                        echo "<td>Disponible</td>";
                    }else{
                        echo "<td>Ocupada</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <a href="../habitacion/habitaciones.php">Volver al listado</a>
</body>
</html>