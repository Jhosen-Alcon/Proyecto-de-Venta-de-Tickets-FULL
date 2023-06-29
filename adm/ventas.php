<?php
include_once './conexion/conexion3.php';
include('./global/sesiones.php');
 include('./global/validaciones.html'); 





$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM detalle_venta  ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventas=$resultado->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(NumeroVenta) AS tot FROM detalle_venta";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$hoy=$ventash->fetchAll(PDO::FETCH_ASSOC);

//$objeto = new DB();
//$conexion = $objeto->connect();
//$consulta= "SELECT * FROM eventos  ";
//$resultado = $conexion->prepare($consulta);
//$resultado->execute();
//$eventosss=$resultado->fetchAll(PDO::FETCH_ASSOC);
//
$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM persona where Nombre='$_SESSION[Nombre]'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$fotobd=$resultado->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM detalle_venta de inner join cliente cl on de.IDLogin=cl.IDLogin inner join persona pe on pe.CI=cl.CI inner join boleto b on b.Id_Boleto=de.Id_Boleto 
inner join evento ev on ev.Id_Evento=b.Id_Evento inner join lugar lu on lu.Id_Lugar=ev.Id_Lugar   ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventasinner=$resultado->fetchAll(PDO::FETCH_ASSOC);
//
//

//
//
//$objeto = new DB();
//$conexion = $objeto->connect();
//$consulta= "SELECT * FROM detalle_venta";
//$detallev = $conexion->prepare($consulta);
//$detallev->execute();
//$de=$detallev->fetchAll(PDO::FETCH_ASSOC);
//
//
//$Ieventa=(isset($_POST['Iventa']))?$_POST['Iventa']:"";
//$Nventa=(isset($_POST['Nventa']))?$_POST['Nventa']:"";
//$Napellidos=(isset($_POST['Napellido']))?$_POST['Napellido']:"";
//$carnet=(isset($_POST['CI']))?$_POST['CI']:"";
//$pagos=(isset($_POST['Pago']))?$_POST['Pago']:"";
//$Idevento=(isset($_POST['Ieventox']))?$_POST['Ieventox']:"";
//$cantida=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
//$prec=(isset($_POST['Precio']))?$_POST['Precio']:"";
//$NroBoleto=(isset($_POST['NroBoleto']))?$_POST['NroBoleto']:"";
//
//$Fechas=(isset($_POST['fe']))?$_POST['fe']:"";
//$Preciotota=(isset($_POST['ptotal']))?$_POST['ptotal']:"";
//
//$accion=(isset($_POST['accion']))?$_POST['accion']:"";
//switch($accion){
//    case "agregar":
//        if($existe==0){
//      //  $conex = mysqli_connect('localhost','root','','prueba');
//       // $query = "INSERT INTO eventos(IdEvento,Nombre_Evento,Lugar,Fecha,Hora,idAdmin) VALUES ('$IEvento','$Nevento','$Lugar','$Fecha','$Hora','$IdA',)";
//      //  $resul = mysqli_query($conex,$query);
//        $objeto1 = new DB();
//        $conexion1 = $objeto1->connect();
//        $query1 = "INSERT INTO registro_venta(Id_Venta,Nombre,Apellido,CI,Metodo_Pago,ID_Evento,cantidad,precio,Nro_Boleto) 
//        VALUES ('$Ieventa','$Nventa','$Napellidos','$carnet','$pagos','$Idevento','$cantida','$prec','$NroBoleto')";
//        $resultado1 = $conexion1->prepare($query1);
//        $resultado1->execute();
//        
//         $objeto2=new DB();
//         $conexion2=$objeto2->connect();
//        $query2="INSERT INTO detalle_venta(Id_Detalle,Nro_Boleto,Fecha,cantidad,preciototal) 
//        VALUES('$Ieventa','$NroBoleto','$Fechas','$cantida','$Preciotota')";
//        $resultado2=$conexion2->prepare($query2);
//        $resultado2->execute();
//        if($resultado1 && $resultado2){
//             echo'<script type="text/javascript">
//    alert("Tarea Guardada");
//    window.location.href="index.php";
//    </script>';
//        }
//       else{
//         echo'<script type="text/javascript">
//    alert("Registro Fallido");
//    window.location.href="index.php";
//    </script>';
//       
//    }  
//    } 
//} 
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
    <title>Great Event</title>
