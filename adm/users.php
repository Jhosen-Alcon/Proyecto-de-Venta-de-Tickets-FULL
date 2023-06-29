<?php
   
include_once './conexion/conexion3.php';
include('./global/sesiones.php');

//date_default_timezone_set("America/La_Paz");

//$fechaActual=date('d-m-Y');

//$objeto = new DB();
//$conexion = $objeto->connect();
//$por_pagina=5;

    //if(isset($_GET['pagina'])){
    //$pagina= $_GET['pagina'];
    //}  
    //else { 
      //  $pagina =1;
    //} 
    //$empieza=($pagina-1)*$por_pagina;
   
//$consulta= "SELECT * FROM persona where ROL=0  LIMIT $empieza, $por_pagina";
//$resultado = $conexion->prepare($consulta);
//$resultado->execute();
//$users=$resultado->fetchAll(PDO::FETCH_ASSOC);

//$conexion = $objeto->connect();
//$consulta= "SELECT * FROM persona where Nombre='$_SESSION[Nombre]'";
//$resultado = $conexion->prepare($consulta);
//$resultado->execute();
//$fotobd=$resultado->fetchAll(PDO::FETCH_ASSOC);

//$objeto = new DB();
//$conexion = $objeto->connect();
//$consulta= "SELECT COUNT(CI) AS tot FROM persona where ROL=0";
//$ventash = $conexion->prepare($consulta);
//$ventash->execute();
//$hoy=$ventash->fetchAll(PDO::FETCH_ASSOC);


