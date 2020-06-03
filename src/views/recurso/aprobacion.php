<?php
    include_once '../../services/RecursoService.php';
    $recursoServices = new RecursoService();
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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $exito = $recursoServices->solicitar($_POST['item'],$_POST['cantidad']);
            $recurso = $recursoServices->findByNombre($_POST['item']);
            if($exito){
                echo "<br>El recurso fue solicitado de forma exitosa<br>";
            }else{
                echo "<br>ERROR: no se pudo completar la solicitud<br>";
            }
            if( $recurso != null){
                echo "Los datos del recurso son: <br>";
                echo $recurso->toString();
            }
        }
    ?>
    <a href="../medico/menu-inicio.php">Volver al listado de pacientes</a>
</body>
</html>