<?php

    class Recurso{

        private $id;
        private $nombre;
        private $unidad_medida;
        private $cantidad;

        /**
         * Class constructor.
         */
        public function __construct($id, $nombre, $unidad_medida,$cantidad)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->unidad_medida = $unidad_medida;
            $this->cantidad = $cantidad;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNombre(){
            return $this->nombre;
        }
        
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getUnidades(){
            return $this->unidad_medida;
        }
        
        public function setUnidades($unidad_medida){
            $this->unidad_medida = $unidad_medida;
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
            $datos.= "Nombre: ". $this->nombre."<br>";
            $datos.= "Unidad Medida: ". $this->unidad_medida."<br>";
            $datos.= "Cantidad: ".$this->cantidad."<br>"; 

            return $datos;
        }

    }
?>