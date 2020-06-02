<?php
    include_once '../../services/UsuarioService.php';
    include_once '../../services/CamaService.php';
    include_once '../../services/HabitacionService.php';
    $usuarioService = new UsuarioService();
    $camaService = new CamaService();
    $habitacionService = new HabitacionService();

    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $params);    
    
    session_start();
    if(isset($_SESSION['user'])){
        $medico = $usuarioService->findByUsername($_SESSION['user']);
        $_SESSION['cama'] = $params['cama'];
    } else {
        echo "No ha iniciado sesión<br>";
    }

    $cama = $camaService->findById($params['cama']);
    $habitacion = $habitacionService->findById($cama->getIdHabitacion());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
</head>
<body>
    <form action="add.php" method="POST">
    Cedula: <input type="text" name="cedula" >
    <br><br>
    Nombre: <input type="text" name="nombre" >
    <br><br>
    Diagnostico: <input type="text" name="diagnostico" >
    <br><br>
    Prioridad: <input type="text" name="prioridad" >
    <br><br>
    Fecha Ingreso<input type="date" name="fecha_ingreso" >
    <br><br>
    Estadia: <input type="number" name="estadia" >
    <br><br>
    Doctor Asignado: <input type="text" name="medico"  readonly value="<?= $medico->getNombre() ?>">
    <br><br>
    Habitación Asignada: <input type="text" name="habitacion"  readonly value="<?= $habitacion->getCodigo() ?>" >
    <br><br>
    Cama Asignada: <input type="text" name="cama"  readonly value="<?= $cama->getCodigo() ?>" >
    <br><br>
    <input type="submit" name="add" value="Agregar Paciente" >
    </form>

    <a href="../habitacion/habitaciones-medico.php">Volver</a>
</body>
</html>