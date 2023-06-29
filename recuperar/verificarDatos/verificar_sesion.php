<?php
include_once 'config.php';
date_default_timezone_set("America/La_Paz");
$Hora_24= date('Y-m-d H:i:s');
$correo= $_REQUEST["correo"];
$clave= $_REQUEST["clave"];
$atmp=0;    
// $correo= "chavez@gmail.com";
// $clave= "12345";

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT CI,Nombre,Apeliido,Correo,Contrasena,Rol FROM persona  WHERE Correo = '$correo'  ";
// $consulta2="SELECT * FROM Usuario WHERE Correo = '$correo' AND Contrasena = '$clave' AND rol=0";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

 $userss=$resultado->fetch(PDO::FETCH_ASSOC);
 //print_r($userss);
 
 //print_r($userss['Nombre_Usuario']);
 $numeroregistros=$resultado->rowCount();

        // echo $userss['Contrasena'];
         //$contra='12345' ;
         
         
        
          if (password_verify($clave, $userss['Contrasena'])) {
            
             // echo 'Password is valid!';
             if(($numeroregistros>=1) ){
            session_start();
           $_SESSION['correo']=$userss;
           $_SESSION['Nombre']=$userss['Nombre'];
           $_SESSION['Rol']=$userss['Rol'];
           $_SESSION['CI']=$userss['CI'];
           $CI=$userss['CI'];
    
           $TipoUs=$userss['Rol'];
           $_SESSION['IDLogin']=$userss['IDLogin'];
           //logica inicio sesion
              if( $TipoUs > 0){
                $objeto1 = new DB();
                $conexion1 = $objeto1->connect();
                $query1 = "INSERT INTO usuario (CI,FechaIngreso) 
                VALUES ('$CI','$Hora_24')";
                $resultado1 = $conexion1->prepare($query1);
                $resultado1->execute();
                $objeto = new DB();
                $conexion = $objeto->connect();
                $consulta= "SELECT p.CI,Nombre,Apeliido,Correo,Contrasena,Rol, max(IDLogin) as ID,FechaIngreso as fecha FROM persona p inner join usuario us on p.CI=us.CI WHERE Correo = '$correo'  ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
    
               $userss=$resultado->fetch(PDO::FETCH_ASSOC);
               print_r($userss);
              $numeroregistros=$resultado->rowCount();
             //if(($numeroregistros>=1) )
            session_start();
           $_SESSION['correo']=$userss;
           $_SESSION['Nombre']=$userss['Nombre'];
           $_SESSION['Rol']=$userss['Rol'];
           $_SESSION['CI']=$userss['CI'];
            $_SESSION['ID']=$userss['ID'];
            $_SESSION['fecha']=$userss['fecha'];
    
                 header("Location:/pag/adm/index.php");
    
              }
    
              else{
               
                 
                header("Location:/pag/clientev/clientel.html");
              }
    
            }
          }
          else   
          {
          
          // echo '<script type="text/javascript"> alert("Error al intentar iniciar sesion   numero de intento '.$atmp.'")  </script>';
           echo '<script type="text/javascript">
                       alert("contrasenia Incorrecta ");
           window.location= "login.html"
                </script>';
          } 
?>