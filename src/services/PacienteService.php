<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Paciente.php';
    include_once dirname(__DIR__).'../services/CamaService.php';

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
        
        public function findByCedula($cedula){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Pacientes WHERE cedula=$cedula");
            $paciente = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $paciente = new Paciente($fila['id'],$fila['cedula'],$fila['nombre'],$fila['diagnostico'],$fila['prioridad'],$fila['fecha_ingreso'],$fila['estadia'],$fila['medico_id'],$fila['cama_id']); 
            }
            $db->close();

            return $paciente;
        }

        public function create($cedula,$nombre,$diagnostico,$prioridad,$fecha_ingreso,$estadia,$medico_id,$cama_id){
            
            $exito = true;
            $sql = "INSERT INTO Pacientes(cedula,nombre,diagnostico,prioridad,fecha_ingreso,estadia,medico_id,cama_id) 
            values ('$cedula','$nombre','$diagnostico','$prioridad','$fecha_ingreso' ,$estadia,$medico_id,$cama_id)";

            $camaService = new CamaService();
            $cama = $camaService->findById($cama_id); 
            if( $cama === null)
                $exito = false;
            else{
                $exito = $camaService->update($cama->getId(),0,$cama->getCodigo());
            }
            if( $exito ){

                $db = new DB();
                $db->connect();
                $exito = $db->query($sql);
                $db->close();
                
            }
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