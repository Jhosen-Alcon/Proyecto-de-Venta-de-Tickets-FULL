<?php

include('./global/sesiones.php');

   
 /*  $nit=(isset($_POST['nit']))?$_POST['nit']:"";
   $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
   $pass=(isset($_POST['pass']))?$_POST['pass']:"";
   $accion=(isset($_POST['accion']))?$_POST['accion']:"";
   switch($accion){
       case "agregar":
           $ss = $apellido . $nit;
           $conex = mysqli_connect('localhost','glasgowc_inaldrop','jYSMd]GjE6r9','glasgowc_cine3');
           $query = "INSERT INTO usuarios(nit,apellido,correo,password,tarjeta,rol) VALUES ($nit,'$apellido','$ss','$pass',NULL,2)";
           $resul = mysqli_query($conex,$query);
           break;
   }
*/




$today = date("Y-n-j");
include_once './conexion/conexion3.php';
$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM persona where rol=1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$users=$resultado->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(CI) AS tot FROM persona where rol=1";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$hoy=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM persona where Nombre='$_SESSION[Nombre]'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$fotobd=$resultado->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM Detalle_Venta ";
$compra = $conexion->prepare($consulta);
$compra->execute();
$userc=$compra->fetchAll(PDO::FETCH_ASSOC);



$CI=(isset($_POST['CI']))?$_POST['CI']:"";
$Nusuario=(isset($_POST['Nombre_Usuario']))?$_POST['Nombre_Usuario']:"";
$Ausuario=(isset($_POST['Apellido_Usuario']))?$_POST['Apellido_Usuario']:"";
$Fecha=(isset($_POST['Fecha_Nacimiento']))?$_POST['Fecha_Nacimiento']:"";
$Correo=(isset($_POST['correo']))?$_POST['correo']:"";
$contra=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
$Rol=(isset($_POST['Rol']))?$_POST['Rol']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "agregar":
        $Imagen=addslashes(file_get_contents($_FILES['Im']['tmp_name']));
        if($existe==0){
      //  $conex = mysqli_connect('localhost','root','','prueba');
       // $query = "INSERT INTO eventos(IdEvento,Nombre_Evento,Lugar,Fecha,Hora,idAdmin) VALUES ('$IEvento','$Nevento','$Lugar','$Fecha','$Hora','$IdA',)";
      //  $resul = mysqli_query($conex,$query);
        $objeto1 = new DB();
        $conexion1 = $objeto1->connect();
        $pass_fuerte=password_hash($contra,PASSWORD_DEFAULT);
        $query1 = "INSERT INTO persona(CI,FechaNacimiento,Nombre,Apeliido,Correo,Contrasena,Rol,imagen) 
        VALUES ('$CI','$Fecha','$Nusuario','$Ausuario','$Correo','$pass_fuerte','$Rol','$Imagen')";
        $resultado1 = $conexion1->prepare($query1);
        $resultado1->execute();
        if($resultado1){
             echo'<script type="text/javascript">
    alert("Tarea Guardada");
    window.location.href="index.php";
    </script>';
        }
       else{
         echo'<script type="text/javascript">
    alert("Registro Fallido");
    window.location.href="index.php";
    </script>';
    }  
    } 
} 


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM 
persona p inner JOIN usuario us on p.CI=us.CI inner join boleto b on b.IDLogin=us.IDLogin
inner join detalle_venta de on de.Id_Boleto=b.Id_Boleto 
inner join evento ev on ev.Id_Evento=b.Id_Evento  group by FECHA desc  ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventasinnerCompras=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"rel="stylesheet">
    <!----UNICONS--->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--shortcut-->
    <link rel="shortcut icon" href="./images/cine.png" type="image/x-icon" />
    <!--css-->
    <link rel="stylesheet" href="./style.css">
    <title>Great Concert</title>
