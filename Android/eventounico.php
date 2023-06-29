<?php

$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}
//$evento=$_POST['evento'];
$evento = '1';

$result=array();
$result['event']=array();
$query="SELECT * FROM evento Where Id_Evento = '$evento'";
$responce=mysqli_query($conexion,$query);

while($row=mysqli_fetch_array($responce))

{

$index['Id_Evento']=$row['0'];
$index['CI']=$row['1'];
$index['Nombre_Evento']=$row['2'];
$index['Lugar']=$row['3'];
$index['Fecha']=$row['4'];
$index['Hora']=$row['5'];

array_push($result['event'],$index);
}
echo json_encode($result);

?>