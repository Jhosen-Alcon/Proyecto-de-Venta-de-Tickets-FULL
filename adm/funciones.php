<?php
   session_start();

/*
$peli=(isset($_POST['peli']))?$_POST['peli']:"";
$sala=(isset($_POST['sala']))?$_POST['sala']:"";
$hora=(isset($_POST['hora']))?$_POST['hora']:"";
$fecha=(isset($_POST['capacidad']))?$_POST['fecha']:"";
$precio=(isset($_POST['precio']))?$_POST['precio']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$a=0;

switch($accion){
    case "agregar":
        $conex = mysqli_connect('localhost','root','','glasgowc_cine3');
        $query = "INSERT INTO cartelera(id_pelicula,id_sala,hora,fecha,precio) VALUES ($peli,$sala,'$hora','$fecha',$precio)";
        $resul = mysqli_query($conex,$query);
}

include_once './conexion/conexion3.php';
$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM pelicula";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$nombres=$resultado->fetchAll();

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT tipo, id_sala FROM sala";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$salas=$resultado->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM cartelera c INNER JOIN pelicula p ON c.id_pelicula = p.id_pelicula INNER JOIN sala s ON c.id_sala = s.id_sala";
$totalsum = $conexion->prepare($consulta);
$totalsum->execute();
$cart=$totalsum->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT COUNT(id_cartelera) AS tot FROM cartelera WHERE fecha = CURRENT_DATE()";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$hoy=$ventash->fetchAll(PDO::FETCH_ASSOC);

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM venta_cine  WHERE fecha = CURRENT_DATE()";
$compra = $conexion->prepare($consulta);
$compra->execute();
$userc=$compra->fetchAll(PDO::FETCH_ASSOC);
*/
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
    <title>GREAT CONCERT </title>
</head>
<body class="dark-theme-variables">
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/cine.png" alt="">
                    <h2>GREAT<span class="danger">CONCERT</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>

            <div class="sidebar">
                <a href="./index.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
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
                    <h3>Snacks</h3>
                </a>
                <a href="./Eventos.php">
                    <span class="material-icons-sharp">theaters</span>
                    <h3>Peliculas</h3>
                </a>
                <a href="./salas.php">
                    <span class="material-icons-sharp">pageview</span>
                    <h3>Salas</h3>
                </a>
                <a href="./funciones.php" class="active">
                    <span class="material-icons-sharp">movie</span>
                    <h3>Funciones</h3>
                    <?php foreach($hoy as $h){ ?>
                    <span class="message-count"><?php echo $h['tot']; ?></span>
                    <?php } ?>
                </a>
                <a href="./emp.php">
                    <span class="material-icons-sharp">group</span>
                    <h3>Empleados</h3>
                </a>
                <a href="../index.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Cerrar Sesion</h3>
                    <?php
                                    //session_unset();
                                   // session_destroy();
                                    ?>
                </a>
            </div>
        </aside>
        <!---End aside-->
        <main>
            <h1>Funciones</h1>
            
            <div class="recent-orders">
                <h2>Todas las Funciones</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Pelicula</th>
                            <th>Sala</th>
                            <th>Hora</th>
                            <th>Fecha</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart as $l){ ?>
                        <tr>
                            <td><?php echo $l['nombre'];?></td>
                            <td><?php echo $l['tipo'];?></td>
                            <td><?php echo $l['hora'];?></td>
                            <td><?php echo $l['fecha'];?></td>
                            <td><?php echo $l['precio'];?> Bs.</td>
                            <td class="warning">
                                <span class="services__button">detalles</span>
                                <div class="services__modal" id="edit">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Detalles</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <span>ID de la funcion: <?php echo $l['id_cartelera'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Pelicula: <?php echo $l['nombre'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Sala: <?php echo $l['tipo'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Hora: <?php echo $l['hora'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Fecha: <?php echo $l['fecha'];?></span>
                                    </li>
                                    <li class="services__modal-service">
                                        <span>Precio: <?php echo $l['precio'];?> Bs.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                            </td>
                            
                            
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <a href="#">Mostrar Todo</a>
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
                        <p>Hey, <b>Admin</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./images/user.png">
                    </div>
                </div>
            </div>
            <!--end top-->
            <div class="recent-updates">
                <h2>Ventas Recientes (C)</h2>
                <div class="updates">
                    <?php foreach($userc as $u) { ?>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/user.png">
                        </div>
                        <div class="message">
                            <p><b><?php echo $u['correo']; ?></b> Acaba de comprar el asiento <?php echo $u['asiento']; ?> para <?php echo $u['pelicula']; ?> </p>
                            <small class="text-muted">fecha de compra: <?php echo $u['fecha']; ?></small>
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
                    <span class="services__button"><h3>Crear Funcion</h3></span>
                        <div class="services__modal" id="edit">
                        <div class="services__modal-content">
                            <h4 class="services__modal-title"></h4>
                            <i class="uil uil-times services__modal-close"></i>

                            <ul class="services__modal-services grid">
                                <br><br>
                                <form method="POST">
                                    <li class="services__modal-service">
                                        <label for="">Pelicula</label>
                                        <select name="peli" id="peli">   
                                        <?php foreach($nombres as $n){ ?>
                                            <option value="<?php echo $n['id_pelicula'];?>"><?php echo $n['id_pelicula']  ?> - <?php echo $n['nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </li>
                                    <br>
                                    <li class="services__modal-service">
                                        <label for="">Sala</label>
                                        <select name="sala" id="sala">
                                            <?php foreach($salas as $n){ ?>
                                            <option value="<?php echo $n['id_sala'];?>"><?php echo $n['id_sala'] ?> - <?php echo $n['tipo'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </li>
                                    <br>
                                    <li class="services__modal-service">
                                        <label for="">Hora</label>
                                        <br>
                                        <input type="time" id="hora" name="hora" require>
                                    </li>
                                    <br>
                                    <li class="services__modal-service">
                                        <label for="">Fecha</label>
                                        <br>
                                        <input type="text" placeholder="YYYY-MM-DD" id="fecha" name="fecha" require>
                                    </li>
                                    <br>
                                    <li class="services__modal-service">
                                        <label for="">Precio</label>
                                        <br>
                                        <input type="number" id="precio" name="precio" require>
                                    </li>
                                    <br>
                                    <li class="services_modal-service">
                                        <button type="submit" name="accion" value="agregar">Agregar Funcion</button>
                                    </li>                          
                                </form>                              
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
</body>
</html>