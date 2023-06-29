<?php

$id=$_GET['id'];
$idv=$_GET['idv'];
include './conexion/conexion3.php';

    
        $objeto1 = new DB();
        $conexion1 = $objeto1->connect();
        $query1 = "DELETE FROM boleto  WHERE Id_Boleto='".$id."'";
        $resultado1 = $conexion1->prepare($query1);
        $resultado1->execute();


        $objeto2 = new DB();
        $conexion2 = $objeto2->connect();
        $query2 = "DELETE FROM evento  WHERE Id_Evento='".$idv."'";
        $resultado2 = $conexion2->prepare($query2);
        $resultado2->execute();
        if($resultado1 && $resultado2){
              echo "<script languaje='JavaScript'> 
               alert('Los datos se eliminaron correctamente de la BD');
               window.location.href='salas.php';
               </script>";
        }
        else{


            echo "<script languaje='JavaScript'> 
            alert('Los datos NO eliminaron correctamente de la BD');
            l window.location.href='salas.php';
            </script>";
        }


?>