<?php
$conexion=mysqli_connect('localhost','u721481282_Admin','admin72025667aA.','u721481282_Ticket');
if(!$conexion){
    echo "error en conexion";
}

$Id_evento = $_POST['evento'];
$ci = $_POST['CI'];
$CostoT = $_POST['Costo'];
$cantUS = $_POST['Cantidad'];
/*$ci = '654321';
$Id_evento = '7';
$CostoT = '75';
$cantUS = '3';*/
 
$error['estado'] = array();
$res['datos'] = array();
$result['estado'] = array();
$query = "SELECT * FROM boleto Where Id_Evento = $Id_evento";

$responce=mysqli_query($conexion,$query);


while($row=mysqli_fetch_array($responce))
{
$index['Id_Boleto']=$row['0'];
$index['Id_Evento']=$row['1'];
$index['CI']=$row['2'];
$index['Cantidad_Disponible']=$row['3'];
$index['Precio']=$row['4'];

$ID_bol = $index['Id_Boleto']=$row['0'];
$Pre = $index['Precio']=$row['4'];
$Cant = $index['Cantidad_Disponible']=$row['3'];

array_push($res['datos'],$index);
}

if($Cant > 0)
{
     $insert = "INSERT INTO detalle_venta (CI, Id_Boleto, Cantidad, CostoUnitario, CostoTotal) VALUES ('$ci','$ID_bol','$cantUS','$Pre', '$CostoT')";
     if(($responce2 = mysqli_query($conexion,$insert)) === true){
        $index2['est']='0';
        array_push($result['estado'],$index2);
        echo json_encode($result);
        }else{
        $index2['est']='1';
        array_push($result['estado'],$index2);
        echo json_encode($result);
     }
}else {
    $index2['est'] = '2';
        array_push($error['estado'],$index2);
        echo json_encode($error);
}

/*$row=mysqli_fetch_row($resultado);

    $insert2 = "INSERT INTO cliente (CI) VALUES ('$ci')";
    $insert= "INSERT INTO persona (CI,FechaNacimiento, Nombre,Apeliido,Correo,Contrasena,Rol) VALUES ('$ci','$fecha','$nombre','$apellido', '$correo', '$pass_hash', '0')";
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
    echo json_encode($res);*/
?>