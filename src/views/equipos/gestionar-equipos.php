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
    <link rel="stylesheet" href="../../resources/barra-navegacion.css">

</head>
<body>
<div class="topnav">
        <a href="../administrador/centro-mensajes.php">Centro de mensajes</a>
        <a href="../usuario/listado.php">Gestionar usuarios</a>
        <a href="../habitacion/habitaciones.php">Gestionar habitaciones</a>
        <a href="../paciente/pacientes.php">Gestionar pacientes</a>
        <a href="../recurso/gestionar.php">Gestionar recursos</a>
        <a class="active" href="../equipos/gestionar-equipos.php">Gestionar equipos</a>
        <a href="../usuario/logout.php" >Cerrar sesion</a>
</div>
    <h1>Listado de equipos</h1>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Código</th>
                <th>Disponibles</th>
                <th>Asignados</th>
                <th></th>
            </tr>
        </thead>

        <form method="POST" action="<?= $_SERVER['PHP_SELF']?>">
            Código: <input type="text" name="codigo">
            Cantidad: <input type="text" name="cantidad">
            <input type="submit" value="Agregar equipos">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $equipo = $equipoService->findByCodigo($_POST['codigo']);
                if($equipo === null){
                    $exito = $equipoService->create($_POST['codigo'],$_POST['cantidad'],0);
                }else{
                    $disponibles = $equipo->getDisponibles() + $_POST['cantidad'];
                    $exito = $equipoService->update($equipo->getId(),$_POST['codigo'],$disponibles, $equipo->getAsignados()); 
                }
                if( $exito ){
                    echo "<br> El equipo fue agregado de forma exitosa.<br>";
                }else{
                    echo "<br> ERROR: No se pudo agregar el equipo.<br>";
                }
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
                    if( $equipo->getAsignados() > 0)
                        $str_datos.="<td> <a href='cambiar-asignacion.php?equipo=".$equipo->getId()."'>Cambiar asignación</a></td>";
                    $str_datos.="</tr>";
                }
                echo $str_datos;
            ?>
        </tbody>
    </table>
</body>
</html>