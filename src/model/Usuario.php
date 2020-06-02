<?php

    class Usuario{

        private $usuario;
        private $rol;
        private $contrasenia;
        private $email;
        private $nombre;
        
        public function __construct($usuario, $rol, $contrasenia, $email , $nombre){
            $this->usuario = $usuario;
            $this->rol = $rol;
            $this->contrasenia = $contrasenia;
            $this->email = $email;
            $this->nombre = $nombre;
        }
        
        public function getEmail(){
            return $this->email;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function getRol(){
            return $this->rol;
        }

        public function getContrasenia(){
            return $this->contrasenia;
        }
        
        public function getNombre(){
            return $this->nombre;
        }

        public function toString(){

            $str_datos = "";
            $str_datos.="Nombre: ".$this->getNombre()."<br>";
            $str_datos.="Usuario: ".$this->getUsuario()."<br>";
            $str_datos.="Rol: ".$this->getRol()."<br>";
            $str_datos.="Correo: ".$this->getEmail()."<br>";
            return $str_datos;
        }


    }	
    // $persona = new Persona("123","Daniel","Beltran", "dan@gmail.com", 21);
    
?>
