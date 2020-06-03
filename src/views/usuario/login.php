<?php

    include_once '../../services/UsuarioService.php';
    $usuarioService = new UsuarioService();
    $str_datos = "";

    
    if( $usuarioService->login($_POST['usuario'],$_POST['contrasenia']) ){
        $str_datos.="Credenciales correctas";
        $usuario = $usuarioService->findByUsername($_POST['usuario']);

        session_start();
        $_SESSION['user']= $usuario->getUsuario();
        


        if( $usuario->getRol() == 'Medico'){
            header("Location: ../medico/menu-inicio.php");
            $_SESSION['medico_id']= $usuario->getId();
        }else{
            header("Location: ../administrador/centro-mensajes.php");
        }

    }else{
        $str_datos.="Credenciales incorrectas";
    }

    echo $str_datos;
?>