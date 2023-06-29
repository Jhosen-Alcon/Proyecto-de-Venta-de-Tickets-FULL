<?php

$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}
$user=$_POST['user'];
$pass=$_POST['pass'];

//$user= 'angel@gmail.com';
//$pass= 'angel123';


$error['estado'] = array();
$result=array();
$result['datos']=array();
$query="SELECT * FROM persona Where Correo = '$user'";
$responce=mysqli_query($conexion,$query);

while($row=mysqli_fetch_array($responce))
{
$index['CI']=$row['0'];
$index['FechaNacimiento']=$row['1'];
$index['Nombre']=$row['2'];
$index['Apeliido']=$row['3'];
$index['Correo']=$row['4'];
$index['Contrasena']=$row['5'];
$index['Rol']=$row['6'];

array_push($result['datos'],$index);
}
if(password_verify($pass, $index['Contrasena']))
    {
    echo json_encode($result);
    }else{
        $index2['est'] = '1';
        array_push($error['estado'],$index2);
        echo json_encode($error);
    }

?>