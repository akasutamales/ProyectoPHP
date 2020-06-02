<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Solicitud.php';

    class CamaService{

        public function getAll(){
            
            $solicitudes = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Solicitudes");

            while( $fila = mysqli_fetch_array($resultado) ){
                $solicitud = new Solicitud($fila['id'],$fila['cantidad'],$fila['medico_id'],$fila['equipo_id'],$fila['aprobado'],$fila['paciente_id']);
                //array_push( arreglo, item a insertar ); 
                array_push($solicitudes, $solicitud);
            }
            
            $db->close();
            
            return $solicitudes;
        }

        public function findById($id){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Solicitudes WHERE id=$id ");
            $solicitud = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $solicitud = new Solicitud($fila['id'],$fila['cantidad'],$fila['medico_id'],$fila['solici$solicitudequipo_id'],$fila['aprobado'],$fila['paciente_id']);    
            }
            $db->close();

            return $solicitud;
        }
        
        public function create($cantidad, $medico_id, $equipo_id, $aprobado, $paciente_id){
        
            $sql = "INSERT INTO Solicitudes(cantidad, medico_id, equipo_id, aprobado, paciente_id) 
            values ('$cantidad','$medico_id','$equipo_id','$aprobado','$paciente_id')";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id,$cantidad,$aprobado){
           
            $sql = "UPDATE Solicitudes
                    SET cantidad = '$cantidad', aprobado = '$aprobado'
                    WHERE id = $id; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

    }
?>