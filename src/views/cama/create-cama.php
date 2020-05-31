<?php
    include_once '../../services/CamaService.php';
    $camaService = new CamaService();
    
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
        session_start();
        $habitacion = $_SESSION['habitacion'];

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $exito = $camaService->create(true,$_POST['codigo'],$habitacion);
            if( $exito ){
                echo "La cama ha sido creada con los siguintes datos<br>";
                echo $camaService->findByCodigo($_POST['codigo'])->toString();
            }
            else{
                echo "ERROR: La cama no se pudo crear<br>";
            }
        }
        $_SESSION['habitacion'] = "";
        echo "<a href= 'camas.php?habitacion=$habitacion' >Volver al listado</a>";
    ?>
    
</body>
</html>