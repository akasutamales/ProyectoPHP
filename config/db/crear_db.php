<?php
    include_once '../config.php';
    $con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS);
    $sql="CREATE DATABASE " . NOMBRE_DB ;
    
    if (mysqli_query($con,$sql)) {
		  echo "Base de datos ". NOMBRE_DB . " creada";
    }else {
		  echo "Error en la creacion de la base de datos " . mysqli_error($con);
    }

    mysqli_close($con);
?>