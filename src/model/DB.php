<?php
    
    include_once dirname(__FILE__).'/../config/config.php';
    class DB{
        
        private $connection;

        public function connect(){
            
            $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS, NOMBRE_DB);
            if( mysqli_connect_errno()){
                throw new Exception ('Error en la conexion: '.mysqli_connect_error());
            }else{
                $this->connection = $con;
            }
        }

        
        /*
        public function selectPersonas($query){
            $this->connect();
            
            $resultado = mysqli_query($this->connection, $query);

            $personas = [];
                    
            while( $fila = mysqli_fetch_array($resultado) ){
                    $persona = new Persona($fila['Cedula'],$fila['Nombre'],$fila['Apellido'],$fila['Correo'],$fila['Edad']);
                    array_push( $personas, $persona);
            }

            $this->close();

            return $personas;
        }
        */

        public function query($sql){
            $this->connect();
            $resultado = mysqli_query($this->connection, $query);
            $this->close();
            return resultado;
        }

        public function close(){
            mysqli_close($this->connection);
        }
            
    }

    // $persona = new Persona("123","Daniel","Beltran", "dan@gmail.com", 21);
    
?>