//$objeto = new DB();
//$conexion = $objeto->connect();
//$consulta= "SELECT * FROM 
//persona p inner JOIN usuario us on p.CI=us.CI inner join boleto b on b.IDLogin=us.IDLogin
//inner join detalle_venta de on de.Id_Boleto=b.Id_Boleto 
//inner join evento ev on ev.Id_Evento=b.Id_Evento group by FECHA desc  ";
//$resultado = $conexion->prepare($consulta);
//$resultado->execute();
//$lventasinnerCompras=$resultado->fetchAll(PDO::FETCH_ASSOC);-->

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/tabla_clientes");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$users = curl_exec($ch);
$users = json_decode($users, true);
curl_close($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/tabla_clientes");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$fotobd = curl_exec($ch);
$fotobd = json_decode($fotobd, true);
curl_close($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/tabla_clientes");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$hoy = curl_exec($ch);
$hoy = json_decode($hoy, true);
curl_close($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/tabla_clientes");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$lventasinnerCompras = curl_exec($ch);
$lventasinnerCompras = json_decode($lventasinnerCompras, true);
curl_close($ch);

?>

<script>



function SoloNumeros(evt)
{
if(window.event){
keynum = evt.keyCode;
}
else{
keynum = evt.which;
}

if((keynum > 47 && keynum < 58) || keynum == 8 || keynum== 13)
{
return true;
}
else
{
alert("Ingresar solo numeros");
return false;
}
}


function SoloLetras(e)
{
key = e.keyCode || e.which;
tecla = String.fromCharCode(key).toString();
letras = " ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnopqrstuvwxyzáéíóú";

especiales = [8,13];
tecla_especial = false
for(var i in especiales) {
if(key == especiales[i]){
 tecla_especial = true;
 break;
}
}

if(letras.indexOf(tecla) == -1 && !tecla_especial)
{
 alert("Este campo es valido solo para texto");
 return false;
}
}
</script>


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
                <a href="./users.php" class="active">
                    <span class="material-icons-sharp">group</span>
                    <h3>Usuarios</h3>
                    <?php foreach($hoy as $h){ ?>
                    <!--<span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>-->
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
                <!--<a href="./funciones.php">
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
                                   // session_unset();
                                   // session_destroy();
                                    ?>
                </a>
            </div>
        </aside>
        <!---End aside-->
        <main>
            <h1>Usuarios</h1>
            
            <div class="insights">
            
            </div>
            <!---------end insights--------->

            <div class="recent-orders">
            <h2>Lista de usuarios</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Carnet Identidad </th>
                            <th>Nombre Usuario</th>
                             <th>Apellido Usuario</th>
                            <th>Correo</th>
                              <th>Fecha Nacimiento</th>
                            <th>Rol</th>
                            <th>Imagen</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $l){ ?>
                        <tr>
                            <!--<td><?php echo $l['CI'];?></td>
                            <td><?php echo $l['Nombre'];?></td>
                            <td><?php echo $l['Apeliido'];?></td>
                            <td><?php echo $l['Correo'];?></td>   
                              <td><?php echo $l['FechaNacimiento'];?></td>
                                  <td><?php echo $l['Rol'];?></td>-->
                            <td class="warning">
                                <span class="services__button">detalles</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <span>Carnet: <?php echo $l['CI'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha Nacimiento: <?php echo $l['FechaNacimiento'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Nombre: <?php echo $l['Nombre'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Apellido: <?php echo $l['Apeliido'];?></span>
                                    </li>
                                   
                                    <li class="services__modal-service">
                                        <span>Correo: <?php echo $l['Correo'];?></span>
                                    </li>
                                    
                                      <li class="services__modal-service">
                                        <span>rol: <?php echo $l['Rol'];?></span>
                                    </li>

                                    <!--<li class="services__modal-service">
                                     <td> <span><img height="60px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imagen']);?>"/></span></td>
                                    </li>-->
                                    
                                </ul>
                            </div>
                        </div>
                            </td>

                            <form method="POST" action="ActualizarUsuario.php" enctype="multipart/form-data">
                            <td class="warning">
                                <span class="services__button">Editar</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Editar</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                    Carnet Identidad:<input type="text" name="CI"  value="<?php echo $l['CI'];?>"  readonly required >
                                    </li>
                                    <li class="services__modal-service">
                                      Nombre:<input type="text" name="Nombre_Usuario"  value="<?php echo $l['Nombre'];?>" onkeypress="return SoloLetras(event) " required >
                                    </li>
                                    <li class="services__modal-service">
                                    Apellido Usuario:<input type="text" name="Apellido_Usuario"  value="<?php echo $l['Apeliido'];?>" onkeypress="return SoloLetras(event) " required >
                                    </li>
                                    <li class="services__modal-service">
                                    Fecha Nacimiento:<input type="date" name="Fecha_Nacimiento"  value="<?php echo $l['FechaNacimiento'];?>" required max="2005-12-20" min="1980-01-01" required >
                                    </li>
                                    <li class="services__modal-service">
                                    Correo:<input type="email" name="correo"  value="<?php echo $l['Correo'];?>" required >
                                    </li>
                                    <li class="services__modal-service">
                                    Rol:<input type="text" name="Rol"  value="<?php echo $l['Rol'];?>" onkeypress="return SoloNumeros(event) " maxlength="1" required >
                                    </li>
                                    <li class="services__modal-service">
                                    Imagen:<img height="60px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imagen']);?>"/>
                                    </li>
                                    <li class="services__modal-service">
                                        <button type="submit" name="accion" value="Actulizar">Modificar </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                            </td>
                            </form> 
                            <form method="POST" action="ActulizarImagen.php" enctype="multipart/form-data">
                            <td class="warning">
                                <span class="services__button">Editar Imagen</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Editar Imagen</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                    Carnet Identidad:<input type="text" name="CI"  value="<?php echo $l['CI'];?>"  readonly required >
                                    </li>
                                    <li class="services__modal-service">
                                    Imagen:<img height="60px"  src="data:image/jpg;base64,<?php echo base64_encode($l['imagen']);?>"/>
                                    <input type="file" name="imagen"/>
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
                    $consulta= "SELECT * FROM persona where Rol=0";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $total_registros=$resultado->fetchAll(PDO::FETCH_ASSOC);
                   // $total_paginas=ceil(count($total_registros) / $por_pagina);
                    echo "<center><a href='users.php?pagina=1'>".' Primera '."</a>";
                    for($i=1;$i<=$total_paginas;$i++){
                        echo "<a href='users.php?pagina=" .$i. "'> " .$i. "</a>";
                    }
                    echo "<a href='users.php?pagina=$total_paginas' > ".' Ultima '."</a></center";
                    ?>
                    </div>
                <div class="reportes">
                    <a class="" href="reportes.php"> Imprimir reportes</a>

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
            <div class="recent-updates">
                <h2>Ventas Recientes (C)</h2>
                <div class="updates">
                    <?php foreach($lventasinnerCompras as $u) { ?>
                    <div class="update">
                        <div class="profile-photo"> 
                        <img height="60px"  src="data:image/jpg;base64,<?php echo base64_encode($u['imagen']);?>"/>
                        </div>
                        <div class="message">
                            <p><b> <?php echo $u['Nombre']; ?></b> Acaba de boletos para  el evento <?php echo $u['Nombre_Evento']; ?>  </p>
                            <small class="text-muted">fecha de compra: <?php echo $u['Fecha']; ?></small>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--------------end of recent updates------------->
                                                                      
                              
                     
           
        </div>
    </div>

    <script src="./index.js"></script>
</body>
</html>