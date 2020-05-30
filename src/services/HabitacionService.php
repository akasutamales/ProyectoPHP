<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Habitacion.php';

    class HabitacionService{

        public function getAll(){
            
            $habitaciones = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Habitaciones");

            while( $fila = mysqli_fetch_array($resultado) ){
                $habitacion = new Habitacion($fila['id'],$fila['codigo']); 
                array_push($habitaciones, $habitacion);
            }
            
            $db->close();
            
            return $habitaciones;
        }

        public function findById($id){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Habitaciones WHERE Id=$id");
            $habitacion = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $habitacion = new Habitacion($fila['id'],$fila['codigo']);
            }
            $db->close();

            return $habitacion;
        }

        public function create($codigo){
        
            $sql = "INSERT INTO Habitaciones(codigo) 
            values ('$codigo')";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id, $codigo){
           
            $sql = "UPDATE Habitaciones
                    SET codigo = '$codigo'
                    WHERE id = $id; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }
        public function delete($id){
            $sql = "DELETE FROM Habitaciones where id=$id;";
            
            $db = new DB();          
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

    }
?>