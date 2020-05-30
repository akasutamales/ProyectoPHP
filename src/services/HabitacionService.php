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

        public function create($cedula,$nombre,$apellido,$correo,$edad){
        
            $sql = "INSERT INTO Personas(Cedula, Nombre, Apellido ,Correo, Edad) 
            values ('$cedula','$nombre','$apellido', '$correo',$edad)";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($cedula,$nombre,$apellido,$correo,$edad){
           
            $sql = "UPDATE Personas
                    SET Nombre = '$nombre', Apellido = '$apellido', Correo = '$correo', Edad = $edad
                    WHERE Cedula = '$cedula'; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }
        public function delete($cedula){
            $sql = "DELETE FROM Personas where Cedula='$cedula';";
            
            $db = new DB();          
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

    }
?>