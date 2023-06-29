<?php

include_once './conexion/conexion3.php';

$CI=$_POST['CI'];
$Nusuario=$_POST['Nombre_Usuario'];
$Ausuario=$_POST['Apellido_Usuario'];
$Fecha=$_POST['Fecha_Nacimiento'];
$Correo=$_POST['correo'];
$Rol=$_POST['Rol'];

$objeto = new DB();
    $conexion = $objeto->connect();
    $actualizar= "UPDATE  persona set CI='$CI',Nombre='$Nusuario', Apeliido='$Ausuario',FechaNacimiento='$Fecha',Correo='$Correo',Rol='$Rol' WHERE CI='$CI'" ;
    $resultado = $conexion->prepare($actualizar);
    $resultado->execute();

    if($resultado){
        echo "<script> alert('se han actulizado los cambios correctamente');
        window.location= 'users.php';</script>";
        
    }
    else{
        echo "<script> alert('No se pudo actulizar los datos'); window.history.go(-1);</script>";
    }
?>