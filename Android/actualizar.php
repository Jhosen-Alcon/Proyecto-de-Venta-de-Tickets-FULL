<?php

$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}

$res['estado'] = array();

$Id_Evento=$_POST['IdEvento'];
$Nombre_Evento=$_POST['Nombre_Evento'];
$Lugar=$_POST['Lugar'];
$Fecha=$_POST['Fecha'];
$Hora=$_POST['Hora'];

//fecha y hora


$Fecha1= strtotime($Fecha);
$date= date("Y/m/d", $Fecha1);

$timestamp = strtotime($Hora);
$hor=date("H:i:s", $timestamp);


//codigo logica

$query="UPDATE evento SET Nombre_Evento='$Nombre_Evento',Lugar='$Lugar',Fecha= '$date', Hora= '$hor' WHERE Id_Evento=$Id_Evento";

$resultado=mysqli_query($conexion,$query);

if($resultado){
    $index2['est']='0';
    array_push($res['estado'],$index2);
}
else{
    $index2['est']='1';
    array_push($res['estado'],$index2);
}
echo json_encode($res);

mysqli_close($conexion);


?>
