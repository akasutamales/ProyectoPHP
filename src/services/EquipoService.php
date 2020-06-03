<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Equipo.php';

    class EquipoService{

        public function getAll(){
            
            $equipos = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Equipos");

            while( $fila = mysqli_fetch_array($resultado) ){
                $equipo = new Equipo($fila['id'],$fila['codigo'],$fila['disponibles'],$fila['asignados']);
                //array_push( arreglo, item a insertar ); 
                array_push($equipos, $equipo);
            }
            
            $db->close();
            
            return $equipos;
        }

        public function findByCodigo($codigo){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Equipos WHERE codigo='$codigo' ");
            $equipo = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $equipo = new Equipo($fila['id'],$fila['codigo'],$fila['disponibles'],$fila['asignados']);    
            }
            $db->close();

            return $equipo;
        }

        public function findById($id){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Equipos WHERE id=$id ");
            $equipo = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $equipo = new Equipo($fila['id'],$fila['codigo'],$fila['disponibles'],$fila['asignados']);
            }
            $db->close();

            return $equipo;
        }

        public function getDisponibles(){
            
            $equipos = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Equipos WHERE disponibles > 0");

            while( $fila = mysqli_fetch_array($resultado) ){
                $equipo = new Equipo($fila['id'],$fila['codigo'],$fila['disponibles'],$fila['asignados']);
                //array_push( arreglo, item a insertar ); 
                array_push($equipos, $equipo);
            }
            
            $db->close();
            
            return $equipos;
        }

        public function create($codigo,$disponibles,$asignados){
        
            $sql = "INSERT INTO Equipos(codigo, disponibles, asignados) 
            values ('$codigo',$disponibles,$asignados)";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id,$codigo,$disponibles,$asignados){
           
            $sql = "UPDATE Equipos
                    SET disponibles = $disponibles, codigo = '$codigo', asignados = $asignados
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