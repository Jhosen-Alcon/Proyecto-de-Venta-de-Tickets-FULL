/<?php
$conexion=mysqli_connect('localhost','u721481282_admin3','admin73098729aA.','');
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

    $insert= "INSERT INTO usuario (CI,Nombre_Usuario,Apellido_Usuario,Fecha_Nacimiento,correo,contrasena,Rol) VALUES ('$ci,'$nombre','$apellido'','$date', '$correo', '$pass_hash', '0')";
    if ($row[0]=="1") {
         $index2['est']='2';
        array_push($res['estado'],$index2);
    }else{
    if(($result = mysqli_query($conexion,$insert)) === true){
        $index2['est']='0';
        array_push($res['estado'],$index2);
        }else{
        $index2['est']='1';
        array_push($res['estado'],$index2);
        }
    }  
    echo json_encode($res);

$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}



?>
