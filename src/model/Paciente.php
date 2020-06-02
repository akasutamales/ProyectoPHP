<?php

    class Paciente{

        private $id;
        private $cedula;
        private $nombre;
        private $diagnostico;
        private $prioridad;
        private $fecha_ingreso;
        private $estadia;
        private $medico_id;
        private $cama_id;


        /**
         * Class constructor.
         */
        public function __construct($id,$cedula,$nombre,$diagnostico,$prioridad,$fecha_ingreso,$estadia,$medico_id,$cama_id)
        {
            $this->id = $id;
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->diagnostico = $diagnostico;
            $this->prioridad = $prioridad;
            $this->fecha_ingreso = $fecha_ingreso;
            $this->estadia = $estadia;
            $this->medico_id = $medico_id;
            $this->cama_id = $cama_id;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getCedula(){
            return $this->cedula;
        }
        
        public function setCedula($cedula){
            $this->cedula = $cedula;
        }

        public function getNombre(){
            return $this->nombre;
        }
        
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
       
        public function getDiagnostico(){
            return $this->diagnostico;
        }
        
        public function setDiagnostico($diagnostico){
            $this->diagnostico = $diagnostico;
        }
        public function getPrioridad(){
            return $this->prioridad;
        }
        
        public function setPrioridad($prioridad){
            $this->prioridad = $prioridad;
        }

        public function getFechaIngreso(){
            return $this->fecha_ingreso;
        }
        
        public function setFechaIngreso($fecha_ingreso){
            $this->fecha_ingreso = $fecha_ingreso;
        }

        public function getEstadia(){
            return $this->estadia;
        }
        
        public function setEstadia($estadia){
            $this->estadia = $estadia;
        }
        
        public function getIdMedico(){
            return $this->medico_id;
        }
        
        public function setIdMedico($medico_id){
            $this->medico_id = $medico_id;
        }

        public function getIdCama(){
            return $this->cama_id;
        }
        
        public function setIdCama($cama_id){
            $this->cama_id = $cama_id;
        }

        public function toString(){
            $datos = "";
            $datos.= "ID: ". $this->id."<br>";
            $datos.= "Cedula: ". $this->cedula."<br>";
            $datos.= "Nombre: ". $this->nombre."<br>";
            $datos.= "Diagnostico: ". $this->diagnostico."<br>";
            $datos.= "Prioridad: ". $this->prioridad."<br>";
            $datos.= "Fecha Ingreso: ". $this->fecha_ingreso."<br>";
            $datos.= "Estadia: ". $this->estada."<br>";
            $datos.= "Medico Asignado: ". $this->medico_id."<br>";
            $datos.= "Cama Asignada: ". $this->cama_id."<br>";

            return $datos;
        }

    }
?>