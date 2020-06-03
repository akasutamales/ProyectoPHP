<?php
    include_once '../../services/RecursoService.php';
    $recursoService = new RecursoService();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de recursos</h1>

    <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        Nombre: <input type="text" name="nombre">
        Cantidad: <input type="number" name="cantidad">
        Unidad de medida: <input type="text" name="unidad">
        <input type="submit" value="Agregar recursos" name="btn"> 
    </form>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $recurso = $recursoService->findByNombre($_POST['nombre']);
            $exito = false;
            if( $recurso !== null){
                $nuevaCantidad = $recurso->getCantidad() + $_POST['cantidad'];
                $exito = $recursoService->update($recurso->getId(),$recurso->getNombre(),$recurso->getUnidades(),$nuevaCantidad);
            }else{
                $exito = $recursoService->create($_POST['nombre'],$_POST['unidad'],$_POST['cantidad']);
            }
            if( $exito ){
                echo "Los recursos fueron agregados de forma exitosa<br>";
            }else{
                echo "<br>ERROR: No se pudieron adicionar los recursos<br>";
            }
        }
    ?>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Unidad de medida</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $recursos = $recursoService->getAll();
            $str_datos = "";
            foreach ($recursos as $i => $r) {
                $str_datos.= "<tr>";
                $str_datos.= "<td>".$r->getNombre()."</td>";
                $str_datos.= "<td>".$r->getCantidad()."</td>";
                $str_datos.= "<td>".$r->getUnidades()."</td>";
                $str_datos.= "</tr>";
            }
            echo $str_datos;
        ?>
        </tbody>
    </table>
</body>
</html>