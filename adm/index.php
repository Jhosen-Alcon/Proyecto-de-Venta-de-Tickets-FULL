<?php

    //session_start();
   // if(!isset($_SESSION['correo'])){
  //      header("Location:../cliente/login.html");
 //   }{
  //     print_r($_SESSION['correo']);
  //  }
  include_once './conexion/conexion3.php';
  include('./global/sesiones.php');


  $objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM persona where Nombre='$_SESSION[Nombre]'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$users=$resultado->fetchAll(PDO::FETCH_ASSOC);


  $objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(CI) AS tot FROM persona";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$hoy=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(NumeroVenta) AS tot FROM detalle_venta";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$ventat=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(Id_Evento) AS tot FROM evento";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$Eventot=$ventash->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(Id_Lugar) AS tot FROM Lugar";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$Lutot=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(Id_Boleto) AS tot FROM boleto";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$botot=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM boleto b   
inner join evento ev on ev.Id_Evento=b.Id_Evento 
inner join usuario us on us.IDLogin=ev.IDLogin inner join persona p on p.CI=us.CI inner join lugar lu on lu.Id_Lugar=ev.Id_Lugar ORDER by FechaRegistroEvento DESC limit 3";
$imgin = $conexion->prepare($consulta);
$imgin->execute();
$Muestra=$imgin->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(CI) AS tot FROM persona where rol=1";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$clientest=$ventash->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM 
persona p inner JOIN cliente cl on p.CI=cl.CI inner join boleto b on b.IDLogin=cl.IDLogin
inner join detalle_venta de on de.Id_Boleto=b.Id_Boleto 
inner join evento ev on ev.Id_Evento=b.Id_Evento inner join lugar lu on ev.Id_Lugar=lu.Id_Lugar  ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventasinner=$resultado->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM 
persona p inner JOIN usuario us on p.CI=us.CI inner join boleto b on b.IDLogin=us.IDLogin
inner join detalle_venta de on de.Id_Boleto=b.Id_Boleto 
inner join evento ev on ev.Id_Evento=b.Id_Evento  group by FECHA desc  ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventasinnerCompras=$resultado->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM detalle_venta";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$detalle=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM detalle_venta";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$venta=$ventash->fetchAll(PDO::FETCH_ASSOC);

 //$nombre = $_SESSION['nombre'];
//$pv =  $_SESSION["privilegio"];
//echo $nombre;
//echo $pv;
date_default_timezone_set("America/La_Paz");

$fechaActual=date('d-m-Y');

?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!----UNICONS--->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--shortcut-->
    <link rel="shortcut icon" href="./images/cine.png" type="image/x-icon" />
    <!--css-->
    <link rel="stylesheet" href="./style.css">
    <title>Event Concert</title>
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
                <a href="#" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Panel</h3>
                </a>
                <a href="users.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>Usuarios</h3>
                    <?php foreach($hoy as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <a href="./ventas.php">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Ventas</h3>
                    <?php foreach($ventat as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
               
                <!---<a href="./analisis.php">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Analisis</h3>
                </a>-->
                <a href="./prod.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Lugares</h3>
                    <?php foreach($Lutot as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <a href="./Eventos.php">
                    <span class="material-icons-sharp">theaters</span>
                    <h3>Eventos</h3>
                    <?php foreach($Eventot as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <a href="./salas.php">
                    <span class="material-icons-sharp">pageview</span>
                    <h3>Boletos</h3>
                    <?php foreach($botot as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                    
                </a>
                <!--
                <a  href="./funciones.php" >
                    <span class="material-icons-sharp"  >movie</span>
                    <h3>Funciones</h3>
                </a>
                -->
                <a href="./emp.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>Administradores</h3>
                    <?php foreach($clientest as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <a href="./global/cerrarsesion.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Cerrar Sesion</h3>
                    <?php
                                   // session_unset();
                               //     session_destroy();
                                    ?>
                </a>
            </div>
        </aside>
        <!---End aside-->
        
        <main>
        <h1>Panel</h1>
            <div class="date">
                 <?php echo $fechaActual ?>  
            </div>
            
            <div class="insights">
                
                <div class="sales">
                    
                    <div class="middle">
                   
                        <div class="lef">
                            
                        </div>
                        <div class="progress">
                           
                           
                        </div>
                    </div>
                   
                </div>
                <!--------END FINAL EVENTOS VISITADOS-------->
                <div class="" >
                
                    <table>
                    <tbody>
                        <?php  
                            foreach( $Muestra as $l){ ?>
                      
                       <div>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>
                       
                            <td>  Evento: <?php echo $l['Nombre_Evento'];?> <img height="250px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imgevento']);?>"></td>
                            
                            </td>
                            </td>
                            </td>
                            </td>
                            </td>
                            </td>
                            </td>
                            </div>       
                            <?php }?>
                            
                    </tbody>
                    
                </table>
                    <span class="material-symbols-sharp">groups</span>
                    <div class="middle">
                        <div class="lef">
                 
                        <h3>Eventos Recientes Agregados</h3>
                        
                            <h1>———————————————————————————————Eventos disponibles para su compra Great Event</h1>
                           
                        </div>
                      
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Después de 24 Horas</small>
                </div>
                
                <!--------END FINAL EVENTOS VISITADOS-------->
               

            </div>
            <!---------end insights--------->

            <div class="recent-orders">
                <h2>Ordenes recientes <?php $nombre; ?> </h2>
                <table>
                    <thead>
                        <tr>
                            <th>Ci</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Numero Venta</th>
                            <th>Nombre Evento</th>
                            <th>Fecha Compra </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            
                            <?php foreach($lventasinner as $ev) {?>
                            <td><?php echo $ev['CI'];?></td>
                            <td><?php echo $ev['Nombre'];?></td>
                            <td><?php echo $ev['Apeliido'];?></td>
                            <td><?php echo $ev['NumeroVenta'];?></td>
                            <td><?php echo $ev['Nombre_Evento'];?></td>
                            <td><?php echo $ev['Fecha_de_Compra'];?></td>
                                <td class="warning">
                                <span class="services__button">detalles</span>
                                <div class="services__modal" id="edit">
                             
                            <div class="services__modal-content">
                          
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>
                               
                                <ul class="services__modal-services grid">
                                <li class="services__modal-service">
                                <li class="services__modal-service">
                                        <span>Fecha Compra: <?php echo $ev['Fecha_de_Compra'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Numero Venta: <?php echo $ev['NumeroVenta'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Carnet: <?php echo $ev['CI'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre: <?php echo $ev['Nombre'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Apellido: <?php echo $ev['Apeliido'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Correo: <?php echo $ev['Correo']?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Id Evento: <?php echo $ev['Id_Evento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre Evento: <?php echo $ev['Nombre_Evento'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Lugar: <?php echo $ev['Lugar'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha: <?php echo $ev['Fecha'];?> Bs.</span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Hora: <?php echo $ev['Hora'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Cantidad: <?php echo $ev['Cantidad'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Costo Unitario: <?php echo $ev['CostoUnitario'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Precio Total: <?php echo $ev['CostoTotal'];?> </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                            </td>
                        </tr>
                        <?php } ?>
                    
                

                    </tbody>
                </table>
                <a href="./ventas.php">Mostrar Todo</a>
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
                        <p>Bienvenido <b><?php  echo $_SESSION['Nombre'] ?></b></p>
                        <small class="text-muted"> Administrador</small>
                    </div>
                    <?php foreach($users as $us) {?>
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
            
                </div>
            </div>
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
</body>
</html>