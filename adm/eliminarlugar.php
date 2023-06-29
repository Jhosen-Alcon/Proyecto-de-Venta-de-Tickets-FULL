<?php

$id=$_GET['id'];
include './conexion/conexion3.php';

    
        $objeto1 = new DB();
        $conexion1 = $objeto1->connect();
        $query1 = "DELETE FROM lugar WHERE Id_Lugar='".$id."'";
        $resultado1 = $conexion1->prepare($query1);
        $resultado1->execute();
        if($resultado1){
              echo "<script languaje='JavaScript'> 
               alert('Los datos se eliminaron correctamente de la BD');
               window.location.href='prod.php';
               </script>";
        }
        else{


            echo "<script languaje='JavaScript'> 
            alert('Los datos NO eliminaron correctamente de la BD');
            l window.location.href='prod.php';
            </script>";
        }


?>