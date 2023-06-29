<?php

include_once './conexion/conexion3.php';

$IEvento=(isset($_POST['Ievento']))?$_POST['Ievento']:"";

$IdBo=(isset($_POST['IDB']))?$_POST['IDB']:"";
$Nevento=(isset($_POST['Nevento']))?$_POST['Nevento']:"";
$Lugar=(isset($_POST['lugar']))?$_POST['lugar']:"";
$Fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
$FechaR=(isset($_POST['fechaR']))?$_POST['fechaR']:"";
$Hora=(isset($_POST['hora']))?$_POST['hora']:"";

$CanD=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
$Precios=(isset($_POST['precio']))?$_POST['precio']:"";





    
        $objeto1 = new DB();
        $conexion1 = $objeto1->connect();
        $query1 = "UPDATE  evento SET Nombre_Evento='$Nevento',Id_Lugar='$Lugar',Fecha='$Fecha',Hora='$Hora' where Id_Evento='$IEvento'";
        $resultado1 = $conexion1->prepare($query1);
        $resultado1->execute();

        $objeto = new DB();
        $conexion = $objeto->connect();
        $actualizar= "UPDATE  boleto set Cantidad_Disponible='$CanD',Precio='$Precios' WHERE Id_Boleto='$IdBo'" ;
        $resultado2 = $conexion->prepare($actualizar);
        $resultado2->execute();

        if($resultado1 && $resultado2){
            echo "<script> alert('se han actulizado los cambios correctamente');
            window.location= 'Eventos.php';</script>";
        }
        else{
            echo "<script> alert('No se pudo actulizar los datos'); window.history.go(-1);</script>";
        }
  


        
       

    
       
        
     

?>