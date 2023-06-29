<?php
include_once './conexion/conexion3.php';
   include('./global/sesiones.php');
   include('./global/validaciones.html'); 


   $objeto = new DB();
   $conexion = $objeto->connect();
   $consulta= "SELECT * FROM persona where Nombre='$_SESSION[Nombre]'";
   $resultado = $conexion->prepare($consulta);
   $resultado->execute();
   $fotobd=$resultado->fetchAll(PDO::FETCH_ASSOC);

   

   $objeto = new DB();
   $conexion = $objeto->connect();
   $consulta= "SELECT * from lugar ";
   $resultado = $conexion->prepare($consulta);
   $resultado->execute();
   $lugarvista=$resultado->fetchAll(PDO::FETCH_ASSOC);


   $objeto = new DB();
   $conexion = $objeto->connect();
   $consulta= "SELECT * FROM  lugar lu inner join evento ev on lu.Id_Lugar=ev.Id_Lugar";
   $resultado = $conexion->prepare($consulta);
   $resultado->execute();
   $detalleslugares=$resultado->fetchAll(PDO::FETCH_ASSOC);

   

$NombreLugar=(isset($_POST['Nlugar']))?$_POST['Nlugar']:"";
$Lati=(isset($_POST['latitud']))?$_POST['latitud']:"";
$Long=(isset($_POST['longitud']))?$_POST['longitud']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "agregar":
        if($existe==0){
        $objeto1 = new DB();
        $conexion1 = $objeto1->connect();
        $query1 = "INSERT INTO lugar(Lugar,Latitud,Longitud) 
        VALUES ('$NombreLugar','$Lati','$Long')";
        $resultado1 = $conexion1->prepare($query1);
        $resultado1->execute();
        
        
        if($resultado1){
             echo'<script type="text/javascript">
    alert("Tarea Guardada");
    window.location.href="prod.php";
    </script>';
        }
       else{
         echo'<script type="text/javascript">
    alert("Registro Fallido");
    window.location.href="prod.php";
    </script>';
       
    }  
    } 
     
} 

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM 
persona p inner JOIN usuario us on p.CI=us.CI inner join boleto b on b.IDLogin=us.IDLogin
inner join detalle_venta de on de.Id_Boleto=b.Id_Boleto 
inner join evento ev on ev.Id_Evento=b.Id_Evento group by FECHA desc  ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventasinnerCompras=$resultado->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(Id_Lugar) AS tot FROM Lugar";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$Lutot=$ventash->fetchAll(PDO::FETCH_ASSOC);
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
                <a href="./prod.php" class="active">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Lugares</h3>
                    <?php foreach($Lutot as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
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
                <a href="./emp.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>Administradores</h3>
                </a>
                <a href="./global/cerrarsesion.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Cerrar Sesion</h3>
                    <?php
                                  //  session_unset();
                                 //   session_destroy();
                                    ?>
                </a>
            </div>
        </aside>
        <!---End aside-->
        <main>
            <br>
            <br>
            <h1>Ubicaciones</h1>
            
            <div class="recent-orders">
                <h2>Menu</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Direccion</th>
                            <th>Lugar</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php foreach($lugarvista as $lugs )  { ?>
                        <tr>
                            <td><?php echo $lugs['Id_Lugar'];?></td>
                            <td><?php echo $lugs['Lugar'];?></td>
                            <td><?php echo $lugs['Latitud'];?></td>
                            <td><?php echo $lugs['Longitud'];?></td>
                            <td class="warning">
                                <span class="services__button"></span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                            </div>
                              
                               
                                
                              
                            </div>
                       
                        <?php echo "<a href='eliminarlugar.php?id=".$lugs['Id_Lugar']."' onclick='return confirmar()'>Eliminar</a>";?>
                      
                            </td>
                            
                            
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="reportes">
                    <a class="" href="reportesLugares.php"> Imprimir reportes</a>
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
                            <p><b><?php echo $u['Nombre']; ?></b> Acaba de comprar los  boletos para  el evento <?php echo $u['Nombre_Evento']; ?>  </p>
                            <small class="text-muted">fecha de compra: <?php echo $u['Fecha']; ?></small>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--------------end of recent updates------------->
            <div class="sales-analytics">
                <br>
                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp">add</span>
                        <span class="services__button"><h3>Agregar Ubicacion</h3></span>
                            <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title"></h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <form method="POST">
                                 
                                    
                                    <li class="services__modal-service">
                                        <label for="">Nombre de ubicacion</label>
                                        <br>
                                        <input type="text" id="Nlugar" name="Nlugar"  required>
                                    </li>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="">
                                        <li class="services__modal-service">
                                            <label for="latitud">Latitud </label>
                                            <input type="text" id="latitud" name="latitud">
                                            </li>
                                        </div>
                                       </div>
                                        <div class="col-md-6">
                                        <div class="">
                                        <li class="services__modal-service">
                                            <label for="longitud">Longitud </label>
                                            <input type="text" id="longitud" name="longitud">
                                            </li>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-12">
                                        <div id="mapa" name="mapa" style="width:500px; height:350px;"></div>
                                       </div>
                                     </div>
                                     <script>
                                          function iniciarMapa(){
                                            var latitud=-16.4925886;
                                            var longitud=-68.1245496;
                                            coordenadas={
                                                lng: longitud,
                                                lat: latitud
                                            }
                                            generarMapa(coordenadas);
                                          }
                                          function generarMapa(coordenadas){
                                            var mapa=new google.maps.Map(document.getElementById('mapa'),
                                            {
                                                zoom:15,
                                                center: new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
                                            });

                                            marcador=new google.maps.Marker({
                                                map:mapa,
                                                draggable:true,
                                                position:new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
                                            });

                                            marcador.addListener('dragend',function(event){
                                                document.getElementById("latitud").value=this.getPosition().lat();
                                                document.getElementById("longitud").value=this.getPosition().lng();
                                              
                                            })
                                          }
                                        </script>
                                     <script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDmxG5O8DwYeoKV1_56xxWYPXLs7l6Bpk&callback=iniciarMapa"></script>



                                    <li class="services__modal-service">
                                        <button type="submit" name="accion" value="agregar">Añadir Ubicacion</button>
                                    </li>
                                    </form>                                   
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
            <br>
               
        </div>
    </div>

    <script src="./index.js"></script>
</body>
</html>