</head>
<body class="dark-theme-variables">
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/Great.png" alt="">
             
                </div>
                <h2>Great<span class="danger">Event</span></h2>
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
                <a href="./ventas.php" class="active">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Ventas</h3>
                    
                    <?php foreach($hoy as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                    
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
                <!--<a href="./funciones.php">
                    <span class="material-icons-sharp">movie</span>
                    <h3>Funciones</h3>
                </a>-->
                <a href="./emp.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>administradores</h3>
                </a>
                <a href="./global/cerrarsesion.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Cerrar Sesion</h3>
                    <?php
                                   // session_unset();
                                   // session_destroy();
                                    ?>
                </a>
            </div>
        </aside>
        <!---End aside-->
        <main>
            <h1>Ventas</h1>
            
            

            <div class="recent-orders">
                <h2>Ventas GRAL</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Venta</th>
                            <th>CI Comprador</th>
                            <th>Id_Boleto</th>
                            <th>Cantidad</th>
                            <th>CostoUnitario</th>
                            <th>CostoTotal</th>
                            <th>Fecha_de_Compra</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lventasinner as $l){ ?>
                        <tr>
                        <td><?php echo $l['NumeroVenta'];?></td>
                            <td><?php echo $l['CI'];?></td>
                            <td><?php echo $l['Id_Boleto'];?></td>
                            <td><?php echo $l['Cantidad'];?></td>
                            <td><?php echo $l['CostoUnitario'];?></td>
                            <td><?php echo $l['CostoTotal'];?></td>
                            <td><?php echo $l['Fecha_de_Compra'];?></td>
                            <td class="warning">
                                <span class="services__button">detalles</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles de venta</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <span>ID Venta: <?php echo $l['NumeroVenta'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>CI: <?php echo $l['CI']?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre: <?php echo $l['Nombre'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Apellido: <?php echo $l['Apeliido'];?></span>
                                    </li>
                                   
                                   
                                    <li class="services__modal-service">
                                        <span>ID_Evento: <?php echo $l['Id_Evento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre Evento: <?php echo $l['Nombre_Evento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha Evento: <?php echo $l['Fecha'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha Registro Evento: <?php echo $l['FechaRegistroEvento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Hora Del Evento: <?php echo $l['Hora'];?></span>
                                    </li>
                                    
                                    <li class="services__modal-service">
                                        <span>Id Lugar:<?php echo $l['Id_Lugar'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Lugar Evento:<?php echo $l['Lugar'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>cantidad boletos comprados: <?php echo $l['Cantidad'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>cantidad boletos comprados: <?php echo $l['CostoUnitario'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>precio total: <?php echo $l['CostoTotal'];?> </span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Imagen Evento: <img height="50px"  src="data:image/jpg;base64,<?php echo base64_encode($us['imagen']);?>"/> </span>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                            </td>
                            
                            
                        </tr>
                        <?php }?>
                    </tbody>
                </table>

             
                <div class="reportes">
                    <a class="" href="reportesVentas.php"> Imprimir reportes</a>
                </div>
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
          <!--  <div class="sales-analytics">
            
            <br>

                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp">add</span>
                        <span class="services__button"><h3>Registro Venta</h3></span>
                            <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <form method="POST">
                                    <li class="services__modal-service">
                                   
                                        <label for="">Id Venta </label>
                                        <br>
                                        <input type="text" disabled="" id="Iventa" name="Iventa" require  value="<?php echo $l['Id_Venta']+1;?>" > 
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Nombre</label>
                                        <br>
                                        <input type="text" id="Nventa" name="Nventa" required>
                                    </li>
                                  
                                    <li class="services__modal-service">
                                        <label for="">Apellido</label>
                                        <br>
                                        <input type="text" id="Napellido" name="Napellido" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">CI</label>
                                        <br>
                                        <input type="text" id="CI" name="CI" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Metodo Pago</label>
                                        <br>
                                        <input type="text"  id="Pago" name="Pago"  required  >
                                    </li>
                                  
                                    <li class="services__modal-service">
                                        <label for="eventos">Id Evento</label>
                                        <select name="Ieventox">
                                        <//?php foreach($eventosss as $evn):  ?>
                                                <option value="<//?php echo $evn['IdEvento']?>"><//?php echo $evn['IdEvento']?><//?php echo $evn['Nombre_Evento']?></option>
                                                <//?php endforeach ?> 
                                            </select>
                                    </li>
                                    

                                    <li class="services__modal-service">
                                        <label for="">Cantidad</label>
                                        <br>
                                        <input type="text" id="cantidad" name="cantidad"  required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Precio</label>
                                        <br>
                                        <input type="text" id="Precio" name="Precio"  required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Nro Boleto</label>
                                        <br>
                                        <input type="text" id="NroBoleto" name="NroBoleto"  required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Fecha</label>
                                        <br>
                                        <input type="date" id="fe" name="fe"  required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Precio Total</label>
                                        <br>
                                        <input type="text" id="ptotal" name="ptotal"  required>
                                    </li>
                                    <li class="services__modal-service">
                                        <button type="submit" name="accion" value="agregar">Añadir Venta</button>
                                    </li>
                                  
                                    </form>                                   
                                </ul>
                            </div>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>--->

    <script src="./index.js"></script>
</body>
</html>