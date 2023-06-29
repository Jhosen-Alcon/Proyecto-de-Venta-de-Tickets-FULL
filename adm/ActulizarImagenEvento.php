<?php

include_once './conexion/conexion3.php';

$IEvento=(isset($_POST['Ievento']))?$_POST['Ievento']:"";
$Imagenevento=addslashes(file_get_contents($_FILES['imagenevento']['tmp_name']));
$objeto = new DB();
    $conexion = $objeto->connect();
    $actualizar= "UPDATE  evento set imgevento='$Imagenevento' WHERE Id_Evento='$IEvento'" ;
    $resultado = $conexion->prepare($actualizar);
    $resultado->execute();

    if($resultado){
        echo "<script> alert('se actualizo la imagen  correctamente');
        window.location= 'eventos.php';</script>";
        
    }
    else{
        echo "<script> alert('No se pudo actulizar los datos'); window.history.go(-1);</script>";
    }



   
?>