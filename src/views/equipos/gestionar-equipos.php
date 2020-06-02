<?php
    include_once '../../services/EquipoService.php';
    $equipoService = new EquipoService();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Código</th>
                <th>Disponibles</th>
                <th>Asignados</th>
            </tr>
        </thead>

        <form method="POST" action="<?= $_SERVER['PHP_SELF']?>">
            Código: <input type="text" name="codigo">
            Cantidad: <input type="text" name="cantidad">
            <input type="submit" value="Agregar equipos">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
            }
        ?>

        <tbody>
            <?php
                $str_datos = "";
                foreach ($equipoService->getAll() as $i => $equipo) {
                    $str_datos.="<tr>";
                    $str_datos.="<td>".$equipo->getCodigo()."</td>";
                    $str_datos.="<td>".$equipo->getDisponibles()."</td>";
                    $str_datos.="<td>".$equipo->getAsignados()."</td>";
                    $str_datos.="</tr>";
                }
                echo $str_datos;
            ?>
        </tbody>
    </table>
</body>
</html>