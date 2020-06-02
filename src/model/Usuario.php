<?php

    class Usuario{

        private $usuario;
        private $rol;
        private $contrasenia;
        private $email;
        
        public function __construct($usuario, $rol, $contrasenia, $email ){
            $this->usuario = $usuario;
            $this->rol = $rol;
            $this->contrasenia = $contrasenia;
            $this->email = $email;
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

        public function toString(){

            $str_datos = "";
            $str_datos.="Usuario: ".$this->getUsuario()."<br>";
            $str_datos.="Rol: ".$this->getRol()."<br>";
            $str_datos.="Correo: ".$this->getEmail()."<br>";
            return $str_datos;
        }


    }	
    // $persona = new Persona("123","Daniel","Beltran", "dan@gmail.com", 21);
    
?>
