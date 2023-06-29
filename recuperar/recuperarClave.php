<?php
include('verificarDatos/config.php');

//Generando clave aleatoria

$objeto = new DB();
$conexion = $objeto->connect();
$logitudPass = 5;
$miPassword  = substr( md5(microtime()), 1, $logitudPass);
$clave = $miPassword;
$pass_fuerte=password_hash($clave,PASSWORD_DEFAULT);
$correo  = trim($_REQUEST['correo']);
$consulta= "SELECT * FROM persona  WHERE Correo = '$correo'  ";
// $consulta2="SELECT * FROM Usuario WHERE Correo = '$correo' AND Contrasena = '$clave' AND rol=0";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

 $userss=$resultado->fetch(PDO::FETCH_ASSOC);



if($userss ==0){ 
    header("Location:login.php?errorEmail=1");
    exit();
}else{
   
 $objeto = new DB();
$conexion = $objeto->connect();
$updateClave    = ("UPDATE persona SET Contrasena='$pass_fuerte' WHERE Correo='".$correo."' ");
// $consulta2="SELECT * FROM Usuario WHERE Correo = '$correo' AND Contrasena = '$clave' AND rol=0";
$resultado = $conexion->prepare($updateClave);
$resultado->execute();




$destinatario = $correo; 
$asunto       = "Recuperando Clave - Great Event";
$cuerpo = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
    <title>Recuperar Clave de Usuario</title>';
$cuerpo .= ' 
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: "Roboto", sans-serif;
        font-size: 16px;
        font-weight: 300;
        color: #888;
        background-color:rgba(230, 225, 225, 0.5);
        line-height: 30px;
        text-align: center;
    }
    .contenedor{
        width: 80%;
        min-height:auto;
        text-align: center;
        margin: 0 auto;
        background: #ececec;
        border-top: 3px solid #E64A19;
    }
    .btnlink{
        padding:15px 30px;
        text-align:center;
        background-color:#cecece;
        color: crimson !important;
        font-weight: 600;
        text-decoration: blue;
    }
    .btnlink:hover{
        color: #fff !important;
    }
    .imgBanner{
        width:100%;
        margin-left: auto;
        margin-right: auto;
        display: block;
        padding:0px;
    }
    .misection{
        color: #34495e;
        margin: 4% 10% 2%;
        text-align: center;
        font-family: sans-serif;
    }
    .mt-5{
        margin-top:50px;
    }
    .mb-5{
        margin-bottom:50px;
    }
    </style>
';

$cuerpo .= '
</head>
<body>
    <div class="contenedor">
    
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
    <tr>
        <td style="padding: 0">
            
        </td>
    </tr>
    
    <tr>
        <td style="background-color: #ffffff;">
            <div class="misection">
                <h2 style="color: red; margin: 0 0 7px">Hola, '.$dataConsulta['fullName'].'</h2>
                <p style="margin: 2px; font-size: 18px">te hemos creado una nueva clave temporal para que puedas ingresar , la clave temporal es: <strong>'. $clave.'</strong> </p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <a href="https://ticketonline.shop/recuperar/login.php" class="btnlink">Iniciar Sesion </a>
                <p>&nbsp;</p>
                 <p>&nbsp;</p>
                
                <p>&nbsp;</p>
            </div>
        </td>
    </tr>
    <tr>
        <td style="background-color: #ffffff;">
        <div class="misection">
            <h2 style="color: red; margin: 0 0 7px">Visitar  Pagina Web </h2>
            <img style="padding: 0; display: block" src="https://ticketonline.shop" width="100%">
        </div>
        
        <div class="mb-5 misection">  
          <p>&nbsp;</p>
            <a href="https://ticketonline.shop" class="btnlink">Visitar Canal </a>
        </div>
        </td>
    </tr>
    <tr>
        <td style="padding: 0;">
            
        </td>
    </tr>
</table>'; 

$cuerpo .= '
      </div>
    </body>
  </html>';
    
    $headers  = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    $headers .= "From: WebDeveloper\r\n"; 
    $headers .= "Reply-To: "; 
    $headers .= "Return-path:"; 
    $headers .= "Cc:"; 
    $headers .= "Bcc:"; 
    (mail($destinatario,$asunto,$cuerpo,$headers));

    header("Location:login.php?email=1");
    exit();
}

?>