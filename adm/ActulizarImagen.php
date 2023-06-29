<?php

include_once './conexion/conexion3.php';

$CI=$_POST['CI'];
$Imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
$objeto = new DB();
    $conexion = $objeto->connect();
    $actualizar= "UPDATE  persona set imagen='$Imagen' WHERE CI='$CI'" ;
    $resultado = $conexion->prepare($actualizar);
    $resultado->execute();

    if($resultado){
        echo "<script> alert('se actualizo la imagen  correctamente');
        window.location= 'users.php';</script>";
        
    }
    else{
        echo "<script> alert('No se pudo actulizar los datos'); window.history.go(-1);</script>";
    }




   
?>