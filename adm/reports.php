<?php

ob_start();

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
    <title>Document</title>
</head>
<body>

<?php

include_once './conexion/conexion3.php';

$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM venta_snack ORDER BY id DESC LIMIT 5";
$ventash = $conexion->prepare($consulta);
$ventash->execute();
$snacks=$ventash->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="recent-orders">

                <h2>Ventas Snacks</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Tarjeta</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($snacks as $l){ ?>
                        <tr>
                            <td><?php echo $l['correo'];?></td>
                            <td><?php echo $l['num_tarjeta'];?></td>
                            <td><?php echo $l['detalle'];?></td>
                            <td><?php echo $l['total'];?> Bs.</td>
                            <td class="success"><?php echo $l['estado'];?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                
            </div>
</body>
</html>
<?php

$html= ob_get_clean();

?>