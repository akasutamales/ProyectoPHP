<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Paciente.php';

    class PacienteService{

        public function getAll(){
            
            $pacientes = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Pacientes");

            while( $fila = mysqli_fetch_array($resultado) ){
                $paciente = new Paciente($fila['id'],$fila['cedula'],$fila['nombre'],$fila['diagnostico'],$fila['prioridad'],$fila['fecha_ingreso'],$fila['estadia'],$fila['medico_id'],$fila['cama_id']); 
                array_push($pacientes, $paciente);
            }
            
            $db->close();
            
            return $pacientes;
        }

        public function getAll2($id){
            
            $pacientes = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Pacientes WHERE medico_id = $id ");

            while( $fila = mysqli_fetch_array($resultado) ){
                $paciente = new Paciente($fila['id'],$fila['cedula'],$fila['nombre'],$fila['diagnostico'],$fila['prioridad'],$fila['fecha_ingreso'],$fila['estadia'],$fila['medico_id'],$fila['cama_id']); 
                array_push($pacientes, $paciente);
            }
            
            $db->close();
            
            return $pacientes;
        }

        public function findById($id){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Pacientes WHERE id=$id");
            $paciente = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $paciente = new Paciente($fila['id'],$fila['cedula'],$fila['nombre'],$fila['diagnostico'],$fila['prioridad'],$fila['fecha_ingreso'],$fila['estadia'],$fila['medico_id'],$fila['cama_id']); 
            }
            $db->close();

            return $paciente;
        }

        public function create($cedula,$nombre,$diagnostico,$prioridad,$fecha_ingreso,$estadia,$medico_id,$cama_id){
        
            $sql = "INSERT INTO Pacientes(cedula,nombre,diagnostico,prioridad,fecha_ingreso,estadia,medico_id,cama_id) 
            values ('$cedula','$nombre','$diagnostico,'$prioridad',$fecha_ingreso,$estadia,$medico_id,$cama_id)";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id,$cedula,$nombre,$diagnostico,$prioridad,$fecha_ingreso,$estadia,$medico_id,$cama_id){
           
            $sql = "UPDATE Pacientes
                    SET cedula = '$cedula', nombre = '$nombre', diagnostico = '$diagnostico', prioridad = '$prioridad', fecha_ingreso = $fecha_ingreso, estadia = $estadia, medico_id = $medico_id, cama_id = $cama_id 
                    WHERE id = $id; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }
        public function delete($id){
            $sql = "DELETE FROM Pacientes where id=$id;";
            
            $db = new DB();          
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

    }
?>