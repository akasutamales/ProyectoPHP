<?php

    include_once '../logic/UsuarioLogica.php';
    $usuarioLogica = new UsuarioLogica();
    $str_datos = "";

    
    if( $usuarioLogica->login($_POST['usuario'],$_POST['contrasenia']) ){
        $str_datos.="Credenciales correctas";
        $usuario = $usuarioLogica->findByUsername($_POST['usuario']);

        session_start();
        if(isset($_SESSION['user'])){
                $_SESSION['user']= $usuario->getUsuario();
        }
        else{
            $_SESSION['user']= $usuario->getUsuario();
        }


        if( $usuario->getRol() == 'admin'){
            header("Location: listado.php");
        }else{
            header("Location: perfil.php");
        }

    }else{
        $str_datos.="Credenciales incorrectas";
    }

    echo $str_datos;
?>