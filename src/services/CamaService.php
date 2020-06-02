<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Cama.php';

    class CamaService{

        public function getAll($id_habitacion){
            
            $camas = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Camas WHERE habitacion_id = $id_habitacion ");

            while( $fila = mysqli_fetch_array($resultado) ){
                $cama = new Cama($fila['id'],$fila['codigo'],$fila['disponible'],$fila['habitacion_id']);
                //array_push( arreglo, item a insertar ); 
                array_push($camas, $cama);
            }
            
            $db->close();
            
            return $camas;
        }
        
        public function getDisponibles($id_habitacion){
            
            $camas = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Camas WHERE habitacion_id = $id_habitacion AND disponible=1 ");

            while( $fila = mysqli_fetch_array($resultado) ){
                $cama = new Cama($fila['id'],$fila['codigo'],$fila['disponible'],$fila['habitacion_id']);
                //array_push( arreglo, item a insertar ); 
                array_push($camas, $cama);
            }
            
            $db->close();
            
            return $camas;
        }

        public function findByCodigo($codigo){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Camas WHERE codigo='$codigo' ");
            $cama = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $cama = new Cama($fila['id'],$fila['codigo'],$fila['disponible'],$fila['habitacion_id']);
            }
            $db->close();

            return $cama;
        }

        public function findById($id){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Camas WHERE id=$id ");
            $cama = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $cama = new Cama($fila['id'],$fila['codigo'],$fila['disponible'],$fila['habitacion_id']);
            }
            $db->close();

            return $cama;
        }

        public function create($disponible,$codigo,$habitacion_id){
        
            $sql = "INSERT INTO Camas(disponible, codigo, habitacion_id) 
            values ('$disponible','$codigo','$habitacion_id')";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id,$disponible,$codigo){
           
            $sql = "UPDATE Camas
                    SET disponible = $disponible, codigo = '$codigo'
                    WHERE id = $id; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }
        public function delete($id){
            $sql = "DELETE FROM Camas where id=$id;";
            
            $db = new DB();          
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

    }
?>