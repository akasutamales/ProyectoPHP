<?php
    include_once '../model/DB.php';
    include_once '../model/Habitacion.php';

    class HabitacionService{

        public function getAll(){
            
            $habitaciones = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Habitaciones");

            while( $fila = mysqli_fetch_array($resultado) ){
                $habitacion = new Habitacion($fila['id'],$fila['codigo'],[]); 
                array_push($habitaciones, $habitacion);
            }
            
            $db->close();
            
            return $habitaciones;
        }
    }
?>