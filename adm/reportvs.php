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
<body class="dark-theme-variables">

<?php

include_once './conexion/conexion3.php';
$objeto = new DB();
$conexion = $objeto->connect();
$consulta= "SELECT * FROM factura_cine f INNER JOIN cartelera_asientos c ON f.id_c_asientos = c.id_cartelera_asientos INNER JOIN 
cartelera ca ON c.id_cartelera = ca.id_cartelera INNER JOIN pelicula p ON ca.id_pelicula = p.id_pelicula INNER JOIN usuario u ON
f.id_usuario = u.id_usuario INNER JOIN sala sa ON sa.id_sala = ca.id_sala ORDER BY f.id_factura DESC";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$lventas=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<main>
<div class="recent-orders">
                <h2>Ventas GRAL</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Pelicula</th>
                            <th>Numero entradas</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lventas as $l){ ?>
                        <tr>
                            <td><?php echo $l['nit'];?></td>
                            <td><?php echo $l['nombre'];?></td>
                            <td><?php echo $l['cantidad'];?></td>
                            <td class="success"><?php echo $l['total'];?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
</body>
                        </main>
</html>

<?php

$html = ob_get_clean();
echo $html;

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf; 
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);


$dompdf->loadHtml("hola");
$dompdf->setPaper('letter');


$dompdf->render();

$dompdf->stream("ReporteCine_.pdf", array("Attachment" => true));

?>