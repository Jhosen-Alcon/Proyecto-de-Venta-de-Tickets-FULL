<?php
$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');

$result = array();
$result['datos'] = array();
$query = "SELECT * FROM eventos";
$responce = mysqli_query($conexion,$query);

while($row = mysqli_fetch_array($responce)){
    $index['IdEvento'] = $row['0'];
    $index['Nombre_Evento'] = $row['1'];
    $index['Lugar'] = $row['2'];
    $index['Fecha'] = $row['3'];
    $index['Hora'] = $row['4'];
    $index['IdAdmin'] = $row['5'];

    array_push($result['datos'], $index);
}

$result["exito"] = "1";
echo json_encode($result);
?>