<?php
include_once './conexion/conexion.php';

$nombre = $_POST["nombre"];
$apellido= $_POST["apellido"];
$ci= $_POST["ci"];
$fecha = $_POST["fecha"];
$correo= $_POST["correo"];
$clave= $_POST["clave"];
$Imagen=addslashes(file_get_contents($_FILES['images']['tmp_name']));

//echo $_FILES['images'];
//print_r($_FILES);
$objeto1 = new DB();
$conexion1 = $objeto1->connect();
$consulta1= "SELECT * FROM persona WHERE Correo = '$correo'";
$resultado1 = $conexion1->prepare($consulta1);
$resultado1->execute();

$users=$resultado1->fetchAll(PDO::FETCH_ASSOC);
$existe = count($users);
echo count($users);
// verifica si el correo esta registrado en la base de datos
if($existe == 0)
{
    //inicia el insert a la base de datos
    $objeto = new DB();
    $conexion = $objeto->connect();
    $pass_fuerte=password_hash($clave,PASSWORD_DEFAULT);
    
    $insert= "INSERT INTO persona (CI,FechaNacimiento,Nombre,Apeliido,Correo,Contrasena,Rol,imagen) 
    VALUES ('$ci','$fecha','$nombre','$apellido' , '$correo', '$pass_fuerte', '0','$Imagen')";
    $resultado = $conexion->prepare($insert);
    $resultado->execute();
    if($resultado){
        echo "<script>
                alert('Registro Exitoso');
                window.location= '/pag/recuperar/login.php'
    </script>";
    }
    else{
    echo "Query Failed: ".$error_message;
    }
}
else{
    //si existe el correo salta a false ' agregar en front en un mensaje de existe correo'
    echo 'existe';
   echo "<script>
                alert('El Correo Electronico Ya Existe');
                alert('El carnet de identidad ya se encuentra en uso');
                window.location= 'registro.html'
    </script>";

}

?>
