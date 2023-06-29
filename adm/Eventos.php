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



$IEvento=(isset($_POST['Ievento']))?$_POST['Ievento']:"";
$IDLogin=(isset($_POST['IDLogin']))?$_POST['IDLogin']:"";
$Nevento=(isset($_POST['Nevento']))?$_POST['Nevento']:"";
$Lugar=(isset($_POST['lugar']))?$_POST['lugar']:"";
$Fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
$FechaR=(isset($_POST['fechaR']))?$_POST['fechaR']:"";
$Hora=(isset($_POST['hora']))?$_POST['hora']:"";
$IBoleto=(isset($_POST['IBoleto']))?$_POST['IBoleto']:"";
$CanD=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
$Precios=(isset($_POST['precio']))?$_POST['precio']:"";
//$Hora=(isset($_POST['hora']))?$_POST['hora']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "agregar":
        $Imagen=addslashes(file_get_contents($_FILES['Im']['tmp_name']));
        if($existe==0){
        $objeto1 = new DB();
        $conexion1 = $objeto1->connect();
        $query1 = "INSERT INTO evento(IDLogin,Nombre_Evento,Fecha,FechaRegistroEvento,Hora,imgevento,Id_Lugar) 
        VALUES ('$IDLogin','$Nevento','$Fecha','$FechaR','$Hora','$Imagen','$Lugar')";
        $resultado1 = $conexion1->prepare($query1);
        $resultado1->execute();
        
         $objeto2=new DB();
         $conexion2=$objeto2->connect();
        $query2="INSERT INTO boleto(Id_Evento,IDLogin,Cantidad_Disponible,Precio) 
        VALUES('$IEvento','$IDLogin','$CanD','$Precios')";
        $resultado2=$conexion2->prepare($query2);
        $resultado2->execute();
        if($resultado1 && $resultado2){
             echo'<script type="text/javascript">
    alert("Tarea Guardada");
    window.location.href="Eventos.php";
    </script>';
        }
       else{
         echo'<script type="text/javascript">
    alert("Registro Fallido");
    window.location.href="Eventos.php";
    </script>';
       
    }  
    } 
     
} 



$objeto = new DB();
$conexion = $objeto->connect();
$por_pagina=6;

    if(isset($_GET['pagina'])){
    $pagina= $_GET['pagina'];
    }  
    else { 
        $pagina =1;
    } 
    $empieza=($pagina-1)*$por_pagina;
   
    $consultapaginas= "SELECT * FROM boleto b   
    inner join evento ev on ev.Id_Evento=b.Id_Evento 
    inner join usuario us on us.IDLogin=ev.IDLogin inner join persona p on p.CI=us.CI inner join lugar lu on lu.Id_Lugar=ev.Id_Lugar order by ev.Id_Evento LIMIT $empieza, $por_pagina";
$resultado = $conexion->prepare($consultapaginas);
$resultado->execute();
$Eventos=$resultado->fetchAll(PDO::FETCH_ASSOC);




$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM  evento;";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$MuestraE=$resultado->fetchAll(PDO::FETCH_ASSOC);


$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM persona ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$usuario=$resultado->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM 
persona p inner JOIN usuario us on p.CI=us.CI inner join boleto b on b.IDLogin=us.IDLogin
inner join detalle_venta de on de.Id_Boleto=b.Id_Boleto 
inner join evento ev on ev.Id_Evento=b.Id_Evento group by FECHA desc  ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventasinnerCompras=$resultado->fetchAll(PDO::FETCH_ASSOC);


//$objeto = new DB();
//$conexion = $objeto->connect();
//$consulta= "SELECT * FROM venta_cine  WHERE fecha = CURRENT_DATE()";
//$compra = $conexion->prepare($consulta);
//$compra->execute();
//$userc=$compra->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT max(Id_Evento) as IdEvento FROM evento ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$eventoss=$resultado->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(Id_Evento) AS tot FROM evento";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$Eventot=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM lugar ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lugares=$resultado->fetchAll(PDO::FETCH_ASSOC);


