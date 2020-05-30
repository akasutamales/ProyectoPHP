<?php

    class Cama{

        private $id;
        private $disponible;
        private $codigo;

        /**
         * Class constructor.
         */
        public function __construct($id, $codigo, $disponible)
        {
            $this->id = $id;
            $this->codigo = $codigo;
            $this->disponible = $disponible;
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

        public function toString(){
            $datos = "";
            $datos.= "ID: ". $this->id."<br>";
            $datos.= "Disponible: ". $this->disponible."<br>";
            $datos.= "Codigo: ". $this->codigo."<br>";

            return $datos;
        }

    }
?>