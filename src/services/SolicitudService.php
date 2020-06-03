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
            values ('$cantidad','$medico_id','$equipo_id','$aprobado','$paciente_id','$fecha')";

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

        public function getCantidadEquipos($pacienteId){
            $cantidad = 0;
            $sql = "SELECT * FROM Solicitudes WHERE paciente_id=$pacienteId";
            
            $db = new DB();
            $db->connect();
            $resultado = $db->query($sql);
            $solicitudes = [];
            while( $fila = mysqli_fetch_array($resultado) ){
                $solicitud = new Solicitud($fila['id'],$fila['cantidad'],$fila['medico_id'],$fila['equipo_id'],$fila['aprobado'],$fila['paciente_id'],$fila['fecha']);
                //array_push( arreglo, item a insertar ); 
                array_push($solicitudes, $solicitud);
            }
            
            $db->close();
            foreach ($solicitudes as $i => $solicitud) {
                $cantidad += $solicitud->getCantidad();
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
                    $prioridad = strtolower ( $paciente->getPrioridad() );
                    switch ($prioridad) {
                        case 'alta':
                            $exito = $nuevaCantidad <= 3;
                            break;
                        case 'media':
                            $exito = $nuevaCantidad <= 2;
                            break;
                        case 'baja':
                            $exito = $nuevaCantidad <= 1;
                            break;
                        
                        default:
                            $exito = false;
                            echo "La prioridad del paciente es errónea";
                            break;
                    }
                    if( !$exito ){
                        echo "No se pueden asignar más equipos al paciente<br>";
                        echo "La prioridad del paciente es: ". $prioridad . "<br>";
                    }
                }
            }

            if( $exito ){
                $this->create($cantidad,$medico_id,$equipo->getId(),0,$pacienteId, $fecha );
                //enviar correo
            }
            return $exito;
        }

        public function aprobarSolicitud($solicitud){
            $equipoService = new EquipoService();
            $equipo = $equipoService->findById($solicitud->getEquipo());
            $resultado['exito'] = true;
            
            $resultado['asignados'] = 0;
            $resultado['no_asignados'] = 0;
            $cantidadDisponibles = 0;
            $cantidadAsignados = 0;
                

            if( $equipo === null){
                $resultado['exito'] = false;
            }else{
                $cantidadDisponibles = $equipo->getDisponibles();
                $cantidadAsignados = $equipo->getAsignados();
                if( $cantidadDisponibles >= $solicitud->getCantidad() ){
                    $resultado['asignados'] = $solicitud->getCantidad();
                }else{
                    $resultado['asignados'] = $solicitud->getCantidad() - $cantidadDisponibles;
                }
                $resultado['no_asignados'] = $solicitud->getCantidad() - $resultado['asignados'];
                $cantidadAsignados += $resultado['asignados'];
                $cantidadDisponibles -= $resultado['asignados'];
            }

            if( $resultado['exito'] ){
                $resultado['exito'] = $equipoService->update($equipo->getId(),$equipo->getCodigo(),$cantidadDisponibles,$cantidadAsignados);
            }

            return $resultado;
        }

    }
?>