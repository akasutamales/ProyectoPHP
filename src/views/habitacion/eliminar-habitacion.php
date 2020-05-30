<?php

    include_once '../../services/CamaService.php';
    include_once '../../services/HabitacionService.php';
    $camaService = new CamaService();
    $habitacionService = new HabitacionService();

    session_start();
    $id_habitacion = $_SESSION['habitacion']; 
    $camas = $camaService->getAll($id_habitacion);

    if( count($camas) == 0){
        $exito = $habitacionService->delete($id_habitacion);
        if( $exito ){
            echo "La habitacion se elimino correctamente<br>";
        }else{
            echo "ERROR: No se pudo eliminar la habitación<br>";
        }
    }else{
        echo "No se puede eliminar una habitación con camas asignadas<br>";
    }

?>

<a href="habitaciones.php">Volver al listado</a>