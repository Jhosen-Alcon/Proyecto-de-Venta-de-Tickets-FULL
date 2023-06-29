<?php
$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}

$res['estado'] = array();

$resultado=$conexion->query("SELECT EXISTS (SELECT * FROM Usuario WHERE Correo = 'chavez@gmail.com');");
$row=mysqli_fetch_row($resultado);

    if ($row[0]=="1") {                 

            $index2['est']='0';
    array_push($res['estado'],$index2);
    }else{
           $index2['est']='1';
    array_push($res['estado'],$index2);
    }  
echo json_encode($res);
?>