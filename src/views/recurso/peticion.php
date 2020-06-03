<?php
    include_once '../../services/RecursoService.php';
    include_once '../../services/PacienteService.php';
    include_once '../../services/UsuarioService.php';
    $recursoServices = new RecursoService();
    $pacienteServices = new PacienteService();
    $medicoServices = new UsuarioService();
    session_start();

    
    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $params);
    $paciente = $pacienteServices->findById($params['paciente']);
    $medico = $medicoServices->findById($_SESSION['medico_id']);
    
    date_default_timezone_set('America/Bogota');
    $fecha = date('m/d/Y h:i:s a', time());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peticiones</title>
</head>
<body>

    <form action="aprobacion.php" method="POST">
    Nombre del médico: <input type="text" name="medico" value="<?= $medico->getNombre() ?>" readonly ><br> 
    Nombre del paciente: <input type="text" name="paciente" value="<?= $paciente->getNombre() ?>" readonly><br> 
    Fecha: <input type="text" name="fecha" value="<?= $fecha ?>" readonly><br> 
    <?php
        $recursos = $recursoServices->getDisponibles();
        echo "<select name='item'>";
        foreach ($recursos as $i => $r) {
            echo "<option value='" . $r->getNombre() . "'  >". $r->getNombre(). " (" . $r->getUnidades() . ") " ."</option>";
        
        }
        echo "</select>";
        echo "<input type='text' name='cantidad' placeholder='cantidad'> "; 
    ?>
    <input type="submit" value="Solicitar recursos"> 
    </form>

    

</body>
</html>