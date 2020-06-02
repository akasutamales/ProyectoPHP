<?php
    include_once dirname(__DIR__) . '../model/DB.php';
    include_once dirname(__DIR__) . '../model/Usuario.php';

    class UsuarioService{

        public function getAll(){
            $db = new DB();

            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Usuarios");
            $usuarios = [];
                    
            while( $fila = mysqli_fetch_array($resultado) ){
                    $usuario = new Usuario($fila['usuario'],$fila['rol'],$fila['contrasenia'],$fila['email'], $fila['nombre']);
                    array_push( $usuarios, $usuario);
            }

            $db->close();

            return $usuarios;
        }

        public function login($nombreUsuario, $contrasenia){
            
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Usuarios WHERE usuario='$nombreUsuario'; ");
            $usuario = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $usuario = new Usuario($fila['usuario'],$fila['rol'],$fila['contrasenia'],$fila['email'], $fila['nombre']);
            }
            
            $db->close();

            $exito = false;
            
            if( $usuario != null ){
                
                $hash = $usuario->getContrasenia();
                $exito = hash_equals($hash, crypt($contrasenia, $hash)) ;
            }else{
                echo "No existe el usuario " . $nombreUsuario . "<br> ";
            }

            return $exito;
                
        }

        public function findByUsername($nombreUsuario){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Usuarios WHERE usuario='$nombreUsuario'");
            $usuario = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $usuario = new Usuario($fila['usuario'],$fila['rol'],$fila['contrasenia'],$fila['email'], $fila['nombre']);
            }
            $db->close();

            return $usuario;
        }


        public function register($usuario,$rol,$contrasenia,$email, $nombre){

            $user = $this->findByUsername($usuario);
            
            $exito = true;

            if( $user != null){
                echo "El nombre de usuario esta duplicado<br>";
                $exito = false;
            } 
            

            if (CRYPT_SHA512 == 1)
            {
                $contrasenia = crypt($contrasenia,'$6$rounds=5000$unsaltcheveredeejemplo$');
            }else{
                echo "Error cifrando la contraseña<br>";
                $exito = false;
            }
            
            if( $exito ){
                $sql = "INSERT INTO Usuarios(usuario, rol, contrasenia , email, nombre) 
                values ('$usuario','$rol', '$contrasenia','$email', '$nombre')";
    
                $db = new DB();            
                $db->connect();
                $exito = $db->query($sql);
                $db->close();
            }
            
            return $exito;
        }

        public function update($user,$rol){
           
            $sql = "UPDATE Usuarios
                    SET rol = '$rol'
                    WHERE usuario = '$user'; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }

        public function delete($user){
            $sql = "DELETE FROM Usuarios where usuario='$user';";
            
            $db = new DB();
            
            $db->connect();

            $exito = $db->query($sql);

            $db->close();

            return $exito;
        }


        
    } 

    
    // $persona = new Persona("123","Daniel","Beltran", "dan@gmail.com", 21);
?>