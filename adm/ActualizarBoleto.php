<?php

include_once './conexion/conexion3.php';

$idBo=$_POST['IdBoleto'];
$Cantidad=$_POST['cand'];
$prt=$_POST['Prec'];


$objeto = new DB();
    $conexion = $objeto->connect();
    $actualizar= "UPDATE  boleto set Cantidad_Disponible='$Cantidad',Precio='$prt' WHERE Id_Boleto='$idBo'" ;
    $resultado = $conexion->prepare($actualizar);
    $resultado->execute();

    if($resultado){
        echo "<script> alert('se han actulizado los cambios correctamente');
        window.location= 'salas.php';</script>";
    }
    else{
        echo "<script> alert('No se pudo actulizar los datos'); window.history.go(-1);</script>";
    }
?>