<?php
include_once '../../services/EquipoService.php';
$equipoService = new EquipoService();

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        Médico: <input type="text" value="medico">
        Paciente: <input type="text" value="paciente"> 
        Fecha: <label>DD:MM:AA hh:mm</label>
        Equipo: <p></p>
        Cantidad: <input type="text" value="cantidad">
        <input type="submit" value="Solicitar">
    </form>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Cantidad Disponible</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $str_datos = "";
                foreach ($equipoService->getAll() as $i => $equipo) {
                    $str_datos.= "<tr>";
                    $str_datos.= "<td>" . $equipo->getCodigo() . "</td>";
                    $str_datos.= "<td>" . $equipo->getDisponibles() . "</td>";
                    $str_datos.= "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>