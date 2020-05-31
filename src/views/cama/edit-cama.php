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
            $id_cama = $params['cama'];
            $cama = $camaService->findById($id_cama);
        ?>
    <form method="POST" action="<?=$_SERVER['PHP_SELF']."?cama=". $cama->getId() ?>" >
        Codigo: <input type="text" name="codigo" value="<?php echo $cama->getCodigo()?>">
        Disponible: <input type="text" name="disponible" value="<?php echo $cama->getDisponible()?>" >
        <input type="submit" name="btn" value="update">
        <input type="submit" name="btn" value="delete">
    </form>

    <?php

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if( $_POST['btn'] == "update"){
                    $exito = $camaService->update($cama->getId(),$_POST['disponible'],$_POST['codigo']);
                    if( $exito ){
                        echo "La cama se actualizo de forma exitosa";
                    }else{
                        echo "ERROR: no se pudieron actualizar los datos";
                    }
                }else{
                    $exito = $camaService->delete($id_cama);
                    if( $exito ){
                        echo "La cama se elimino de forma exitosa";
                    }else{
                        echo "ERROR: no se pudieron eliminar los datos";
                    }
                }
            }
        ?>

        <a href="camas.php">Volver al listado</a>

</body>
</html>