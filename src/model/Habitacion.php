<?php

    class Habitacion{

        private $id;
        private $codigo;
        private $camas;

        /**
         * Class constructor.
         */
        public function __construct($id, $codigo, $camas)
        {
            $this->id = $id;
            $this->codigo = $codigo;
            $this->camas = $camas;
        }

        public function listadoCamasToString(){
            $listado = '';
            foreach ($this->camas as $i => $cama) {
                $listado.="$cama ";
            }
            return $listado;
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

        public function getCamas(){
            return $this->camas;
        }
        
        public function setCamas($camas){
            $this->camas = $camas;
        }
    }
?>