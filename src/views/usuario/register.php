<?php

    include_once '../logic/UsuarioLogica.php';

    $str_datos = "";

    if( $_POST['Contrasenia'] == $_POST['Confirm']){

        $usuarioLogica = new UsuarioLogica();
    
        $rol = $usuarioLogica->getRol();
        
        $exito = $usuarioLogica->register($_POST['Usuario'],$rol,$_POST['Contrasenia'],$_POST['Cedula']);
    
        if( $exito ){
            $str_datos.= "El usuario se registró con exito<br>";
        }else{
            $str_datos.= "ERROR!<br>";
            $str_datos.= "<a href='registrar.html' >Volver</a>"; 
        }
    }else{
        $str_datos.= "ERROR: Las contraseñas no coinciden<br>";
        $str_datos.= "<a href='registrar.html' >Volver</a>"; 
    }

    echo $str_datos;
?>