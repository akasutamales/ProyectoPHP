<?php

    class Cama{

        private $id;
        private $disponible;
        private $codigo;
        private $id_habitacion;

        /**
         * Class constructor.
         */
        public function __construct($id, $codigo, $disponible,$id_habitacion)
        {
            $this->id = $id;
            $this->codigo = $codigo;
            $this->disponible = $disponible;
            $this->id_habitacion = $id_habitacion;
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

        public function getDisponible(){
            return $this->disponible;
        }
        
        public function setDispopnible($disponible){
            $this->disponible = $disponible;
        }
       
        public function getIdHabitacion(){
            return $this->id_habitacion;
        }
        
        public function setIdHabitacion($id_habitacion){
            $this->id_habitacion = $id_habitacion;
        }

        public function toString(){
            $datos = "";
            $datos.= "ID: ". $this->id."<br>";
            $datos.= "Disponible: ". $this->disponible."<br>";
            $datos.= "Codigo: ". $this->codigo."<br>";

            return $datos;
        }

    }
?>