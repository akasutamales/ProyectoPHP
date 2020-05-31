<?php

    class Habitacion{

        private $id;
        private $codigo;

        /**
         * Class constructor.
         */
        public function __construct($id, $codigo)
        {
            $this->id = $id;
            $this->codigo = $codigo;
        }

        public function listadoCamasToString($camas){
            $listado = '';
            foreach ($camas as $i => $cama) {
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
    }
?>