<?php

    class Equipo{

        private $id;
        private $disponibles;
        private $asignados;
        private $codigo;

        /**
         * Class constructor.
         */
        public function __construct($id, $codigo, $disponibles, $asignados)
        {
            $this->id = $id;
            $this->codigo = $codigo;
            $this->disponibles = $disponibles;
            $this->asignados = $asignados;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getCodigo(){
            return $this->codigo;
        }
        
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function getDisponibles(){
            return $this->disponibles;
        }
        
        public function setDisponibles($disponibles){
            $this->disponibles = $disponibles;
        }
       
        public function getAsignados(){
            return $this->asignados;
        }
        
        public function setAsignados($asignados){
            $this->asignados = $asignados;
        }
       

        public function toString(){
            $datos = "";
            $datos.= "ID: ". $this->id."<br>";
            $datos.= "Codigo: ". $this->codigo."<br>";
            $datos.= "Disponibles: ". $this->disponibles."<br>";
            $datos.= "Asignados: ". $this->asignados."<br>";

            return $datos;
        }

    }
?>