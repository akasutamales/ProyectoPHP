<?php
include_once '../../services/SolicitudService.php';
include_once '../../services/EquipoService.php';
include_once '../../services/PacienteService.php';
$solicitudService = new SolicitudService();
$equipoService = new EquipoService();
$pacienteService = new PacienteService();
$equipo = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cambiar asignación</h1>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $equipo = $equipoService->findByCodigo($_POST['equipo']);
            $exito = $solicitudService->cambiarAsignacion($_POST['origen'], $_POST['destino'], $equipo->getId(), $_POST['cantidad']);
            if ($exito) {
                echo "Se cambio la asignación de forma exitosa<br>";
            } else {
                echo "ERROR: No se pudo modificar la asignación del equipo<br>";
            }
        } else {
            $equipo = $equipoService->findById($_GET['equipo']);
        }
        $solicitudes = $solicitudService->getAllByEquipo($equipo->getId());

    ?>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <p>Seleccione los pacientes de origen y destino para transferir la asignación del equipo</p>
        Equipo: <input type="text" name='equipo' value="<?= $equipo->getCodigo() ?>" readonly><br>
        Cantidad: <input type="number" min="0" max="3" name="cantidad"><br>
        <?php
        echo "Paciente origen: ";
        echo "<select name='origen'>";
        foreach ($solicitudes as $i => $solicitud) {
            $paciente = $pacienteService->findById($solicitud->getPaciente());
            echo "<option value='" . $paciente->getId() . "'>" . $paciente->getNombre() . "(" . $paciente->getPrioridad() . ") </option>";
        }
        echo "</select><br>";
        echo "Paciente destino: ";
        echo "<select name='destino'>";
        foreach ($pacienteService->getAll() as $i => $paciente) {
            echo "<option value='" . $paciente->getId() . "'>" . $paciente->getNombre() . "(" . $paciente->getPrioridad() . ") </option>";
        }
        echo "</select><br>";
        ?>
        <input type="submit" value="Cambiar asignación">
    </form>


    <?php echo "<h1>Lista de " . $equipo->getCodigo() . " asignados</h1>" ?>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Paciente</th>
                <th>Prioridad</th>
                <th>Cantidad asignada</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($solicitudes as $i => $solicitud) {
                $paciente = $pacienteService->findById($solicitud->getPaciente());
                echo "<tr>";
                echo "<td>" . $paciente->getNombre() . "</td>";
                echo "<td>" . $paciente->getPrioridad() . "</td>";
                echo "<td>" . $solicitud->getCantidad() . "</td>";
                echo "<td>" . $solicitud->isAprobado() . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>