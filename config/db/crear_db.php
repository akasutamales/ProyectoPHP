<?php
    include_once '../config.php';
    $con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS);
    $sql="CREATE DATABASE miDB";
    
    if (mysqli_query($con,$sql)) {
		  echo "Base de datos miDB creada";
    }else {
		  echo "Error en la creacion " . mysqli_error($con);
    }

    mysqli_close($con);
?>