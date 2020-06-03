<?php

/*cantidad`    int NOT NULL ,
     `medico_id`   int NOT NULL ,
     `equipo_id`   int NOT NULL ,
     `aprobado`    bit NOT NULL ,
     `paciente_id` int NOT NULL ,
*/
    class Solicitud{

        private $id;
        private $cantidad;
        private $medico_id;
        private $equipo_id;
        private $aprobado;
        private $paciente_id;
        private $fecha;

        /**
         * Class constructor.
         */
        public function __construct($id, $cantidad, $medico_id, $equipo_id, $aprobado, $paciente_id, $fecha)
        {
            $this->id = $id;
            $this->cantidad = $cantidad;
            $this->medico_id = $medico_id;
            $this->equipo_id = $equipo_id;
            $this->paciente_id = $paciente_id;
            $this->aprobado = $aprobado;
            $this->fecha = $fecha;

        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getCantidad(){
            return $this->cantidad;
        }
        
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }

        public function getMedico(){
            return $this->medico_id;
        }
        
        public function setMedico($medico_id){
            $this->medico_id = $medico_id;
        }
        public function getEquipo(){
            return $this->equipo_id;
        }
        
        public function setEquipo($equipo_id){
            $this->equipo_id = $equipo_id;
        }

        public function getPaciente(){
            return $this->paciente_id;
        }
        
        public function setPaciente($paciente_id){
            $this->paciente_id = $paciente_id;
        }
        
        public function isAprobado(){
            return $this->aprobado;
        }
        
        public function setAprobado($aprobado){
            $this->aprobado = $aprobado;
        }

        public function getFecha(){
            return $this->fecha;
        }
        
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
       

        public function toString(){
            $datos = "";
            $datos.= "ID: ". $this->id."<br>";
            $datos.= "Equipo: ". $this->equipo_id."<br>";
            $datos.= "Cantidad: ". $this->cantidad."<br>";
            $datos.= "Paciente: ". $this->paciente_id."<br>";
            $datos.= "Medico: ". $this->medico_id."<br>";
            $datos.= "Aprobado: ". $this->aprobado."<br>";

            return $datos;
        }

    }
?>