date_default_timezone_set("America/La_Paz");
$Hora_24= date('Y-m-d H:i:s');
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
                <a href="./prod.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Lugares</h3>
                </a>
                <a href="./Eventos.php" class="active">
                    <span class="material-icons-sharp">theaters</span>
                    <h3>Eventos</h3>
                    <?php foreach($Eventot as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <a href="./salas.php">
                    <span class="material-icons-sharp">pageview</span>
                    <h3>Boletos</h3>
                </a>
                <!--
                <a href="./funciones.php">
                    <span class="material-icons-sharp">movie</span>
                    <h3>Funciones</h3>
                </a>
                -->
                <a href="./emp.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>Administradores</h3>
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
          
            <h1>Eventos</h1>
            
           
            <div class="recent-orders">
                <h2>Eventos</h2>
               
                <table>
                    <thead>
                        <tr>
                            <th>ID Evento</th>
                            <th>CI Encargado Registro</th>
                            <th>Nombre Eventos</th>
                            <th>Lugar</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                   
                   
                        <?php  
                            foreach( $Eventos as $l){ ?>
                        <tr>
                        
                        <td class="success"> <?php echo $l['Id_Evento'];?></td>
                        <td class="success"><?php echo $l['CI'];?></td>
                            <td><?php echo $l['Nombre_Evento'];?></td>
                            <td><?php echo $l['Lugar'];?></td>
                            <td class="success"><?php echo $l['Fecha'];?></td>
                            <td class="success"><?php echo $l['Hora'];?></td>
                            <td> <img height="60px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imgevento']);?>"></td>
                           
                            <td class="warning">
                                <span class="services__button">detalles</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                <li class="services__modal-service">
                                    <span>CI Encargado: <?php echo $l['CI'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre: <?php echo $l['Nombre'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Apellido: <?php echo $l['Apeliido'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>ID Evento: <?php echo $l['Id_Evento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre_Evento: <?php echo $l['Nombre_Evento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>ID Lugar: <?php echo $l['Lugar'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha: <?php echo $l['Fecha'];?></span>
                                    </li>
                                   
                                    <li class="services__modal-service">
                                        <span>Hora: <?php echo $l['Hora'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha Registro Evento: <?php echo $l['FechaRegistroEvento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Cantidad disponible: <?php echo $l['Cantidad_Disponible'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Precio: <?php echo $l['Precio'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                     <span><img height="120px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imgevento']);?>"/></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                            </td>
                            <form method="POST" action="ActualizarEvento.php" enctype="multipart/form-data">
                            <td class="warning">
                                <span class="services__button">Editar Datos</span>
                             
                                <div class="services__modal" id="edit">
                                    
                                    
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Editar Datos</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                Codigo Evento: <input type="text"  name="Ievento" readonly value="<?php echo $l['Id_Evento'];?>" >
                                    </li>
                                    <li class="services__modal-service">
                                   Nombre Evento: <input type="text"  name="Nevento"  value="<?php echo $l['Nombre_Evento'];?>" required>
                                    </li>
                                  
                                    <li class="services__modal-service">
                                        <label for="">Codigo Lugar:</label>
                                       <select name="lugar">
                                        <?php foreach($lugares as $evn):  ?>
                                                <option value="<?php echo $evn['Id_Lugar']?>"><?php echo $evn['Id_Lugar']?><?php echo $evn['Lugar']?></option>
                                                <?php endforeach ?> 
                                            </select>
                                    </li>
                                    <li class="services__modal-service">
                                    Fecha Evento: <input type="date" name="fecha"  value="<?php echo $l['Fecha'];?>" required>
                                    </li>
                                   
                                    <li class="services__modal-service">
                                    Hora Evento: <input type="time"  name="hora" value="<?php echo $l['Hora'];?>" required>
                                    </li>
                                
                                    <ul class="services__modal-services grid">
                                    Id_Boleto <input type="text"  name="IDB" readonly value="<?php echo $l['Id_Boleto'];?>">
                                    </li>
                                    <li class="services__modal-service">
                                    Cantidad Disponible Boletos: <input type="text"  name="cantidad"  onkeypress="return SoloNumeros(event)" required value="<?php echo $l['Cantidad_Disponible'];?>">
                                    </li>
                                    <li class="services__modal-service">
                                    Precio Boletos: <input type="text"  name="precio" onkeypress="return SoloNumeros(event)" required value="<?php echo $l['Precio'];?>" >
                                    </li>
                                    
                                    <li class="services__modal-service">
                                        <button type="submit" name="accion" onclick="return confirmacion()" value="Actulizar">Modificar </button>
                                       
                                    </li>
                            </li>
                                </ul>
                            </div>
                        </div>
                            </td>
                            </form> 
                           
                            <form method="POST" action="ActulizarImagenEvento.php" enctype="multipart/form-data">
                            <td class="warning">
                         
                                <span class="services__button">Editar Imagen</span>
                               
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Editar Imagen</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                    Codigo Evento: <input type="text"  name="Ievento" readonly value="<?php echo $l['Id_Evento'];?>" >
                                    </li>
                                    <li class="services__modal-service">
                                    Imagen:<img height="120px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imgevento']);?>"/>
                                    <input type="file" name="imagenevento"/>
                                    </li>
                                    <li class="services__modal-service">
                                        <button type="submit" name="accion" value="Actulizar">Modificar </button>
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
               
                <div>
                    <?php 
                    $objeto = new DB();
                    $conexion = $objeto->connect();
                    $consulta= "SELECT * FROM boleto b inner join evento ev on b.Id_Evento=ev.Id_Evento inner join usuario us on us.IDLogin=ev.IDLogin inner join persona p on p.CI=us.CI";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $total_registros=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    $total_paginas=ceil(count($total_registros) / $por_pagina);
                    echo "<center><a href='Eventos.php?pagina=1'>".' Primera '."</a>";
                    for($i=1;$i<=$total_paginas;$i++){
                        echo "<a href='Eventos.php?pagina=" .$i. "'> " .$i. "</a>";
                    }
                    echo "<a href='Eventos.php?pagina=$total_paginas' > ".' Ultima '."</a></center";
                    ?>
                    </div>
                <div class="reportes">
                    <a class="" href="reportesEventos.php"> Imprimir reportes</a>
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
                        <span class="services__button"><h3>Agregar Evento</h3></span>
                            <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles Del Registro De Eventos</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <form method="POST" enctype="multipart/form-data">
                                   
                                    <li class="services__modal-service">
                                        
                                        <label for="">Codigo Boleto </label>
                                        <br>
                                        <?php foreach($eventoss as $evn):  ?>
                                        <input type="text"  id="Ievento" name="Ievento"   readonly value="<?php echo $evn['IdEvento']+1; ?>" required   > 
                                        <?php endforeach ?>
                                    </li>
                                    <li class="services__modal-service">
                                  
                                        <label for="">IDLogin</label>
                                        <br>
                                        <input type="text" id="IDLogin" name="IDLogin" value="<?php echo $_SESSION['ID'];?>"  readonly  required>
                                        <br>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Nombre Evento</label>
                                        <br>
                                        <input type="text" id="Nevento" name="Nevento"     placeholder="Nombre Evento"  required>
                                        <br>
                                    </li>
                                  
                                    <li class="services__modal-service">
                                        <label for="">Lugar</label>
                                       <select name="lugar">
                                        <?php foreach($lugares as $evn):  ?>
                                                <option value="<?php echo $evn['Id_Lugar']?>"><?php echo $evn['Id_Lugar']?><?php echo $evn['Lugar']?></option>
                                                <?php endforeach ?> 
                                            </select>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Fecha de presentacion</label>
                                        <br>
                                        <input type="date" id="fecha" name="fecha"  min="2022-01-01"   required>
                                        <br>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Fecha de registro de evento</label>
                                        <br>
                                        <input type="datetime" id="fechaR" name="fechaR" value="<?php echo $Hora_24;?>"  readonly  required>
                                        <br>
                                    
                                     </li>
                                    <li class="services__modal-service">
                                        <br>
                                        <label for="">Hora de evento:</label>
                                        <br>
                                        <input  type="time" id="hora" name="hora"   required>
                                    </li>
                                    <li class="services__modal-service">
                                        <label for="">Cantidad Disponible</label>
                                        <br>
                                        <input type="text" id="cantidad" name="cantidad"  onkeypress="return SoloNumeros(event) " placeholder="Cantidad de boletos"  minlength="1" required>
                                    </li>

                                    <li class="services__modal-service">
                                        <label for="">Precio</label>
                                        <br>
                                        <input type="text" id="precio" name="precio"  onkeypress="return SoloNumeros(event) " placeholder="Precio de cada boleto"  minlength="1" required>
                                    </li>

                                    <li class="services__modal-service">
                                        <label for="">Imagen:</label>
                                        <br>
                                        <input type="file" id="Im" name="Im" required>
                                    </li>
                                 
                                        <button type="submit" name="accion" value="agregar"    onclick="return confirmacion()" >Añadir Evento</button>
                                    
                                    </form>                                   
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