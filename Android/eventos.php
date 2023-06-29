<?php
$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}

$result=array();
$query="SELECT * FROM evento";
$responce=mysqli_query($conexion,$query);

while($row=mysqli_fetch_array($responce))
{

$result[] = $row;
}
echo json_encode($result);

?>