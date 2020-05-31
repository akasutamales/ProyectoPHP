<?php

    class Equipo{

        private $id;
        private $cantidad;
        private $codigo;

        /**
         * Class constructor.
         */
        public function __construct($id, $codigo, $cantidad)
        {
            $this->id = $id;
            $this->codigo = $codigo;
            $this->cantidad = $cantidad;
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

        public function getCantidad(){
            return $this->cantidad;
        }
        
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
       

        public function toString(){
            $datos = "";
            $datos.= "ID: ". $this->id."<br>";
            $datos.= "Codigo: ". $this->codigo."<br>";
            $datos.= "Cantidad: ". $this->cantidad."<br>";

            return $datos;
        }

    }
?>