<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Solicitud.php';
    include_once dirname(__DIR__).'../services/PacienteService.php';
    include_once dirname(__DIR__).'../services/EquipoService.php';

    class SolicitudService{

        public function getAll(){
            
            $solicitudes = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Solicitudes");

            while( $fila = mysqli_fetch_array($resultado) ){
                $solicitud = new Solicitud($fila['id'],$fila['cantidad'],$fila['medico_id'],$fila['equipo_id'],$fila['aprobado'],$fila['paciente_id'],$fila['fecha']);
                //array_push( arreglo, item a insertar ); 
                array_push($solicitudes, $solicitud);
            }
            
            $db->close();
            
            return $solicitudes;
        }
        
        public function getAllByEquipo($id_equipo){
            
            $solicitudes = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Solicitudes WHERE equipo_id=$id_equipo AND aprobado=1");

            while( $fila = mysqli_fetch_array($resultado) ){
                $solicitud = new Solicitud($fila['id'],$fila['cantidad'],$fila['medico_id'],$fila['equipo_id'],$fila['aprobado'],$fila['paciente_id'],$fila['fecha']);
                //array_push( arreglo, item a insertar ); 
                array_push($solicitudes, $solicitud);
            }
            
            $db->close();
            
            return $solicitudes;
        }
        
        public function getAllByPaciente($id_paciente){
            
            $solicitudes = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Solicitudes WHERE paciente_id=$id_paciente");

            while( $fila = mysqli_fetch_array($resultado) ){
                $solicitud = new Solicitud($fila['id'],$fila['cantidad'],$fila['medico_id'],$fila['equipo_id'],$fila['aprobado'],$fila['paciente_id'],$fila['fecha']);
                //array_push( arreglo, item a insertar ); 
                array_push($solicitudes, $solicitud);
            }
            
            $db->close();
            
            return $solicitudes;
        }

        public function findById($id){
            $db = new DB();
            
            $db->connect();
            $resultado = $db->query("SELECT * FROM Solicitudes WHERE id=$id");
            $solicitud = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $solicitud = new Solicitud($fila['id'],$fila['cantidad'],$fila['medico_id'],$fila['equipo_id'],$fila['aprobado'],$fila['paciente_id'],$fila['fecha']);
            }
            $db->close();

            return $solicitud;
        }
        
        public function create($cantidad, $medico_id, $equipo_id, $aprobado, $paciente_id,$fecha){
        
            $sql = "INSERT INTO Solicitudes(cantidad, medico_id, equipo_id, aprobado, paciente_id, fecha) 
            values ('$cantidad','$medico_id','$equipo_id',$aprobado,'$paciente_id','$fecha')";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id,$cantidad,$aprobado){
           
            $sql = "UPDATE Solicitudes
                    SET cantidad = '$cantidad', aprobado = $aprobado
                    WHERE id = $id; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

        public function delete($id){
            $sql = "DELETE FROM Solicitudes where id=$id;";
            
            $db = new DB();
            
            $db->connect();

            $exito = $db->query($sql);

            $db->close();

            return $exito;
        }

        public function getCantidadEquipos($pacienteId){
            $cantidad = 0;
            $solicitudes = $this->getAllByPaciente($pacienteId); 
            foreach ($solicitudes as $i => $solicitud) {
                $cantidad += $solicitud->getCantidad();
            }

            return $cantidad;
        }

        public function getCantidadEquiposAprobados($pacienteId){
            $cantidad = 0;
            $solicitudes = $this->getAllByPaciente($pacienteId); 
            foreach ($solicitudes as $i => $solicitud) {
                if( $solicitud->isAprobado() == 1){
                    $cantidad += $solicitud->getCantidad();
                }
            }

            return $cantidad;
        }

        public function solicitar($equipo,$cantidad,$pacienteId,$medico_id,$fecha){
            $equipoService = new EquipoService();
            $equipo = $equipoService->findByCodigo($equipo);
            $exito = true;
            $pacienteService = new PacienteService();
            $paciente = $pacienteService->findById($pacienteId); 
            $nuevaCantidad = $cantidad + $this->getCantidadEquipos($pacienteId);
            
            if( $paciente === null){
                $exito = false;
                
            }else{
                if( $equipo === null){
                    $exito = false;
                }else{
                        $maxEquipos = $this->maxEquipos($pacienteId);
                        $exito = $maxEquipos >= $nuevaCantidad;
                    }
                    if( !$exito ){
                        echo "No se pueden asignar los equipos al paciente<br>";
                        echo "La prioridad del paciente es: ". $paciente->getPrioridad() . "<br>";
                    }else if($equipo->getDisponibles() < $cantidad) {
                        echo "No hay suficientes equipos disponibles<br>";
                        echo "La cantidad disponible de ". $equipo->getCodigo() . " es " . $equipo->getDisponibles() . ".<br>";
                        $exito = false;
                    }
                }
            

            if( $exito ){
                $this->create($cantidad,$medico_id,$equipo->getId(),0,$pacienteId, $fecha );
                //enviar mensaje
            }
            return $exito;
        }

        public function aprobarSolicitud($solicitud){
            $equipoService = new EquipoService();
            $equipo = $equipoService->findById($solicitud->getEquipo());
            $resultado['exito'] = true;
            
            $resultado['asignados'] = 0;
            $cantidadDisponibles = 0;
            $cantidadAsignados = 0;
                

            if( $equipo === null){
                $resultado['exito'] = false;
            }else{
                $cantidadDisponibles = $equipo->getDisponibles();
                $cantidadAsignados = $equipo->getAsignados();
                $resultado['asignados'] = $solicitud->getCantidad();
                $cantidadAsignados += $resultado['asignados'];
                $cantidadDisponibles -= $resultado['asignados'];
            }

            if( $resultado['exito'] ){
                $resultado['exito'] = $equipoService->update($equipo->getId(),$equipo->getCodigo(),$cantidadDisponibles,$cantidadAsignados);
                $resultado['exito'] = $this->update($solicitud->getId(),$solicitud->getCantidad(), 1);
            }


            return $resultado;
        }

        public function maxEquipos($pacienteId){
            $max = -1;
            $pacienteService = new PacienteService();
            $paciente = $pacienteService->findById($pacienteId); 
            $prioridad = strtolower ( $paciente->getPrioridad() );
            switch ($prioridad) {
                case 'alta':
                    $max = 3;
                    break;
                case 'media':
                    $max = 2;
                    break;
                case 'baja':
                    $max = 1;
                    break;
                
                default:
                    echo "La prioridad del paciente es errónea";
                    break;
            }
            return $max;
        }

        public function cambiarAsignacion($pacienteOrigen, $pacienteDestino, $equipo_id, $cantidad){
            $pacienteService = new PacienteService();
            
            $origen = $pacienteService->findById($pacienteOrigen);
            $destino = $pacienteService->findById($pacienteDestino);
            
            $exito = true;
            
            //Si el paciente de destino tiene menor prioridad que el paciente de origen, se rechaza la solicitud
            if( $this->maxEquipos($pacienteDestino) < $this->maxEquipos($pacienteOrigen)  ){
                $exito = false;
                echo "La prioridad del paciente de destino es inferior a la del paciente de origen<br>";
                echo "Prioridad origen: " . $origen->getPrioridad() . "<br>";
                echo "Prioridad destino: " . $destino->getPrioridad() . "<br>";
            }

            $numEquipos = $this->getCantidadEquiposAprobados($pacienteOrigen);
            //Si el paciente de origen tiene menos equipos aprobados de los requeridos, se rechaza la solicitud
            if( $exito && $numEquipos < $cantidad ){
                $exito = false;
                echo "El paciente de origen no tiene suficientes equipos<br>";
                echo "La cantidad máxima a reasignar es: ". $numEquipos . "<br>";
            }
            $numEquipos = $this->getCantidadEquipos($pacienteDestino);
            //Si el paciente de destino excede el máximo de equipos permitidos, se rechaza la solicitud
            $maxEquipos = $this->maxEquipos($pacienteDestino);
            if( $exito && $numEquipos > $maxEquipos ){
                $exito = false;
                echo "No se pueden asignar tantos equipos al paciente de destino<br>";
                echo "Los datos del paciente de destino son:<br>";
                echo "Prioridad: " . $destino->getPrioridad() . "<br>";
                echo "Equipos <br>Solicitados: " . $numEquipos . ", Máximo: " . $maxEquipos . " <br>";
            }

            if( $exito ){
                $solicitudesOrigen = $this->getAllByPaciente($pacienteOrigen);
                $cantidadRestante = $cantidad;
                foreach ($solicitudesOrigen as $i => $solicitud) {
                    if( $cantidadRestante == 0)
                            break;
                    if( $solicitud->isAprobado() == 1){

                        if($cantidadRestante >= $solicitud->getCantidad()){
                            $cantidadRestante -= $solicitud->getCantidad();
                            $this->update($solicitud->getId(),0,$solicitud->isAprobado());
                        }else{
                            $this->update($solicitud->getId(), $solicitud->getCantidad()-$cantidadRestante,$solicitud->isAprobado());
                            $cantidadRestante = 0;
                        }
                    }
                }
                
                date_default_timezone_set('America/Bogota');
                $fecha = date('m/d/Y h:i:s a', time());
                
                $this->create($cantidad,$destino->getIdMedico(),$equipo_id,1,$pacienteDestino,$fecha);
            }
            return $exito;
        }

    }
?>