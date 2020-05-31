<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Equipo.php';

    class CamaService{

        public function getAll(){
            
            $equipos = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Equipos");

            while( $fila = mysqli_fetch_array($resultado) ){
                $equipo = new Equipo($fila['id'],$fila['codigo'],$fila['cantidad']);
                //array_push( arreglo, item a insertar ); 
                array_push($equipos, $equipo);
            }
            
            $db->close();
            
            return $equipos;
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
            $resultado = $db->query("SELECT * FROM Equipos WHERE id=$id ");
            $equipo = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $equipo = new Equipo($fila['id'],$fila['codigo'],$fila['cantidad']);
            }
            $db->close();

            return $equipo;
        }

        public function create($codigo,$cantidad){
        
            $sql = "INSERT INTO Equipos(codigo, cantidad) 
            values ('$codigo','$cantidad')";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id,$cantidad,$codigo){
           
            $sql = "UPDATE Equipos
                    SET cantidad = '$cantidad', codigo = '$codigo'
                    WHERE id = $id; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }
        public function delete($id){
            $sql = "DELETE FROM Equipos where id=$id;";
            
            $db = new DB();          
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

    }
?>