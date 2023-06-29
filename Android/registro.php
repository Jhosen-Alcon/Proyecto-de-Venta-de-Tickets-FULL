<?php
$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}

$nombre = $_POST["nombre"];
$apellido= $_POST["apellido"];
$ci= $_POST["ci"];
$fecha = $_POST["fecha"];
$correo= $_POST["correo"];
$clave= $_POST["clave"];

$Fecha= strtotime($fecha);
$date= date("Y/m/d", $Fecha);

$pass_hash = password_hash($clave, PASSWORD_DEFAULT);

$res['estado'] = array();


// verifica si el correo esta registrado en la base de datos
$resultado=$conexion->query("SELECT EXISTS (SELECT * FROM usuarios WHERE CI = '$ci')");
$row=mysqli_fetch_row($resultado);

    $insert2 = "INSERT INTO cliente (CI) VALUES ('$ci')";
    $insert= "INSERT INTO persona (CI,FechaNacimiento, Nombre,Apeliido,Correo,Contrasena,Rol) VALUES ('$ci','$fecha','$nombre','$apellido', '$correo', '$pass_hash', 1)";
    if ($row[0]=="1") {
         $index2['est']='2';
        array_push($res['estado'],$index2);
    }else{
    if(($result = mysqli_query($conexion,$insert)) === true){
        $Ing = mysqli_query($conexion, $insert2);
        $index2['est']='0';
        array_push($res['estado'],$index2);
        }else{
        $index2['est']='1';
        array_push($res['estado'],$index2);
        }
    }  
    echo json_encode($res);
?>
