<?php
    include_once '../../services/HabitacionService.php';
    $servicioHabitacion = new HabitacionService();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones</title>
</head>
<body>
    
        <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>" >
            Codigo: <input type="text" name="codigo" placeholder="Ingrese código de la nueva habitación">
            <input type="submit" value="Agregar">
        </form>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $exito = $servicioHabitacion->create($_POST['codigo']);
                if( $exito ){
                    echo "La habitación ha sido creada con exito<br>";
                }
                else{
                    echo "ERROR: La habitación no se pudo crear<br>";
                }
            }
        ?>

        <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>Codigo</th>
            </tr>
        </thead>

        <tbody>
                <?php
                    $str_datos = "";

                    foreach ($servicioHabitacion->getAll() as $i => $habitacion) {
                        
                        $str_datos.= "<tr>";
                        $str_datos.= "<td>".$habitacion->getCodigo()."</td>";
                        $str_datos.= "<td><a href='../cama/camas.php?habitacion=".$habitacion->getId()."'>Editar</a></td>";
                        $str_datos.= "</tr>";
                    }
                    echo $str_datos;
                ?>
        </tbody>
    </table>
</body>
</html>