</head>
<body class="dark-theme-variables">
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/Great.png" alt="">
                    <h2>Great<span class="danger">Event</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>

            <div class="sidebar">
                <a href="./index.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Panel</h3>
                </a>
                <a href="./users.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>Usuarios</h3>
                    
                </a>
                <a href="./ventas.php">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Ventas</h3>
                </a>
                <!---<a href="./analisis.php">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Analisis</h3>
                </a>-->
                <a href="./prod.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Lugares</h3>
                </a>
                <a href="./Eventos.php">
                    <span class="material-icons-sharp">theaters</span>
                    <h3>Eventos</h3>
                </a>
                <a href="./salas.php">
                    <span class="material-icons-sharp">pageview</span>
                    <h3>Boletos</h3>
                </a>
               <!-- <a href="./funciones.php">
                    <span class="material-icons-sharp">movie</span>
                    <h3>Funciones</h3>
                </a>-->
                <a href="./emp.php" class="active">
                    <span class="material-icons-sharp">group</span>
                    <h3>Administradores</h3>
                    <?php foreach($hoy as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <a href="./global/cerrarsesion.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Cerrar Sesion</h3>
                    <?php
                                  //  session_unset();
                                  //  session_destroy();
                                    ?>
                </a>
            </div>
        </aside>
        <!---End aside-->
        <main>
            <h1>Administradores</h1>
            
            <div class="insights">
            
            </div>
            <!---------end insights--------->

            <div class="recent-orders">
            <h2>Lista Administradores</h2>
                <table>
                    <thead>
                        <tr>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha Nacimiento</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Foto Perfil</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $l){ ?>
                        <tr>
                            <td><?php echo $l['CI'];?></td>
                            <td><?php echo $l['FechaNacimiento'];?></td>
                            <td><?php echo $l['Nombre'];?></td>
                            <td><?php echo $l['Apeliido'];?></td>
                            <td><?php echo $l['Correo'];?></td>
                            <td><?php echo $l['Rol'];?></td>
                            <td> <img height="60px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imagen']);?>"/></span></td>
                                    
                            <td class="warning">
                                <span class="services__button"></span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <span>Carnet: <?php echo $l['CI'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre: <?php echo $l['Nombre'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Apellido: <?php echo $l['Apellido_Usuario'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha: <?php echo $l['Fecha_Nacimiento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Correo: <?php echo $l['correo'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Rol: <?php echo $l['Rol'];?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                            </td>
                            
                            
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>

        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                    <p>Hey <b><?php  echo $_SESSION['Nombre'] ?></b></p>
                        <small class="text-muted">  Administrador</small>
                    </div>
                    <?php foreach($fotobd as $us) {?>
                    <div class="profile-photo">
                    <td> <span><img height="50px"  src="data:image/jpg;base64,<?php echo base64_encode($us['imagen']);?>"/></span></td>
                    
                    </div>
                    <?php }?>
                </div>
            </div>
           <!--end top-->
           <div class="recent-updates">
                <h2>Ventas Recientes (C)</h2>
                <div class="updates">
                    <?php foreach($lventasinnerCompras as $u) { ?>
                    <div class="update">
                        <div class="profile-photo"> 
                        <img height="60px"  src="data:image/jpg;base64,<?php echo base64_encode($u['imagen']);?>"/>
                        </div>
                        <div class="message">
                            <p><b><?php echo $u['Nombre']; ?></b> Acaba de boletos para  el evento <?php echo $u['Nombre_Evento']; ?>  </p>
                            <small class="text-muted">fecha de compra: <?php echo $u['Fecha']; ?></small>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--------------end of recent updates------------->
            <div class="sales-analytics">
            <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp">add</span>
                        <span class="services__button"><h3>Registrar Cliente</h3></span>
                            <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title"></h4>
                                <i class="uil uil-times services__modal-close"></i>
                                <ul class="services__modal-services grid">
                                    <form method="POST" enctype="multipart/form-data">
                                    <li class="services__modal-service">
                                        <label for="">Carnet Identidad</label>
                                        <br>
                                        <input type="text" id="CI" name="CI" require>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Nombre</label>
                                        <br>
                                        <input type="text" id="Nombre_Usuario" name="Nombre_Usuario" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Apellido</label>
                                        <br>
                                        <input type="text" id="Apellido_Usuario" name="Apellido_Usuario" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Fecha Nacimiento</label>
                                        <br>
                                        <input type="date" id="Fecha_Nacimiento" name="Fecha_Nacimiento" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Correo</label>
                                        <br>
                                        <input type="email" id="correo" name="correo" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Contraseña</label>
                                        <br>
                                        <input type="password" id="contrasena" name="contrasena" required>
                                    </li>
                                    
                                    <li class="services__modal-service">
                                        <label for="">Rol</label>
                                        <br>
                                        <input type="text" id="Rol" name="Rol" required>
                                    </li>

                                    <li class="services__modal-service">
                                        <label for="">Foto:</label>
                                        <br>
                                        <input type="file" id="Im" name="Im" required>
                                    </li>
                                    
                                        <button type="submit" name="accion" value="agregar">Agregar</button>
                                        
                                    </form>                                   
                                </ul>
                            </div>
                    </div>

                </div>
            </div>  
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
</body>
</html>