<?php
include('./global/sesiones.php');
$today = date("Y-n-j");
include_once './conexion/conexion3.php';


$Nboleto=(isset($_POST['NroB']))?$_POST['NroB']:"";
$precio=(isset($_POST['Precio']))?$_POST['Precio']:"";
$Cantidad=(isset($_POST['Cantidad']))?$_POST['Cantidad']:"";
$IDevento=(isset($_POST['Evento']))?$_POST['Evento']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch($accion){
    case "agregar":
        if($existe==0){
      //  $conex = mysqli_connect('localhost','root','','prueba');
       // $query = "INSERT INTO eventos(IdEvento,Nombre_Evento,Lugar,Fecha,Hora,idAdmin) VALUES ('$IEvento','$Nevento','$Lugar','$Fecha','$Hora','$IdA',)";
      //  $resul = mysqli_query($conex,$query);
        $objeto1 = new DB();
        $conexion1 = $objeto1->connect();
        $query1 = "INSERT INTO boletos(Nro_Boleto,Precio,Cantidad,ID_Evento) VALUES ('$Nboleto','$precio','$Cantidad','$IDevento')";
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

include_once './conexion/conexion3.php';
$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * from boleto b  inner join evento ev on ev.Id_Evento=b.Id_Evento inner join usuario u on u.IDLogin=ev.IDLogin inner join persona pe on pe.CI=u.CI
inner join lugar lu on lu.Id_Lugar=ev.Id_Lugar order by b.Id_Boleto";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$boletos=$resultado->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM detalle_venta ";
$compra = $conexion->prepare($consulta);
$compra->execute();
$userc=$compra->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM persona where Nombre='$_SESSION[Nombre]'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$fotobd=$resultado->fetchAll(PDO::FETCH_ASSOC);


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
$consulta= "SELECT COUNT(Id_Boleto) AS tot FROM boleto";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$botot=$ventash->fetchAll(PDO::FETCH_ASSOC);
////hasta aqui se esta usando la bd 


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
    <link rel="shortcut icon" href="./images/Great.png" type="image/x-icon" />
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
                <a href="./users.php" >
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
                <a href="./salas.php" class="active">
                    <span class="material-icons-sharp">pageview</span>
                    <h3>Boletos</h3>
                    <?php foreach($botot as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <!--<a href="./funciones.php">
                    <span class="material-icons-sharp">movie</span>
                    <h3>Funciones</h3>
                </a>-->
                <a href="./emp.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>Administradores</h3>
                </a>
                <a href="../index.php">
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
            
            

            <div class="recent-orders">
                <h2>Boletos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Codigo Boleto</th>
                            <th>Codigo Evento</th>
                            <th>Codigo Login</th>
                            <th>Cantidad Disponible</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($boletos as $bo){ ?>
                        <tr>
                            <td><?php echo $bo['Id_Boleto'];?></td>
                            <td><?php echo $bo['Id_Evento'];?></td>
                            <td><?php echo $bo['IDLogin'];?> </td>
                            <td><?php echo $bo['Cantidad_Disponible'];?></td>
                            <td><?php echo $bo['Precio'];?></td>
                            <td class="warning">
                                <span class="services__button">detalles</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <span>Codigo Boleto: <?php echo $bo['Id_Boleto'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Codigo Evento: <?php echo $bo['Id_Evento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre Evento: <?php echo $bo['Nombre_Evento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha Evento: <?php echo $bo['Fecha'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha Registro Evento: <?php echo $bo['FechaRegistroEvento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Hora Evento: <?php echo $bo['Hora'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Codigo Lugar: <?php echo $bo['Id_Lugar'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre Lugar: <?php echo $bo['Lugar'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Boletos Disponibles: <?php echo $bo['Cantidad_Disponible'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Precio Boletos: <?php echo $bo['Precio'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                    <span><img height="100px"  src="data:image/jpg;base64,<?php echo base64_encode($bo['imgevento']);?>"/></span>
                                    </li>
                                    
                                                                   
                                </ul>
                            </div>
                        </div>
                      
                            </td>
                            
                            <form method="POST" action="ActualizarBoleto.php" enctype="multipart/form-data">
                            <td class="warning">
                                <span class="services__button">Editar</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Editar</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                    Codigo Boleto:<input type="text" name="IdBoleto"  value="<?php echo $bo['Id_Boleto'];?>"  readonly  >
                                    </li>
                                    <li class="services__modal-service">
                                    Id Evento:<input type="text" name="IdEvento"  value="<?php echo $bo['Id_Evento'];?>"  readonly   >
                                    </li>
                                    <li class="services__modal-service">
                                    ID Login:<input type="text" name="IDLog"  value="<?php echo $bo['IDLogin'];?>"  readonly   >
                                    </li>
                                    <li class="services__modal-service">
                                    Cantidad Disponible:<input type="text" name="cand"  value="<?php echo $bo['Cantidad_Disponible'];?>" minlength="1"  required >
                                    </li>
                                    <li class="services__modal-service">
                                    Precio:<input type="text" name="Prec"  value="<?php echo $bo['Precio'];?>" minlength="1" required >
                                    </li>
                                    
                                    <li class="services__modal-service">
                                        <button type="submit" name="accion" value="Actulizar">Modificar </button>
                                        <?php echo "<a  href='eliminarevento.php?id=".$bo['Id_Boleto']."' onclick='return confirmar()' >Eliminar</a>";?><span>
                                    </li>
                            </li>
                                </ul>
                            </div>
                        </div>
                            </td>
                            </form> 
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
            <!--------------end of recent updates
            <div class="sales-analytics">
                            <br>

                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp">add</span>
                        <span class="services__button"><h3>Agregar Boletos</h3></span>
                            <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <form method="POST">
                                    <li class="services__modal-service">
                                        <label for="">Nro Boleto</label>
                                        <br>
                                        <input type="text" id="NroB" name="NroB" required value="<?php echo $bo['Nro_Boleto']+1; ?>">
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Precio</label>
                                        <br>
                                        <input type="text" id="Precio" name="Precio" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Cantidad Boletos</label>
                                        <br>
                                        <input type="text" id="Cantidad" name="Cantidad" required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">ID Evento</label>
                                        <br>
                                        <input type="text" id="Evento" name="Evento" required>
                                    </li>
                                    
                                        <button type="submit" name="accion" value="agregar">Añadir Boleto</button>
                                        
                                    </form> ------------->                                  
                                </ul>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
</body>
</html>