<?php

$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}

$res['estado'] = array();

$CI = $_POST['CI'];
$Evento=$_POST['Nombre_Evento'];
$Lugar=$_POST['Lugar'];
$Fecha=$_POST['Fecha'];
$Hora=$_POST['Hora'];

/*$CI = '987654';
$Evento = 'Concierto benefico';
$Lugar = 'Coliseo Don Bosco';
$Fecha = '2023-01-15';
$Hora = '20:00:00';*/


$fecha= strtotime($Fecha);
$date= date("Y/m/d", $fecha);

$timestamp = strtotime($Hora);
$hor=date("H:i:s", $timestamp);

//codigo logica

$query="INSERT INTO evento (CI, Nombre_Evento, Lugar, Fecha, Hora) VALUES ('$CI','$Evento','$Lugar','$date','$hor')";

$resultado=mysqli_query($conexion,$query);

if($resultado){
        $index2['est']='0';
        array_push($res['estado'],$index2);
        echo json_encode($res);
    }else{
        $index2['est']='1';
        array_push($res['estado'],$index2);
        echo json_encode($res);
}


mysqli_close($conexion);


?>
